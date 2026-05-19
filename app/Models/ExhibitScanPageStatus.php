<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExhibitScanPageStatus extends Model
{
    const int WAITS = 1;
    const int PROCESSING = 2;
    const int ERROR = 3;
    const int VERIFYING = 4;
    const int VERIFIED = 5;
    const int REFUSED = 6;
    public function exhibitScanPage()
    {
        return $this->hasMany(ExhibitScanPage::class);
    }
}
