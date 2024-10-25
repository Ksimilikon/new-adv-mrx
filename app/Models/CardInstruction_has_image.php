<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CardInstruction_has_image extends Model
{
    protected $fillable=[
        'card_instruction_id',
        'image_id'
    ];
    public function cardInstruction() : BelongsTo
    {
        return $this->belongsTo(CardInstruction::class);
    }
    public function image() : BelongsTo
    {
        return $this->belongsTo(Image::class);
    }
}
