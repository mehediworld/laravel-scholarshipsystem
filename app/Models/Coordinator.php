<?php

namespace App\Models;

use App\Models\Application;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Coordinator extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'users_id'
    ];

    public function coordinator(){

        $this->hasMany(Application::class, 'coordinators_id');
    }
}
