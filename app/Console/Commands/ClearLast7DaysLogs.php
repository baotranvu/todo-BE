<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ClearLast7DaysLogs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'logs:clear-last7days';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear logs older than 7 days';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $logsPath = storage_path('logs');

        $command = "find $logsPath -type f -mtime +7 -exec rm {} \;";
        exec($command);

        $this->info('Logs cleared successfully.');
    }
}
