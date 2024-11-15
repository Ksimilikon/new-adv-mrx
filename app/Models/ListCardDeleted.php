<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ListCardDeleted extends Model
{
    protected $fillable = [
        'card_id', 
        'user_id',
        'role_id'
    ];
    public function user() : BelongsTo{
        return $this->belongsTo(User::class);
    }
    public function card() : BelongsTo{
        return $this->belongsTo(Card::class);
    }
    public function role() : HasOne{
        return $this->hasOne(role::class);
    }
}
