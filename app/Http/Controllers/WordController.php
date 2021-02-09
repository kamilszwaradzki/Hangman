<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Str;
use DB;

class WordController extends Controller
{
    const difficulties = [
            1 => 0,
            2 => 151,
            3 => 271
        ];
    /*
     *
     *   Route::get('wholeword/{difficulty}/{id}','WordController@getWord');
     *
     */
    public function getWord($difficulty, $id)
    {
        $s = Str::of(DB::table('words')->where('difficulty',$difficulty)->where('id',self::difficulties[$difficulty]+$id)->value('word'))->upper();
        return $s;
    }
    
    /*
     *   Route::get('contain/{difficulty}/{id}','WordController@isWordContainSelectedLetter');
     *
     */
    public function isWordContainSelectedLetter(Request $request,$difficulty,$id)
    {
        $letter = Str::lower($request->get('letter'));
        $s = collect( str_split( 
                DB::table('words')->where('difficulty',$difficulty)->where('id',self::difficulties[$difficulty]+$id)->value('word') 
            ) );
        $filtered = $s->filter(function ($value, $key) use ($letter) {
            return $value == $letter;
        });          

        return $filtered->keys();
        //collection
        //-1 or [1,3,4] or 4
    }

    /*
    *   
    *   Route::get('modified/{difficulty}/{id}','WordController@getModifiedRecord');
    *  
    */
    public function getModifiedRecord($difficulty, $id)
    {
        $word = DB::table('words')->where('difficulty',$difficulty)->where('id',self::difficulties[$difficulty]+$id)->get();
        $s = collect( str_split(
                    $word->first()->word
                ) );
        return [$s->transform(function($item, $key){
            return ($item !== '&' && $item !== ' ') ? '_' : $item;
        }),$word->first()->category];
    }

    /*
    *
    *  Route::get('count/{difficulty}','WordController@getCountRecords');
    * 
    */
    public function getCountRecords($difficulty)
    {
        return DB::table('words')->where('difficulty',$difficulty)->count();
    }
}