<?php

namespace App\Model;
use DB;
use Auth;
use App\Model\SearchBook;
use App\Model\Book;
use App\Model\AddBookModel;
use App\Model\GetBookModel;
use Illuminate\Database\Eloquent\Model;

class AddBookModel extends Model
{
		public static function addToBookInfo($BookName, $Publishers, $PublishingYear,
   			$PageNumbers, $Price, $Language ,$Edition) {

     
          DB::insert ("INSERT INTO bookinfo 
          (BookName, Publishers, PublishingYear, PageNumbers, Price, Language, Edition)     
           VALUES (?, ?, ?, ?, ?, ?, ?)",
          [$BookName, $Publishers, $PublishingYear, $PageNumbers, $Price, $Language, 
          $Edition]);

          $lindex = DB::getPdo()->lastInsertId();
    
         return $lindex;

    
    }




     public static function addToAuthors($AuthorName, $bookId) {
    	
    	foreach ($AuthorName as $author) {
       

           	if (strlen($author) > 0) { 
             
                $index = Book::getAuthorId($author);
               
                if ($index < 0) 	{
                      DB::insert ('INSERT INTO authors (AuthorName) ' .
                      ' VALUES (?)', [$author]); 
                      $index = DB::getPdo()->lastInsertId();            
                }

                Book::addToBookInfoAuthors($bookId, $index);


           		}    	
                    
          }

    
	
    }



    public static function addToUserLocations($userId, $LocationName) {

        $query = DB::table('Locations')
                 ->select('locationId');

        for ($i=0; $i < count($LocationName); $i++) { 
             if ($i == 0) {
                $query->where('LocationName', $LocationName[$i]);
             } else {
                 $query->orwhere('LocationName', $LocationName[$i]);
             }
        }

        $locationId = $query->get();
        // location id is array of locationId objects

     //   \Log::info($locationId);
     //   \Log::info("......categoryIds.");

        for ($i=0; $i < count($locationId); $i++) { 
           DB::insert("INSERT INTO `userlocations` (`UserID`, `LocationId`)
          VALUES (?, ?);",[$userId, $locationId[$i]->locationId ]);

        }


    }




     public static function addToOwnedBookListLocations($ownedBookListId, $LocationName) {

        $query = DB::table('Locations')
                 ->select('locationId');

        for ($i=0; $i < count($LocationName); $i++) { 
             if ($i == 0) {
                $query->where('LocationName', $LocationName[$i]);
             } else {
                 $query->orwhere('LocationName', $LocationName[$i]);
             }
        }

        $locationId = $query->get();

        \Log::info($locationId);
        \Log::info("......categoryIds.");

        for ($i=0; $i < count($locationId); $i++) { 
           DB::insert("INSERT INTO `ownedbooklocations` (`OwnedBookListId`, `LocationId`)
            VALUES (?, ?);",[$ownedBookListId, $locationId[$i]->locationId ]);

        }


    }



     public static function addToBookInfoCategory($bookId, $CategoryName) {

        $query = DB::table('category')
                 ->select('categoryId');

        for ($i=0; $i < count($CategoryName); $i++) { 
             if ($i == 0) {
                $query->where('CategoryName', $CategoryName[$i]);
             } else {
                 $query->orwhere('CategoryName', $CategoryName[$i]);
             }
        }

        $categoryId = $query->get();

        \Log::info($categoryId);
        \Log::info("......categoryIds.");

        for ($i=0; $i < count($categoryId); $i++) { 
           DB::insert("INSERT INTO `bookinfocategory` (`BookId`, `CategoryId`)
           VALUES (?, ?);",[$bookId, $categoryId[$i]->categoryId ]);

        }


    }


    public static function addToOwnedBookList($bookId, $userId) {
         DB::insert ("INSERT INTO `ownedbooklist` (`BookId`, `UserID`, `Sharetype`, `IsAvailable`)
                    VALUES (?, ?, NULL, 1)", [$bookId, $userId]); 
        
         $lindex = DB::getPdo()->lastInsertId();     
         return $lindex;

    }




	
}