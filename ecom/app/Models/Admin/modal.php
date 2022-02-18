<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class modal extends Model
{
    protected $attributes = [
        'status'=>1
    ];
    use HasFactory;
}
