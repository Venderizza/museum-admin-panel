<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['name', 'description', 'arrived_at'])]
class Exhibit extends Model
{
    public function photos()
    {
        return $this->hasMany(ExhibitPhoto::class);
    }
    public function scanPages()
    {
        return $this->hasMany(ExhibitScanPage::class);
    }
}
