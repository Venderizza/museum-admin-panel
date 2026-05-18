<?php

use App\Models\Exhibit;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('exhibit_photos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignIdFor(Exhibit::class)->constrained()->onDelete('cascade');
            $table->text('path');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exhibit_photos');
    }
};
