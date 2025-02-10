<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

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
        $files = File::files(storage_path('logs'));
        $deletedFiles = [];
    
        foreach ($files as $file) {
            if ($file->getMTime() < now()->subDays(7)->getTimestamp()) {
                File::delete($file);
                $deletedFiles[] = $file->getFilename();
            }
        }
    
        if (!empty($deletedFiles)) {
            $this->info('Logs cleared successfully: ' . implode(', ', $deletedFiles));
        } else {
            $this->info('No logs to clear.');
        }
    }
}
