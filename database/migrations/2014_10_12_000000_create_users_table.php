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
            $table->integer("id")->primary();
            $table->string('username')->nullable(false);
            $table->string('email', 255)->nullable(false)->unique();
            $table->string('link_avatar', 255)->nullable(false);
            $table->string('password', 255)->nullable(false);
            $table->tinyInteger('role')->nullable(false);
            $table->timestamp('email_verified_at')->nullable(false);
            $table->string('token_veryfy_email', 255)->nullable(false);
            $table->timestamp('token_reset_password_create_at');
            $table->string('token_reset_password', 255)->unique();
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
