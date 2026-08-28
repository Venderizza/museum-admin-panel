<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class ExhibitScanPageExternalImageData extends Model
{
    protected $table = 'exhibit_scan_page_external_images_data';
    protected $fillable = ['image_id', 'exhibit_scan_page_id'];

    public function scanPage(){
        return $this->belongsTo(ExhibitScanPage::class, "exhibit_scan_page_id");
    }
}
