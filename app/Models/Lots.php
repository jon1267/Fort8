<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lots extends Model
{
    use HasFactory;

    protected $table = 'lots';

    protected $fillable = ['title', 'description'];
}
