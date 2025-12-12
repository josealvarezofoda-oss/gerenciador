<?php

use App\Models\ActivityLog;

if (! function_exists('activity_log')) {
    function activity_log(string $action, $meta = null)
    {
        return ActivityLog::create([
            'user_id' => auth()->id(),
            'action'  => $action,
            'meta'    => is_array($meta) ? $meta : ($meta ? ['info' => $meta] : null),
        ]);
    }
}
