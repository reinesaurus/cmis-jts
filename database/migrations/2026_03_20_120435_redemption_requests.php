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
        Schema::create('redeem_code', function (Blueprint $table) {
            $table->id();
            $table->string('redeem_code');
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('reward_id');
            $table->unsignedBigInteger('decided_by');
            $table->date('decided_at');
            $table->date('redeem_date');
            $table->integer('point_cost');
            $table->integer('points_earned');
            $table->enum('status', ['PENDING', 'APPROVED', 'REJECTED']);
            $table->string('notes');
            $table->timestamps();

            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('reward_id')->references('id')->on('rewards');
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
