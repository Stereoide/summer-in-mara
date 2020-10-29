<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
		'island_id',
    ];
	
	/* Relationships */
	
	public function island()
	{
		return $this->belongsTo(Island::class);
	}
	
	public function items()
	{
		return $this->belongsToMany(Item::class);
	}
}
