<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Str;
use DB;

class WordController extends Controller
{
    //
    public function getWord(Request $request)
    {
        $id = $request->get('id');
        $s = Str::of(DB::table('words')->where('id',$id)->value('word'))->upper();
        return $s;
    }
    public function isWordContainSelectedLetter(Request $request)
    {
        $letter = Str::lower($request->get('letter'));
        $s = collect( str_split( 
            DB::table('words')->where('id',$request->get('id'))->value('word') 
            ) );
        $filtered = $s->filter(function ($value, $key) use ($letter) {
            return $value == $letter;
        });          

        return $filtered->keys();
        //collection
        //-1 or [1,3,4] or 4
    }

    public function getModifiedRecord(Request $request)
    {
        $id = $request->get('id');
        $s = collect( str_split( DB::table('words')->where('id',$id)->value('word') ) );
        
        return $s->transform(function ($item, $key) {
            return '_';
        });
    }

    public function getCountRecords()
    {
        return DB::table('words')->count();
    }
}
