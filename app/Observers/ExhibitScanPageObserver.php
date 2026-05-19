<?php

namespace App\Observers;

use App\Jobs\SendExhibitJob;
use App\Jobs\SendScanJob;
use App\Models\ExhibitScanPage;
use App\Models\ExhibitScanPageStatus;
use App\Services\ScanService;

class ExhibitScanPageObserver
{
    /**
     * Handle the ExhibitScanPage "created" event.
     */
    public function created(ExhibitScanPage $exhibitScanPage): void
    {
        SendScanJob::dispatch($exhibitScanPage);
    }

    /**
     * Handle the ExhibitScanPage "updated" event.
     */
    public function updated(ExhibitScanPage $exhibitScanPage): void
    {
        if (
            $exhibitScanPage->wasChanged('exhibit_scan_page_status_id') &&
            $exhibitScanPage->exhibit_scan_page_status_id === ExhibitScanPageStatus::VERIFIED
        ) {
            SendExhibitJob::dispatch($exhibitScanPage);
        }
    }

    /**
     * Handle the ExhibitScanPage "deleted" event.
     */
    public function deleted(ExhibitScanPage $exhibitScanPage): void
    {
        //
    }

    /**
     * Handle the ExhibitScanPage "restored" event.
     */
    public function restored(ExhibitScanPage $exhibitScanPage): void
    {
        //
    }

    /**
     * Handle the ExhibitScanPage "force deleted" event.
     */
    public function forceDeleted(ExhibitScanPage $exhibitScanPage): void
    {
        //
    }
}
