<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use SoftDeletes;
    protected $table = 'tags';
    protected $fillable = [
        'tag',
    ];
    public function card_has_tag() : HasMany{
        return $this->hasMany(card_has_tag::class);
    }
}
