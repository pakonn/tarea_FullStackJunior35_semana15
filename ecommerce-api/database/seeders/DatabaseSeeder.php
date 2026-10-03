<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        /*
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        */
        ///
        $user_seed= User::factory()->create([
            'name' => 'Francisco Ramos',
            'email' => 'pakonn@kpo.com',
            'password' => Hash::make('Contra.777')
        ]);  
        
        $product_seed=Product::factory(5)->create();
        //Product::factory(5)->create();
        
        $order_seed=Order::factory(5)->create([
            'user_id'=>$user_seed->id
        ]);
        
        foreach ($order_seed as $order) {
            foreach ($product_seed as $product) {
                OrderItem::factory()->create([
                    'order_id'   => $order->id,
                    'cantidad'   => 1,
                    'product_id' => $product->id
                ]);
            }
        }
        
    }
}
