<?php

use App\Enums\ActionTypeEnum;
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
        Schema::create('actions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('campaign_id')->constrained()->onDelete('cascade');
            $table->enum('type',ActionTypeEnum::allCaseValues());
            $table->decimal('value', 10, 2);
            $table->integer('min_affected_items')->nullable();
            $table->integer('max_affected_items')->nullable();
            $table->decimal('max_discount_amount', 10, 2)->nullable();
            $table->json('additional_data')->nullable();
            $table->integer('priority')->default(0);
            $table->timestamps();

            $table->index(['campaign_id', 'type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('actions');
    }
};
