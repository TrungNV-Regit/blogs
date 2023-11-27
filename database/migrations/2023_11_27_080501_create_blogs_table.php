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
        Schema::create('blogs', function (Blueprint $table) {
            $table->integer("id")->primary()->autoIncrement();
            $table->string('title',255)->nullable(false);
            $table->text('content')->nullable(false);
            $table->string('link_image',255)->nullable();
            $table->integer('user_id')->nullable(false);
            $table->integer('category_id')->nullable(false);
            $table->tinyInteger('status')->nullable();
            $table->timestamp('created_at')->default(now());
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
