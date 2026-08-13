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

        $response = Http::withUrlParameters(['document_id' => $page->id])
        ->post($this->sendExhibitUrl, [
            'title'  => $page->exhibit->name,
            'body' => $page->scan_result . ' ' . $page->exhibit->description,
            'metadata' => (object) []
        ]);

        if ($response->successful()){
            return true;
        } else {
            Log::error($response->getReasonPhrase());
            return false;
        }
    }

    public function postCleanExhibit(Exhibit $exhibit) : bool {

        $response = Http::withUrlParameters(['document_id' => $exhibit->id])
        ->post($this->sendExhibitUrl, [
            'title'  => $exhibit->name,
            'body' => $exhibit->description,
            'metadata' => (object) []
        ]);

        if ($response->successful()){
            return true;
        } 
        else {
            Log::error('Failed to add document', [
                'status' => $response->status(),
                'body' => $response->json(),
            ]);
        }
        return false;
    }

    public function reindexCleanExhibit(Exhibit $exhibit): bool
    {
        $response = Http::withUrlParameters([
            'document_id' => $exhibit->id,
        ])->post($this->sendExhibitUrl . '/reindex');

        if ($response->successful()) {
            return true;
        }

        Log::error('Failed to reindex document', [
            'document_id' => $exhibit->id,
            'status' => $response->status(),
            'body' => $response->json(),
        ]);

        return false;
    }

}