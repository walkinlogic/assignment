<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PhraseController extends Controller
{
 
   public function EnterData(){
    return view('pages.phrase');
}


// Analyse Data
public function Analyse(Request $request){
    
    // Validation
    $this->validate($request,[
        'phrase'=>'required'
    ]);
   $string = $request->phrase;
   $string_array = str_split($string); //split string to array of chars
   $string_chars =[];
   foreach ($string_array as  $value) {// remove what not alphabetical 
       if(preg_match('/[a-zA-Z]/', $value))
       {
           $string_chars []=$value;
       }
   }
   $chars_count = array_count_values($string_chars); //count how many times char repeated in array
   $data = [];
   foreach ($chars_count as $key => $value) {
       $data[$key] = $this->BeforeAndAfter($key,$string_chars);
       if($value >= 2 )
       {
           
           $data[$key] .=  $this->find_max_distance($key,$string,$string_array);
       }
   }
   return view('pages.statistical-analysis',['chars' => $chars_count , 'data' => $data]);
}


// Get Before and After Char. Fun.
public function BeforeAndAfter($char,$array){
    $count = count($array);
    $data  ;
    $before = []; 
    $after = []; 
    for ( $i=0; $i<$count; $i++ ) {
        if($char == $array[$i])
        {
            //first char
            if($i != 0)
            {
                if(!in_array($array[$i-1], $before))
                {
                    $before[]=$array[$i-1] ;
                }
            }
            //last char
            if($i != $count-1)
            {
                if(!in_array($array[$i+1], $after))
                {
                    $after[]=$array[$i+1] ;
                }
            }
        }
    }
        $a = count( $after)  ? implode(', ', $after) : "none" ;
        $b = count( $before)  ? implode(', ', $before) : "none" ;
        $data  = " before : " . $a . " ,   after : "  . $b ;
    return $data ;
}


// Calc max distance Fun
public function find_max_distance($key, $string, $string_array){
    $string_len = strlen($string);
    $result = -1;
    for ($i = 0; $i < $string_len - 1; $i++){
        for ($n = $i + 1; $n < $string_len; $n++){
            // if character , calculate the distance and keep the maximum
            if($string_array[$i] == $key && $string_array[$i] == $string_array[$n]) 
                $result = max($result, abs($n - $i - 1));
        }
    }
    return ' , max-distance: '.$result.' chars ';
}
}
