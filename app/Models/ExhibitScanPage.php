<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['path', 'exhibit_id', 'exhibit_scan_page_status_id'])]
class ExhibitScanPage extends Model
{
    public function exhibit()
    {
        return $this->belongsTo(Exhibit::class);
    }

    public function status()
    {
        return $this->belongsTo(ExhibitScanPageStatus::class, 'exhibit_scan_page_status_id');
    }

    public function externalImagesData(){
        return $this->hasMany(ExhibitScanPageExternalImageData::class);
    }
}
