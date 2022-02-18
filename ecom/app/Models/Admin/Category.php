<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $attributes = [
        'image' => false,
        'status'=>1
    ];
    use HasFactory;
}
?>