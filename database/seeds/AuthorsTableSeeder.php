<?php

use Illuminate\Database\Seeder;

class AuthorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['first_name' => 'Стивен', 'last_name' => 'Кинг', 'middle_name' => ''],
            ['first_name' => 'Михаил', 'last_name' => 'Булгаков', 'middle_name' => 'Афанасьевич'],
            ['first_name' => 'Иван', 'last_name' => 'Гончаров', 'middle_name' => 'Александрович']
        ];
        DB::table('authors')
            ->insert($data);
    }
}
