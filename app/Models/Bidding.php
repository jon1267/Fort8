<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bidding extends Model
{
    use HasFactory;
    protected $table = 'bidding';

    protected $fillable = [
        'instrument_id', 'trade_at', 'price', 'volume', 'description', 'display'
    ];

    protected $dates = ['trade_at',];

    public function instruments()
    {
        return $this->belongsTo(Instruments::class);
    }
}
