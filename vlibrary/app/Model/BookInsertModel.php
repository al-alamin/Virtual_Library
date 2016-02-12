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

class BookInsertModel extends Model
{
    public static function insertToMessageTable($a, $b) {

        

      \Log::info("above is owner array owner id");

      $date = date('Y-m-d H:i:s');
     
       DB::insert ("INSERT INTO message (OwnedBookListId, BorrowerId, RequestTime, ResponseTime, ResponseStatus)
      VALUES (?, ?, ?, NULL, NULL)",[$a, $b, $date]);
      \Log::info("trying to insernt in messege function");

    }

     public static function insertToBorrowHistoryTable($obli, $bi, $days) {
        \Log::info("trying to insernt in borrowhistory table form bookinsertmodel");
        $date = date('Y-m-d H:i:s');
        \Log::info($date);
        \Log::info("......above is the borrowdate");

        
         $date2 = strtotime(date("Y-m-d") . " +". $days ." day");
         $date3 = date("Y-m-d",$date2);

        DB::insert ("INSERT INTO borrowhistory (OwnedBookListId, BorrowerID, BorrowDate, ReturnDate, ActualRetrunDate)
       values (?, ?, ?, ?, NULL)",[$obli, $bi, $date, $date3]);

        \Log::info("............trying to insernt in borrowHistory table");

    }



    public static function updateBorrowHistoryTable($obli, $bi) {

  
       //  DB::insert ("INSERT INTO borrowhistory (OwnedBookListId, BorrowerID, BorrowDate, ReturnDate, ActualRetrunDate)
       // values (?, ?, NULL, NULL, NULL)",[$obli, $bi]);
        $date = date('Y-m-d H:i:s');
        \Log::info("date is ");
        \Log::info($date);
         DB::table('borrowhistory')
            ->where('OwnedBookListId', $obli)
            ->where ('borrowerId', $bi)
            ->update(['ActualRetrunDate' => $date]);

        \Log::info("trying to update borrow history in messege function");

    }


    public static function updateReputaionTable($obli, $bi ,$point) {

        $collection = DB::Table('reputation')
                  ->select(                    
                     '*'
                   ) 
                   
                   ->where('userId', $obli)
                   ->where('recipientId', $bi)
                     ;           
             
          
           $notifications = $collection->get();

           if (count($notifications) == 0) {
             DB::insert ("INSERT INTO `reputation` (`UserID`, `RecipientId`, `Point`)
              VALUES (?, ?, ?)",[$obli, $bi, $point]);
      
           } else {
            DB::table('reputation')
            ->where('userId', $obli)
            ->where ('recipientId', $bi)
            ->update(['point' => $point]);

           }

           \Log::info($notifications);
        
     
         

        \Log::info("........trying to update b.....reputation");

    }


		

	
}