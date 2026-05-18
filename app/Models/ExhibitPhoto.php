<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['path', 'exhibit_id'])]
class ExhibitPhoto extends Model
{
    public function exhibit()
    {
        return $this->belongsTo(Exhibit::class);
    }
}
