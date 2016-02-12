<?php

namespace App\Model;
use DB;
use Auth;
use App\Model\SearchBook;
use App\Model\Book;
use App\Model\AddBookModel;
use App\Model\GetBookModel;
use Illuminate\Database\Eloquent\Model;

class GetBookModel extends Model
{
	public static function getCategory() {

       $CategoryName = DB::select(

         ' select CategoryName, categoryId ' .
           ' from category ; ') ;

          return $CategoryName;

    }


     public static function getLocations() {

    	 $LocationName = Book::getLocationName();
       //will return an array of objects
       $curUser = Auth::user();
        $userId = $curUser->id;
       $userLocations = Book::getLocationIdFromUserLocations($userId);

       $userLocationId = array();

       for ($i=0; $i < count($userLocations) ; $i++) { 
          $userLocationId[$i] = $userLocations[$i]->locationId;
       }

       $LocationName2 = array();

       for ($i=0; $i < count($LocationName) ; $i++) { 
           if (in_array($LocationName[$i]->locationId, $userLocationId)) {
               $temp = array($LocationName[$i]->LocationName, '1'); 
           } else {
              $temp = array($LocationName[$i]->LocationName, '0'); 

           }

           $LocationName2[$i] = $temp;
       }

  //     \Log::info($LocationName2);
   //    \Log::info("..........returning complex cat name");
        



          return $LocationName2;

    }

    // return bookId integer by matching bookname string
    public static function getBookId($BookName) {

      $collection = DB::Table('bookinfo')
                  ->select(                    
                     'bookId'
                   ) 
                   
                   ->where('bookName', $BookName)
                     ;           
             
          
           $notifications = $collection->first();
           if (count($notifications) < 1) {
            return -1;
           }
    	    return $notifications->bookId;

    	
    }


     public static function getAuthorId($AuthorName) {

       $collection = DB::Table('authors')
                  ->select('authorId')                    
                   ->where('authorName', $AuthorName);  
           $notifications = $collection->first();
           if (count($notifications) < 1) {
            return -1;
           }
          return $notifications->authorId;

 
    }


     //returns a array of ownedbooklistId
    public static function getOwnedBookListId($userId) {

       $collection = DB::Table('ownedbooklist')
                  ->select('ownedbooklistId')                    
                   ->where('userId', $userId);  
        $notifications = $collection->get();

        $ownedbooklistId = array();
        for ($i=0; $i < count($notifications); $i++) { 
            $ownedbooklistId[$i] = $notifications[$i]->ownedbooklistId;
        }

        //returning array not objects;
        return $ownedbooklistId;
           


    }





	
}