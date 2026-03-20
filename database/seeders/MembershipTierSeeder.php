<?php

namespace Database\Seeders;

use App\Models\MembershipTier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MembershipTierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MembershipTier::create([
            'tier_name' => 'Silver',
            'tier_rank' => '',
            'description' => 'Silver',
            'created_at' => null,
            'updated_at' => null,
        ]);

        MembershipTier::create([
            'tier_name' => 'Gold',
            'tier_rank' => '',
            'description' => 'Gold',
            'created_at' => null,
            'updated_at' => null,
        ]);
    }
}
