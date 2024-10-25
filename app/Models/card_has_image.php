<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class card_has_image extends Model
{
    protected $table = 'card_has_images';
    protected $fillable = [
        'card_id',
        'image_id',
    ];
    public function card() : BelongsTo
    {
        return $this->belongsTo(Card::class);
    }
    public function image() : BelongsTo
    {
        return $this->belongsTo(Image::class);
    }
}
