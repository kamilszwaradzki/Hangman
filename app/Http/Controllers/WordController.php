<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Str;
use DB;

class WordController extends Controller
{
    //
    public function isWordContainSelectedLetter(Request $request)
    {
        $id = $request->get('id');
        $letter = Str::lower($request->get('letter'));
        $s = DB::table('words')->where('id',$id)->value('word');
        $array = collect([]);
        for($i = 0; $i < strlen($s); $i++)
        {
            if($s[$i] == $letter){$array->push($i);};
        }
        return $array;
        //collection
        //-1 or [1,3,4] or 4
    }

    public function getModifiedRecord(Request $request)
    {
        $id = $request->get('id');
        
        $s = DB::table('words')->where('id',$id)->value('word');
        $array = [];
        for($i = 0; $i < strlen($s); $i++)
        {
            $array[$i]= '_';
        }
        return $array; // ['_','_','_'] etc.

    }

    public function getCountRecords()
    {
        return DB::table('words')->count();
    }
}
