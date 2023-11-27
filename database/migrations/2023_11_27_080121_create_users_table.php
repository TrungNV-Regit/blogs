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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->nullable(false);
            $table->string('email', 255)->nullable(false)->unique();
            $table->string('link_avatar', 255)->nullable(false);
            $table->string('password', 255)->nullable(false);
            $table->tinyInteger('role')->nullable(false);
            $table->timestamps();
            $table->string('token_verify_email', 255)->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
