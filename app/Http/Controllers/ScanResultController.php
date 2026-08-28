<?php

namespace App\Http\Controllers;

use App\Models\ExhibitScanPage;
use App\Models\ExhibitScanPageStatus;
use App\Models\ExhibitScanPageExternalImageData;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use PhpParser\Node\Stmt\Switch_;
use Symfony\Component\String\AbstractString;

class ScanResultController extends Controller
{
    public function receive(string $image_id, Request $request) {
        $validated = $request->validate([
            'text' => ['required', 'string'],
        ]);

        $imageData = ExhibitScanPageExternalImageData::with('scanPage')->where('image_id', $image_id)->first();
        Log::error("imageData: {$imageData}");
        if ($imageData == null){
            return response(null, 404);
        }
        $scanPage = $imageData->scanPage;
        Log::info($scanPage);

        $scanPage->scan_result=$validated['text'];
        $scanPage->exhibit_scan_page_status_id = ExhibitScanPageStatus::VERIFYING;
        $scanPage->save();
    }

    public function updateStatus(string $image_id, Request $request) {
        $validated = $request->validate([
            'status' => ['required', 'string'],
        ]);

        $imageData = ExhibitScanPageExternalImageData::with('scanPage')->where('image_id', $image_id)->first();
        Log::error("imageData: {$imageData}");

        if (in_array($imageData->scanPage->exhibit_scan_page_status_id, [
                ExhibitScanPageStatus::VERIFYING,
                ExhibitScanPageStatus::REFUSED,
                ExhibitScanPageStatus::VERIFIED])) {
            Log::info("The image {$image_id} was already proccesed");
            return;
        }

        switch($validated['status']) {
            case 'processing':
                $imageData->scanPage->exhibit_scan_page_status_id = ExhibitScanPageStatus::PROCESSING;
                break;
            case 'failed':
                $imageData->scanPage->exhibit_scan_page_status_id = ExhibitScanPageStatus::ERROR;
                break;
            default:
                break;
        }
        $imageData->scanPage->save();
    }
}
