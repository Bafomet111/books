<?php

use Illuminate\Database\Seeder;

class BookTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => 'Чужак'],
            ['name' => 'Мастер и Маргарита'],
            ['name' => 'Обломов']
        ];
        DB::table('books')
            ->insert($data);
    }
}
