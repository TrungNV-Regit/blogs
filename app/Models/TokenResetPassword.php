<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TokenResetPassword extends Model
{
    use HasFactory;

    protected $table = 'token_reset_passwords';

    protected $fillable = [
        'user_id',
        'token',
        'is_used',
    ];
    
}
