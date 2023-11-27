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
            $table->string('email',50)->nullable(false)->unique();
            $table->timestamp('email_verified_at')->nullable(false);
            $table->string('password',255)->nullable(false);
            $table->tinyInteger('role')->nullable(false);
            $table->string('token',255)->nullable(false);
            $table->string('link_avatar',255)->nullable(false);
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
