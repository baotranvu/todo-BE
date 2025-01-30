<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class DeleteLogs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'logs:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete old log files';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        // Đường dẫn đến thư mục logs
        $logPath = storage_path('logs');
        
        // Lấy tất cả các file trong thư mục logs
        $files = File::allFiles($logPath);

        // Xóa các file log
        foreach ($files as $file) {
            // Xóa file nếu nó đã tồn tại
            if (File::exists($file)) {
                File::delete($file);
                $this->info("Deleted: " . $file);
            }
        }

        $this->info("Log files deleted successfully.");
    }
}
