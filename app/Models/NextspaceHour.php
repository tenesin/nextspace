<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\Nextspace;

class NextspaceHour extends Model
{
    protected $fillable = ['nextspace_id', 'day_type', 'open_time', 'close_time'];
    public function nextspace()
    {
        return $this->belongsTo(Nextspace::class);
    }
}