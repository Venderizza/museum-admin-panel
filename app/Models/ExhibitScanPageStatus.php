<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExhibitScanPageStatus extends Model
{
    public function exhibitScanPage()
    {
        return $this->hasMany(ExhibitScanPage::class);
    }
}
