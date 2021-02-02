<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;

class AccessTokens extends Model
{
    use HasFactory;

    protected $table = 'access_tokens';

    protected $fillable = [
        'access_token'
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->access_token = $this->uid();
    }

    public function uid($len = 32) { 
        $ch = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $out = "";
        for ($i=0; $i < $len; $i++) { 
            $out .= $ch[mt_rand(1, strlen($ch))-1];
        }
        return $out;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
