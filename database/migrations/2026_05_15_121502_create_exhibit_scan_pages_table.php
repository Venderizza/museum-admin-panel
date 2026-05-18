<?php

use App\Models\Exhibit;
use App\Models\ExhibitScanPageStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('exhibit_scan_pages', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignIdFor(Exhibit::class)->nullable()->constrained()->nullOnDelete();
            $table->foreignIdFor(ExhibitScanPageStatus::class)->default(1)->constrained();
            $table->string('path');
            $table->text('scan_result')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exhibit_scan_pages');
    }
};
