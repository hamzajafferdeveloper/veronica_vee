<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->string('attachment')->nullable()->after('message');
            $table->string('attachment_name')->nullable()->after('attachment');
            $table->string('attachment_extension')->nullable()->after('attachment_name');
            $table->string('attachment_type')->nullable()->after('attachment_extension');
            $table->bigInteger('attachment_size')->nullable()->after('attachment_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->dropColumn([
                'attachment',
                'attachment_name',
                'attachment_extension',
                'attachment_type',
                'attachment_size',
            ]);
        });
    }
};
