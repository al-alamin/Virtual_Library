<?php

namespace App\Http\Controllers\Book;

use Illuminate\Http\Request;
use App\Model\Book;
use Auth;
use App\Model\AddBookModel;
use App\Model\GetBookModel;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class BookController extends Controller
{


    public function store(Request $request)
    {
       
        $BookName = $request->input('BookName','bookname not found');
        $CategoryName = $request->input('CategoryName', 'CategoryName not set');
        $AuthorName = $request->input('AuthorName', 'AuthorName not set');
        $Price  = $request->input('Price', 'Price not set') ;
        $Language = $request->input('Language', 'Language not set') ;
        $PageNumbers = $request->input('PageNumbers', 'PageNumbers not set') ;
        $PublishingYear = $request->input('PublishingYear', 'PublishingYear not set');        
        $Publishers = $request->input('Publishers', 'Publishers not set');
        $ShareType = $request->input('ShareType', 'ShareType not set') ;
        $Edition = $request->input('Edition', 'Edition not set') ;
        $LocationName = $request->input('LocationName', 'LocationName not set') ;


        $all = $request->all();
     //   $arr = $request->input('CategoryName.0.name');
        \Log::info($CategoryName);

        \Log::info(".......all inputs are printed ");
      
     //   Book::addToBookInfo($request->BookName, $request->PublishingYear);
        
         $user = Auth::user();
        $userId = $user->id;
        $bookId = AddBookModel::addToBookInfo($BookName, $Publishers, $PublishingYear, $PageNumbers, $Price, $Language ,$Edition);
        AddBookModel::addToAuthors($AuthorName , $bookId);
       $ownedBookListId =  Book::addToOwnedBookList( $bookId, $userId);
        Book::addToBookInfoCategory($bookId, $CategoryName);
         Book::addToOwnedBookListLocations($ownedBookListId, $LocationName);
       



        \Log::info($userId);
        \Log::info('About to redirect .....');
      
        return redirect('/userhomepage');
    }




    public function showAddBookPage()
    {
        //
     //   \Log::info("in the showAddBookPage method");  

        $CategoryName = Book::getCategory();
        $LocationName = Book::getLocations();
         \Log::info($LocationName);   

         \Log::info("category name print over");      
        return view ('book.addbook',['CategoryName' => $CategoryName, 'LocationName' => $LocationName]);
    }


}
