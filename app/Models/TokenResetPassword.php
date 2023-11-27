<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TokenResetPassword extends Model
{
    use HasFactory;

    protected $table='token_reset_passwords';
    protected $fillable=[
        'id',
        'user_id',
        'created_at',
        'token',
        'is_used',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
