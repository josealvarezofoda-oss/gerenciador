<?php

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

if (!function_exists('activity_log')) {
    function activity_log($action, $data = [])
    {
        return ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => $action,
            'data' => json_encode($data),
        ]);
    }
}
