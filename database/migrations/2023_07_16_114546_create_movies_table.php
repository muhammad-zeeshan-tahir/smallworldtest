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
        Schema::create('movies', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title');
            $table->integer('episode_id');
            $table->text('opening_crawl');
            $table->string('director');
            $table->string('producer');
            $table->string('release_date');
            $table->string('url');
            $table->string('adult');
            $table->string('backdrop_path');
            $table->string('language');
            $table->string('popularity');
            $table->string('poster_path');
            $table->string('video');
            $table->string('vote_average');
            $table->string('vote_count');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};
