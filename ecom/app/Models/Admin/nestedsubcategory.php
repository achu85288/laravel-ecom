<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NestedSubCategory extends Model
{
    protected $attributes = [
        'status'=>1
    ];
    use HasFactory;
}
