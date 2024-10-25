<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'extension',
        'size',
        'height',
        'width',
    ];
    public function card_has_image(): HasOne{
        return $this->card_has_image(card_has_image::class);
    }
    public function cardInstruction_has_image() : HasOne {
        return $this->cardInstruction_has_image(CardInstruction::class);
    }
}
