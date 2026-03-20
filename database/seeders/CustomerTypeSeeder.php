<?php

namespace Database\Seeders;

use App\Models\CustomerType;
use Illuminate\Database\Seeder;

class CustomerTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CustomerType::create([
            'type_name' => 'Individual',
            'description' => 'Individual',
            'created_at' => null,
            'updated_at' => null,
        ]);

        CustomerType::create([
            'type_name' => 'Company',
            'description' => 'Company',
            'created_at' => null,
            'updated_at' => null,
        ]);

        CustomerType::create([
            'type_name' => 'Individual',
            'description' => 'Contractor',
            'created_at' => null,
            'updated_at' => null,
        ]);
    }
}
