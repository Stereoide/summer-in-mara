<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /* Relationships */

    public function characters()
    {
        return $this
            ->belongsToMany(Character::class)
            ->orderBy('name')
            ->with('island')
            ->withPivot('priceSell', 'priceBuy');
    }

    public function sourceItems()
    {
        return $this
            ->belongsToMany(Item::class, null, 'item_id', 'source_item_id')
            ->orderBy('name')
            ->withPivot('amount');
    }
}
