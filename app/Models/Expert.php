<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expert extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'expert_category_id',
        'name',
        'initials',
        'specialty_description',
        'availability_schedule',
        'whatsapp_number',
        'whatsapp_message',
        'avatar_bg_color',
        'avatar_text_color',
        'is_active',
    ];

    protected $appends = ['availability_details', 'photo'];

    public function category()
    {
        return $this->belongsTo(ExpertCategory::class, 'expert_category_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getPhotoAttribute()
    {
        if ($this->user && $this->user->photo) {
            return url('back/assets/images/admin/' . $this->user->photo);
        }
        return null;
    }

    /**
     * Get details array if availability schedule is stored as JSON.
     */
    public function getAvailabilityDetailsAttribute()
    {
        $decoded = json_decode($this->attributes['availability_schedule'] ?? '', true);
        if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
            return $decoded;
        }
        return null;
    }

    /**
     * Accessor to format structured JSON availability to human-readable string.
     */
    public function getAvailabilityScheduleAttribute($value)
    {
        if (empty($value)) {
            return '';
        }

        $decoded = json_decode($value, true);
        if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
            $days = $decoded['days'] ?? [];
            $startTime = $decoded['start_time'] ?? '';
            $endTime = $decoded['end_time'] ?? '';

            if (empty($days)) {
                return 'No days selected';
            }

            $startFormatted = $startTime ? date('g:i A', strtotime($startTime)) : '';
            $endFormatted = $endTime ? date('g:i A', strtotime($endTime)) : '';

            $dayOrder = ['Mon' => 1, 'Tue' => 2, 'Wed' => 3, 'Thu' => 4, 'Fri' => 5, 'Sat' => 6, 'Sun' => 7];
            $sortedDays = $days;
            usort($sortedDays, function($a, $b) use ($dayOrder) {
                return ($dayOrder[$a] ?? 0) <=> ($dayOrder[$b] ?? 0);
            });

            $monToFri = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri'];
            $monToSat = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
            $allWeek = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];

            if ($sortedDays === $monToFri) {
                $daysStr = 'Mon - Fri';
            } elseif ($sortedDays === $monToSat) {
                $daysStr = 'Mon - Sat';
            } elseif ($sortedDays === $allWeek) {
                $daysStr = 'Everyday';
            } else {
                $daysStr = implode(', ', $sortedDays);
            }

            return $daysStr . ' (' . $startFormatted . ' - ' . $endFormatted . ')';
        }

        return $value;
    }
}
