<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Service extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price']; 

    protected $casts = [
        'price' => 'decimal:2', 
    ];

    public function nextspaces(): BelongsToMany
    {
        return $this->belongsToMany(Nextspace::class, 'nextspace_service');
    }
}
