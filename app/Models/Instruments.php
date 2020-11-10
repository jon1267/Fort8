<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instruments extends Model
{
    use HasFactory;

    protected $table = 'instruments';

    protected $fillable = ['title', 'description'];

    public function bidding()
    {
        return $this->hasMany(Bidding::class, 'instrument_id', 'id');
    }
}
