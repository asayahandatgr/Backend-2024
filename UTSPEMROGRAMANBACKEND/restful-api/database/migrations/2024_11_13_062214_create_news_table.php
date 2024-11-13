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
        Schema::create('news', function (Blueprint $table) {
            $table->id(); 
            $table->string('title'); 
            $table->string('author'); 
            $table->string('description'); 
            $table->text('content'); 
            $table->string('url'); 
            $table->string('url_image'); 
            $table->datetime('published_at'); 
            $table->string('category'); 
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
