<?php

use App\Enums\CampaignStatusEnum;
use App\Enums\CampaignTypeEnum;
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
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->timestamp('start_date');
            $table->timestamp('end_date');
            $table->enum('status', CampaignStatusEnum::allCaseValues())->default(0);
            $table->integer('priority')->default(0);
            $table->enum('type', CampaignTypeEnum::allCaseValues());
            $table->timestamps();

            $table->index(['status', 'start_date', 'end_date']);
            $table->index('priority');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaigns');
    }
};
