<?php

use App\Models\ExhibitScanPage;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('exhibit_scan_page_external_images_data', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignIdFor(ExhibitScanPage::class)->nullable()->constrained()->nullOnDelete();
            $table->string('image_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exhibit_scan_page_external_images_data');
    }
};
