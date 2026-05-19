<?php

namespace App\Services;

use App\Models\Exhibit;
use App\Models\ExhibitScanPage;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ScanService {

    public function __construct(protected string $sendScanUrl){}

    public function postScan(ExhibitScanPage $page) : bool {
        $page->load('exhibit');

        $response = Http::withUrlParameters(['id' => $page->id])
        ->attach('body', Storage::disk('public')->get($page->path))
        ->post($this->sendScanUrl, [
            'title'  => $page->exhibit->name
        ]);

        if ($response->ok()){
            return true;
        } else {
            Log::error($response->getReasonPhrase());
            return false;
        }
    }
}