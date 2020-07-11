<?php

use Illuminate\Database\Seeder;

class WordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $contents = Storage::get('words_alpha.txt'); // storage/app/words_alpha.txt
        $contents =  Str::of($contents)->split('/[\s\n]+/');
        foreach($contents as $row)
        DB::table('words')->insert([
            'word' => $row
        ]);
    }
}
