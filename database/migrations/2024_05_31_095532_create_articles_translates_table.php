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
        Schema::create('articles_translates', function (Blueprint $table) {
            $table->id(); 
            $table->foreignId('article_id')->constrained()->onDelete('cascade');
            $table->string('title', 100); 
            $table->string('description', 255); 
            $table->text('text'); 
            $table->string('lang', 2); // ენის ინდექსი : ka, en ...
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles_translates');
    }
};
