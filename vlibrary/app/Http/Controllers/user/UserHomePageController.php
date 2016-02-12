<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserHomePageController extends Controller
{

    public function index()
    {
      //  $ownedBookList = DB::select('SELECT * FROM ownedbooklist where userId = ?;',[13]);
        $ownedBookList = DB::select('select * ' .
           ' from bookinfo B, ownedbooklist o ' .
           ' where (B.bookId = o.bookId) ' .
           ' and o.userId = ?;',[13]); 
                   


        return view('user.userhomepage', ['ownedBookList' => $ownedBookList]);
        //
    }

   
}
