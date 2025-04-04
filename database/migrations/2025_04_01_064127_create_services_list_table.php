<?php

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
        Schema::create('services_list', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('service_id');
            $table->boolean('is_by_agreement')->default(false);
            $table->boolean('is_hourly_type')->default(false);
            $table->boolean('is_work_type')->default(false);
            $table->decimal('hourly_payment', 12, 2)->nullable();
            $table->decimal('work_payment',  12, 2)->nullable();
            $table->boolean('is_active')->default(false);    
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services_list');
    }
};