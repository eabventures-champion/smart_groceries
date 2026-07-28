<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Sanctum\HasApiTokens;
use DB;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // User Active Now 
    public function user_online(){
        return Cache::has('user-is-online' . $this->id);
    }

    public static function getpermissionGroups(){
        $permission_groups = DB::table('permissions')->select('group_name')->groupBy('group_name')->get();
        return $permission_groups;
    }

    public static function getpermissionByGroupName($group_name){
        $permissions = DB::table('permissions')
                        ->select('name', 'id')
                        ->where('group_name', $group_name)
                        ->get();
        return $permissions;
    }

    public static function roleHasPermissions($role, $permissions){

        $hasPermission = true;
        foreach($permissions as $permission){
            if (!$role->hasPermissionTo($permission->name)) {
                $hasPermission = false;
                return $hasPermission;
            }
            return $hasPermission;
        } 

    }

    // Affiliate Relationships
    public function referrals()
    {
        return $this->hasMany(User::class, 'referred_by');
    }

    public function referrer()
    {
        return $this->belongsTo(User::class, 'referred_by');
    }

    public function affiliateReferrals()
    {
        return $this->hasMany(AffiliateReferral::class, 'referrer_id');
    }

    public function affiliatePayouts()
    {
        return $this->hasMany(AffiliatePayout::class, 'user_id');
    }

    public function getAffiliateTotalEarned(): float
    {
        $siteSetting = \App\Models\SiteSetting::find(1);
        $isPartner = ($this->is_partner || !empty($this->institution) || (!empty($this->resident_type) && str_contains(strtolower($this->resident_type), 'partner')));
        $flatAmount = $isPartner
            ? ($siteSetting->partner_referral_amount ?? 3.00)
            : ($siteSetting->referral_flat_amount ?? 15.00);

        $loggedEarned = (float)\App\Models\AffiliateReferral::where('referrer_id', $this->id)->sum('commission_earned');
        
        $referredUserIds = \App\Models\User::where('referred_by', $this->id)->pluck('id');
        $qualifyingCount = \App\Models\Order::whereIn('user_id', $referredUserIds)->whereIn('status', ['confirmed', 'processing', 'delivering', 'delivered'])->distinct('user_id')->count('user_id');

        $completedPayouts = (float)\App\Models\AffiliatePayout::where('user_id', $this->id)->where('status', 'completed')->sum('amount');
        $pendingPayouts = (float)\App\Models\AffiliatePayout::where('user_id', $this->id)->where('status', 'pending')->sum('amount');
        
        $calculatedEarned = max($loggedEarned, $qualifyingCount * $flatAmount);

        return max($calculatedEarned, (float)$this->referral_balance + $completedPayouts + $pendingPayouts);
    }

    public function getAffiliateTotalRedrawal(): float
    {
        return (float)\App\Models\AffiliatePayout::where('user_id', $this->id)
            ->where('status', 'completed')
            ->sum('amount');
    }

    public function getAffiliateCurrentBalance(): float
    {
        return (float)$this->referral_balance;
    }

    // Helper to generate dynamic unique referral code
    public static function generateReferralCode($username)
    {
        $base = strtoupper(substr(preg_replace('/[^A-Za-z0-9]/', '', $username), 0, 5));
        if (empty($base)) {
            $base = 'SG';
        }
        $code = 'SG-' . $base . rand(100, 999);
        while (self::where('referral_code', $code)->exists()) {
            $code = 'SG-' . $base . rand(100, 999);
        }
        return $code;
    }

    // ── Student Status Helpers ──────────────────────────────

    /**
     * Check if student is still active (completion year hasn't passed).
     */
    public function isExistingStudent(): bool
    {
        if (!$this->year_of_completion) {
            return false;
        }
        return (int) $this->year_of_completion >= (int) date('Y');
    }

    /**
     * Check if student has completed (completion year has passed).
     */
    public function isCompletedStudent(): bool
    {
        if (!$this->year_of_completion) {
            return false;
        }
        return (int) $this->year_of_completion < (int) date('Y');
    }

    /**
     * Dynamic accessor: get the student status label.
     */
    public function getStudentStatusAttribute(): string
    {
        if (!$this->year_of_completion) {
            return 'unknown';
        }
        return $this->isExistingStudent() ? 'existing' : 'completed';
    }

    /**
     * Generate a unique student ID.
     * Existing students: SG-STU-{admissionYear}-{5digits}
     * Completed students: SG-ALM-{admissionYear}-{5digits}
     */
    public static function generateStudentId($yearOfAdmission, $yearOfCompletion)
    {
        $currentYear = (int) date('Y');
        $prefix = ((int) $yearOfCompletion >= $currentYear) ? 'SG-STU' : 'SG-ALM';

        // Count existing students with same prefix and admission year for sequential numbering
        $count = self::where('student_id', 'LIKE', $prefix . '-' . $yearOfAdmission . '-%')->count();
        $sequence = str_pad($count + 1, 5, '0', STR_PAD_LEFT);

        $studentId = $prefix . '-' . $yearOfAdmission . '-' . $sequence;

        // Ensure uniqueness
        while (self::where('student_id', $studentId)->exists()) {
            $count++;
            $sequence = str_pad($count + 1, 5, '0', STR_PAD_LEFT);
            $studentId = $prefix . '-' . $yearOfAdmission . '-' . $sequence;
        }

        return $studentId;
    }

    /**
     * Refresh student ID prefix when status changes (STU ↔ ALM).
     * Called on dashboard load to keep IDs in sync.
     */
    public function refreshStudentId(): void
    {
        if (!$this->student_id || !$this->year_of_completion) {
            return;
        }

        $currentPrefix = substr($this->student_id, 0, 6); // SG-STU or SG-ALM
        $expectedPrefix = $this->isExistingStudent() ? 'SG-STU' : 'SG-ALM';

        if ($currentPrefix !== $expectedPrefix) {
            // Replace prefix, keep the rest of the ID
            $newId = $expectedPrefix . substr($this->student_id, 6);

            // Check for collision
            if (self::where('student_id', $newId)->where('id', '!=', $this->id)->exists()) {
                // Generate a fresh ID if collision
                $newId = self::generateStudentId($this->year_of_admission, $this->year_of_completion);
            }

            $this->student_id = $newId;
            $this->save();
        }
    }
}

