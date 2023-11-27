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
        Schema::create('token_reset_passwords', function (Blueprint $table) {
            $table->id();
            $table->integer("user_id")->nullable(false);
            $table->timestamps();
            $table->string("token", 255)->unique;
            $table->boolean("is_used")->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('token_reset_passwords');
    }
};
