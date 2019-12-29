<?php

use Illuminate\Database\Seeder;
use App\Temperature;
class TempTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Temperature::class, 50)->create();
    }
}
