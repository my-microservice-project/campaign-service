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
            $table->enum('type',CampaignTypeEnum::allCaseValues())->comment('Kampanya türü (order_total_discount, buy_x_get_y_free, category_discount)');
            $table->text('description')->nullable();
            $table->enum('active',CampaignStatusEnum::allCaseValues())->default(CampaignStatusEnum::ACTIVE->getValue());
            $table->timestamp('start_at')->nullable();
            $table->timestamp('end_at')->nullable();
            $table->integer('priority')->default(0);
            $table->timestamps();
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
