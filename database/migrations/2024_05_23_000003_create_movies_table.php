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
            $table->id();
            $table->string('title',255);
            $table->string('time',50);
            $table->string('slug',255);
            $table->string('name_eng',255);
            $table->string('trailer',255);
            $table->integer('episodes');
            $table->text('description');
            $table->text('tags');
            $table->integer('status');
            $table->string('image',255);
            $table->foreignId('category_id')->constrained('categories');
            $table->string('thuocphim',50);
            $table->foreignId('genre_id')->constrained('genres');
            $table->foreignId('country_id')->constrained('countries');
            $table->integer('phim_hot');
            $table->integer('resolution');
            $table->integer('sub');
            $table->string('year',20);
            $table->string('season',50);
            $table->integer('topview');
            $table->integer('count_views');
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
