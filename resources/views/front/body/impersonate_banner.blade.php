@if(session()->has('impersonator_id'))
<div style="position: fixed; top: 0; left: 0; right: 0; width: 100%; z-index: 999999; background: linear-gradient(135deg, #111827 0%, #1f2937 100%); color: #ffffff; padding: 10px 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.3); border-bottom: 3px solid #ffc107; font-family: inherit; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 10px;">
    <div style="display: flex; align-items: center; gap: 12px; font-size: 14px; font-weight: 600;">
        <span style="background: #ffc107; color: #000; padding: 4px 10px; border-radius: 20px; font-size: 11px; text-transform: uppercase; font-weight: 800; letter-spacing: 0.5px;">
            ⚠️ Impersonation Mode
        </span>
        <span>
            You are logged in as user: <strong style="color: #38bdf8;">{{ Auth::user()->name }}</strong> ({{ Auth::user()->email }})
        </span>
    </div>
    <div>
        <a href="{{ route('admin.impersonate.leave') }}" style="background: #dc3545; color: #ffffff; padding: 6px 16px; border-radius: 6px; font-size: 13px; font-weight: 700; text-decoration: none; display: inline-flex; align-items: center; gap: 6px; box-shadow: 0 2px 6px rgba(220,53,69,0.4);">
            Exit Impersonation &amp; Return to Admin
        </a>
    </div>
</div>
<div style="height: 48px;"></div>
@endif
