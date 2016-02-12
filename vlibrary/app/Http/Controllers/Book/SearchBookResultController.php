<?php

namespace App\Http\Controllers\Book;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SearchBookResultController extends Controller
{
    



     public function showSearchBookResultPage() {
     //   $CategoryName = Book::getCategory();
    //    $LocationName = Book::getLocations();
       //  \Log::info($LocationName);   

    //     \Log::info("category name print over");      
      //  return view ('book.searchbook',['CategoryName' => $CategoryName, 'LocationName' => $LocationName]);
    //    \Log::info($CategoryName);
        \Log::info("..........in showsearchResult page other controller Controller");
        return view('book.searchbookresult');
    }

}
