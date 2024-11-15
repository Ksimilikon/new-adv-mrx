<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Marked extends Model
{
    protected $table = 'markeds';
    protected $fillable = [
        'user_id',
        'card_id'
    ];
    public function card() : HasOne{
        return $this->hasOne(Card::class);
    }
    public function user() : BelongsTo{
        return $this->belongsTo(User::class);
    }
}
