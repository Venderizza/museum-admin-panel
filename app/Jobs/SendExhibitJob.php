<?php

namespace App\Jobs;

use App\Models\ExhibitScanPage;
use App\Services\AgentService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class SendExhibitJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public ExhibitScanPage $page){}

    /**
     * Execute the job.
     */
    public function handle(AgentService $service): void
    {
        $service->postExhibit($this->page);
    }
}
