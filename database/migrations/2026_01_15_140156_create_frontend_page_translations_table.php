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
        Schema::create('frontend_page_translations', function (Blueprint $table) {
            $table->id();

            $table->foreignId('frontend_page_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('locale', 5); // en, es, fr, de, ar, etc
            $table->string('title');
            $table->longText('content');

            $table->unique(['frontend_page_id', 'locale']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('frontend_page_translations');
    }
};
