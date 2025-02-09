<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('incompatible_campaigns', function (Blueprint $table) {
            $table->id();
            $table->foreignId('campaign_id')->constrained()->onDelete('cascade');
            $table->foreignId('incompatible_campaign_id')->constrained('campaigns')->onDelete('cascade');
            $table->timestamps();
            
            $table->unique(['campaign_id', 'incompatible_campaign_id']);
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('incompatible_campaigns');
    }
}; 