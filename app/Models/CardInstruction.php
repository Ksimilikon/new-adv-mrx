<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class CardInstruction extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table="card_instructions";
    protected $fillable=[
        'number',
        'title',
        'description',
        'card_id',
    ];
    

    public function card(): BelongsTo{
        return $this->belongsTo(Card::class);
    }

    public function cardInstruction_has_image() : HasOne
    {
        return $this->hasOne(CardInstruction::class);
    }
}
