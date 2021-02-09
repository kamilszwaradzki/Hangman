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
        // easy - directory  <- Category 1
        $files = Storage::files('easy');
        $grouped = collect();

        foreach ($files as $file) {
            $content = Storage::get($file);
            $splittedContentCategories = Str::of($content)->split('/[\n]+/')->filter();
            $name_file = preg_filter("/easy\/(.*?)\.txt/", '$1', $file);
            foreach($splittedContentCategories as $word) {
                DB::table('words')->insert([
                    'word' => $word,
                    'difficulty' => 1,
                    'category' => $name_file
                ]);
            }
            $grouped = $grouped->concat($splittedContentCategories);
        }

        // medium - 60 random words from directory + 60 random words <- Category 2
        $content = Storage::get('words_alpha.txt');
        $splittedContentAlpha = Str::of($content)->split('/[\s\n]+/'); // storage/app/words_alpha.txt

        $randomedMediumAlphaWords = $splittedContentAlpha->random(60);
        $randomedCategoriesWords = $grouped->random(60);
        foreach($randomedMediumAlphaWords->merge($randomedCategoriesWords) as $word) {
            DB::table('words')->insert([
                'word' => $word,
                'difficulty' => 2,
                'category' => null
            ]);
        }
        // hard - 120 random words crossJoin(['3'])
        $randomedHardAlphaWords = $splittedContentAlpha->random(120);
        foreach($randomedHardAlphaWords->merge($randomedCategoriesWords) as $word) {
            DB::table('words')->insert([
                'word' => $word,
                'difficulty' => 3,
                'category' => null
            ]);
        }
    }
}
