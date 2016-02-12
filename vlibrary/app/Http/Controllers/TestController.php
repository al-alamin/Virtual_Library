<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $name = array('alamin');

     //    $query = DB::table('bookinfo')
     //            ->select( 'bookId')
     //            ;
     //    $data = $query->get();

     // //   

     //    $json  = json_encode($data);
     //    $data = json_decode($json, true);


     //    $name = array_column($data, 'bookId');
     //   $name =  $data;

        DB::statement('CALL abc(@res);');
        $name = DB::select('select @res as res');


     //   $b = "";
      //  $name = DB::select ("CALL abc('@b')");

     //   $name = array(array_values($name[0]), $name[1]);
      //  $name = array_values($name);

        return view('test.testView', ['name' => $name]);

    }
}

        
