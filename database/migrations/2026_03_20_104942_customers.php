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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('customer_code')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('customer_type_id');
            $table->unsignedBigInteger('membership_tier_id');
            $table->string('phone_number');
            $table->string('notes');
            $table->enum('status', ['ACTIVE', 'INACTIVE']);
            $table->integer('points_balance');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('customer_type_id')->references('id')->on('customer_types');
            $table->foreign('membership_tier_id')->references('id')->on('membership_tiers');
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
