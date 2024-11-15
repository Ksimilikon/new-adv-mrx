<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class card_has_tag extends Model
{
    use SoftDeletes;
    protected $table = 'card_has_tags';
    protected $fillable = [
        'card_id',
        'tag_id',
    ];
    public function card() : BelongsTo
    {
        return $this->belongsTo(Card::class);
    }
    public function tags() : BelongsTo
    {
        return $this->belongsTo(Tag::class);
    }
}
