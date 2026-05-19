<?php

namespace App\Http\Controllers;

use App\Models\ExhibitScanPage;
use App\Models\ExhibitScanPageStatus;
use Illuminate\Http\Request;

class ScanResultController extends Controller
{
    public function receive(ExhibitScanPage $page, Request $request) {
        $validated = $request->validate([
            'text' => ['required', 'string'],
        ]);

        $page->scan_result=$validated['text'];
        $page->exhibit_scan_page_status_id = ExhibitScanPageStatus::VERIFYING;
        $page->save();
    }
}
