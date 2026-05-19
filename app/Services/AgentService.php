<?php

namespace App\Services;

use App\Models\Exhibit;
use App\Models\ExhibitScanPage;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class AgentService {

    public function __construct(protected string $sendExhibitUrl){}

    public function postExhibit(ExhibitScanPage $page) : bool {
        $page->load('exhibit');

        $response = Http::withUrlParameters(['id' => $page->id])
        ->post($this->sendExhibitUrl, [
            'title'  => $page->exhibit->name,
            'body' => $page->scan_result . ' ' . $page->exhibit->description,
        ]);

        if ($response->ok()){
            return true;
        } else {
            Log::error($response->getReasonPhrase());
            return false;
        }
    }
}