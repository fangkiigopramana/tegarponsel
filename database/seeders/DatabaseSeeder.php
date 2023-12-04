<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'name' => "Admin",
            'email' => "admin@gmail.com",
            'role' => "admin",
            'username' => "admin",
            'password' => '$2y$10$TDwEP6LY1U5uIXv5DHSwJOdERNwdTsY9CcfiBfGhM.9tbAWxnq5GK'
        ]);

        $suppliers = [
            [
                'name' => 'ABC Distributor',
                'mobile_no' => '081234567890',
                'address' => '123 Main Street, Cityville',
                'status' => 1,
            ],
            [
                'name' => 'XYZ Suppliers',
                'mobile_no' => '081234567891',
                'address' => '456 Oak Avenue, Townsville',
                'status' => 1,
            ],
            // ... data supplier lainnya
            [
                'name' => 'Sample Supplier Co.',
                'mobile_no' => '081234567899',
                'address' => '789 Elm Street, Villageton',
                'status' => 1,
            ],
        ];

        foreach ($suppliers as $sup) {
            Supplier::create([
                'name' => $sup['name'],
                'mobile_no' => $sup['mobile_no'],
                'address' => $sup['address'],
                'status' => $sup['status']
            ]);
        }

        for ($i=0; $i < 10; $i++) { 
            Unit::create([
                'name' => 'Unit '.$i,
                'status' => 1
            ]);

            Category::create([
                'name' => 'Category '.$i,
                'status' => 1
            ]);
            
        }

        for ($i=0; $i < 10; $i++) { 
            Product::create([
                'supplier_id' => random_int(1,3),
                'unit_id' => random_int(1,10),
                'category_id' => random_int(1,10),
                'name' => 'Product '.$i,
                'price' => random_int(30000,500000),
                'stock' => random_int(1,40),
                'status' => 1
            ]);
        }
    }
}
