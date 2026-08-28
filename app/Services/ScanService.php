<?php

namespace App\Services;

use App\Models\Exhibit;
use App\Models\ExhibitScanPage;
use App\Models\ExhibitScanPageExternalImageData;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;


class ScanService {

    public function __construct(protected string $sendScanUrl){}

    public function postScan(ExhibitScanPage $page) : bool {
        $page->load('exhibit');

        $response = Http::attach('file', Storage::disk('public')
            ->get($page->path), $page->path, ['Content-Type' => 'image/jpeg'])
            ->post($this->sendScanUrl, [
            'title'  => $page->exhibit->name
        ]);

        if ($response->ok()){
            $data = $response->json();
            $imageId = $data['image_id'];
            Log::error("1");

            ExhibitScanPageExternalImageData::create([
                'image_id' => $imageId,
                'exhibit_scan_page_id' => $page->id,
            ]);

            return true;
        } else {
            Log::error($response->getReasonPhrase());
            return false;
        }
    }
}
