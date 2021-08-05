<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class repo extends Model
{
    use HasFactory;
    //json vao db mass
    protected $fillable = [
        'name',
        'link'
    ];
    protected $hidden = [
        'created_at'
    ];
}
