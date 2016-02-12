<?php

namespace App\Model;
use DB;
use Auth;
use App\Model\SearchBook;
use App\Model\Book;
use App\Model\AddBookModel;
use App\Model\GetBookModel;
use App\Model\BookInsertModel;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
	


    public static function addToOwnedBookList($bookId, $userId) {
             
         return AddBookModel::addToOwnedBookList($bookId, $userId);

    }

    public static function insertToMessageTable($a, $b) {
       BookInsertModel::insertToMessageTable($a, $b) ;
    }

    public static function insertToBorrowHistoryTable($obli, $bi, $days) {
         \Log::info("trying to insernt in borrowhistory table form book model");
        BookInsertModel::insertToBorrowHistoryTable($obli, $bi, $days);
    }



     public static function updateBorrowHistoryTable($obli, $bi) {
        BookInsertModel::updateBorrowHistoryTable($obli, $bi) ;       
    }

     public static function updateReputaionTable($obli, $bi ,$point) {
       BookInsertModel::updateReputaionTable($obli, $bi ,$point);
    }



   public static function addToBookInfoAuthors($bookId, $authorId) {

      DB::insert ('INSERT INTO bookinfoauthors (BookId, AuthorId) ' .
              ' VALUES (?, ?)', [$bookId, $authorId]);
	
    }

   
    public static function getBookId($BookName) {

    	    return GetBookModel::getBookId($BookName);    	
    }



    public static function getAuthorId($AuthorName) {      
          return GetBookModel::getAuthorId($AuthorName); 
    }



    public static function getCategory() {

          return GetBookModel::getCategory();

    }



    public static function getLocations() {

         return GetBookModel::getLocations();

    }

    public static function getLocationName() {

       $LocationName = DB::select(

         ' select LocationName, locationId ' .
           ' from Locations ; ') ;
          return $LocationName;

    }



    //returns a array of ownedbooklistId
    public static function getOwnedBookListId($userId) {
        //returning array not objects;
        return GetBookModel::getOwnedBookListId($userId);
    }


    // takes array as input

    public static function addToBookInfoCategory($bookId, $CategoryName) {
        AddBookModel::addToBookInfoCategory($bookId, $CategoryName) ;
    }



     public static function addToOwnedBookListLocations($ownedBookListId, $LocationName) {

        AddBookModel::addToOwnedBookListLocations($ownedBookListId, $LocationName);

    }


    public static function addToCategory($categoryName) {

        DB::insert("INSERT INTO `category` (`CategoryName`)
        VALUES (?);", [$categoryName]);

    }

     public static function addToLocations($LocationName) {

        DB::insert("INSERT INTO `locations` (`LocationName`)
        VALUES (?);", [$LocationName]);

    }

//$locationname is array of string locationName
     public static function addToUserLocations($userId, $LocationName) {
       AddBookModel::addToUserLocations($userId, $LocationName) ;
    }

    
    public static function deleteFromUserLocations($userId) {
       DB::table('userLocations')->where('userId', '=', $userId)->delete();
       
    }


    public static function getLocationIdFromUserLocations($userId) {

        $query = DB::table('userLocations')
                 ->select('locationId')
                 ->where('userId', $userId);

        $data = $query->get();

        return $data;


    }


//get all the book ids that match the bookname pattern returning objects
    public static function getBookIdsByBookName($bookName) {

        $query = DB::table('bookinfo')
                 ->select('*')
                 ->where('bookName', 'like', '%'. $bookName .'%');

        $data = $query->get();

        return $data;


    }










    






	

}
