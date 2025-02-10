<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $table = Schema::hasTable('tasks');
        if ($table) {
            Schema::table('tasks', function (Blueprint $table) {
                $table->enum('priority', ['low', 'medium', 'high'])->after('is_completed')->nullable()->default('low');
                $table->string('description')->after('name')->nullable();
                $table->tinyInteger('progress')->after('priority')->nullable()->default(0);
                $table->timestamp('start_date')->after('progress')->nullable();
                $table->timestamp('due_date')->after('start_date')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropColumn('priority');
            $table->dropColumn('description');
            $table->dropColumn('start_date');
            $table->dropColumn('due_date');
        });
    }
};
