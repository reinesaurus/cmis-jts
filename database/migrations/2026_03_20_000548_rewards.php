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
        Schema::create('rewards', function (Blueprint $table) {
            $table->id();
            $table->string('reward_code');
            $table->string('reward_name');
            $table->enum('reward_type', ['PROMO','DISCOUNT', 'CACHBACK', 'FREEBIE', 'OTHER']);
            $table->enum('reward_status', ['ACTIVE','INACTIVE']);
            $table->integer('point_costs');
            $table->integer('redeem_amount_limit');
            $table->date('redeem_start_at');
            $table->date('redeem_end_at');
            $table->string('description');
            $table->unsignedBigInteger('created_by');
            $table->timestamps();

            $table->foreign('created_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
