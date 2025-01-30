<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Đăng ký các command của ứng dụng.
     *
     * @var array
     */
    protected $commands = [
        \App\Console\Commands\DeleteLogs::class,
    ];

    /**
     * Định nghĩa các lệnh có thể chạy.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('logs:delete')->daily(); // Hoặc lịch trình tùy chỉnh
    }

    /**
     * Đăng ký các lệnh Artisan của ứng dụng.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
