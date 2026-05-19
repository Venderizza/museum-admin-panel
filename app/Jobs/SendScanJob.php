<?php

namespace App\Jobs;

use App\Models\ExhibitScanPage;
use App\Services\ScanService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class SendScanJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public ExhibitScanPage $page)
    {}

    /**
     * Execute the job.
     */
    public function handle(ScanService $service): void
    {
        $service->postScan($this->page);
    }
}
