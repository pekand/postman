<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Request;

class Call extends Model
{
    use HasFactory;

    protected $table = 'calls';

    protected $fillable = [
        'request_id',
        'url',
        'method',
        'params',
        'response',
    ];

    public function request()
    {
        return $this->belongsTo(Request::class, 'request_id');
    }
}
