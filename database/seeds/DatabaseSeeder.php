<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        /*factory(App\User::class, 10)->create();
        factory(App\Categories::class,10)->create();
        factory(App\Product::class, 100)->create();
        factory(App\Customer::class, 100)->create();
        factory(App\Supplier::class,100)->create();
        factory(App\Rate::class, 1)->create();
        factory(App\Bill::class, 100)->create();
        factory(App\Order::class,1000)->create();
        factory(App\Buy::class, 50)->create();
        factory(App\Buydetail::class, 400)->create();
        factory(App\Quotation::class, 25)->create();
        factory(App\Quotationdetail::class, 350)->create();
        $this->call(RoleTableSeeder::class);*/
        factory(App\User_role::class, 15)->create();
    }
}
