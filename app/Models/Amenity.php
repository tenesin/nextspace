<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Nextspace;

class Amenity extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function nextspaces(): BelongsToMany
    {
        return $this->belongsToMany(Nextspace::class, 'nextspace_amenity'); // Specify pivot table name
    }
}
