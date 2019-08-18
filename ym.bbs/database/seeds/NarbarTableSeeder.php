<?php

use App\Models\Narbar;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NarbarTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $narBars = factory(Narbar::class)
            ->times(10)
            ->make();

        $narBars->toArray();

        DB::table('narbars')->insert($narBars->toArray());
    }
}
