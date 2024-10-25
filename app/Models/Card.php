<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Card extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "cards";

    protected $fillable = [
        'user_id',
        'title',
        'description',
    ];

    public function cardInstruction(): HasMany{
        return $this->hasMany(CardInstruction::class);
    }


    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }
    public function card_has_image() : HasOne{
        return $this->hasOne(card_has_image::class);
    }
}
