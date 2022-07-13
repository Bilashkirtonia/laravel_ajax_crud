<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stdent extends Model
{
    use HasFactory;
    protected $table = 'stdents';
    protected $fillable =[
        'name','email','phone','course',
    ];
}
