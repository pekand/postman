<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Project;
use App\Models\Call;

class Request extends Model
{
    use HasFactory;

    protected $table = 'requests';

    protected $fillable = [
        'project_id',
        'name',
        'url',
        'method',
        'params',
    ];

    public function calls()
    {
        return $this->hasMany(Call::class, 'request_id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
}
