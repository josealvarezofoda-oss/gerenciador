<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// agendamento de mensalidades
Schedule::command('app:gerar-mensalidades')
    ->monthlyOn(1, '00:05')
    ->withoutOverlapping()
    ->appendOutputTo(storage_path('logs/mensalidades.log'));

