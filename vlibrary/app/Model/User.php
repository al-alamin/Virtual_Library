<?php

namespace App\Model;
use DB;
use App\Model\SearchBook;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
   public static function getNotifications($userId) {
        \Log::info("in get notification function");
        $collection = DB::Table('message')
                  ->select(                    
                     'message.ownedBookListId', 'message.borrowerId',
                      'ownedBookList.userId',
                     'bookinfo.bookid', 'bookinfo.bookName',
                     'user.userFullName' 

                   ) 
                   ->join('ownedBooklist', 'ownedBooklist.ownedBooklistId', '=', 'message.ownedBooklistId')
                   ->join('user', 'user.id', '=', 'message.borrowerId')
                   ->join('bookinfo', 'ownedBooklist.bookid', '=', 'bookinfo.bookid')  
                   ->where('ownedBooklist.userId', $userId)  ;           
             
           //   $collection = $collection->orderby('');
           $notifications = $collection->get();

           \Log::info("in get notification function returning");


       return $notifications;
   }




   public static function getLendedBooks($userId) {
        \Log::info("in get notification function");
        $collection = DB::Table('borrowHistory')
                  ->select(                    
                     'borrowHistory.ownedBookListId', 'borrowHistory.borrowerId',
                      'borrowHistory.borrowDate',  'borrowHistory.returnDate',
                      'ownedBookList.userId',
                     'bookinfo.bookid', 'bookinfo.bookName',
                     'user.userFullName' 

                   ) 
                   ->join('ownedBooklist', 'ownedBooklist.ownedBooklistId', '=', 'borrowHistory.ownedBooklistId')
                   ->join('user', 'user.id', '=', 'borrowHistory.borrowerId')
                   ->join('bookinfo', 'ownedBooklist.bookid', '=', 'bookinfo.bookid')  
                   ->where('ownedBooklist.userId', $userId)
                   ->whereNull('borrowHistory.ActualRetrunDate')  ;           
             
           //   $collection = $collection->orderby('');
           $notifications = $collection->get();

           \Log::info("in get notification function returning");


       return $notifications;
   }


   public static function getBorrowedBooks($userId) {
        \Log::info("in get notification function");
        $collection = DB::Table('borrowHistory')
                  ->select(                    
                     'borrowHistory.ownedBookListId', 'borrowHistory.borrowerId',
                      'borrowHistory.borrowDate',  'borrowHistory.returnDate',
                      'ownedBookList.userId',
                     'bookinfo.bookid', 'bookinfo.bookName',
                     'user.userFullName' 

                   ) 
                   ->join('ownedBooklist', 'ownedBooklist.ownedBooklistId', '=', 'borrowHistory.ownedBooklistId')
                   ->join('user', 'user.id', '=', 'ownedBooklist.userId')
                   ->join('bookinfo', 'ownedBooklist.bookid', '=', 'bookinfo.bookid')  
                   ->where('borrowHistory.borrowerId', $userId)
                   ->whereNull('borrowHistory.ActualRetrunDate')  ;           
             
           //   $collection = $collection->orderby('');
           $notifications = $collection->get();

           \Log::info("in get notification function returning");


       return $notifications;
   }







   public static function getReviewAbleUser($userId) {
        \Log::info("in get notification function");
        $collection = DB::Table('borrowHistory')
                  ->select(                    
                     'borrowHistory.ownedBookListId', 'borrowHistory.borrowerId',
                      'borrowHistory.borrowDate',  'borrowHistory.returnDate',
                      'ownedBookList.userId',
                     'bookinfo.bookid', 'bookinfo.bookName',
                     'user.userFullName' ,
                     'reputation.RecipientId',
                     'reputation.point'

                   ) 
                   ->join('ownedBooklist', 'ownedBooklist.ownedBooklistId', '=', 'borrowHistory.ownedBooklistId')
                   ->join('user', 'user.id', '=', 'borrowHistory.borrowerId')
                   ->join('bookinfo', 'ownedBooklist.bookid', '=', 'bookinfo.bookid') 
                   ->join('reputation', 'reputation.RecipientId', '=',
                    'borrowHistory.borrowerId') 
                   ->where('ownedBooklist.userId', $userId)
                    ;           
             
           //   $collection = $collection->orderby('');
           $notifications = $collection->get();


        $query = DB::Table('borrowHistory')
                  ->select(                    
                     'borrowHistory.borrowerId'

                   ) 
                  ->join('ownedBooklist', 'ownedBooklist.ownedBooklistId', '=', 'borrowHistory.ownedBooklistId')
                  ->where('ownedBooklist.userId', $userId);
        $data = $query->distinct()->get();

           \Log::info($data);


           \Log::info(".........borrwoer ids");

        $query = "";
         $query = DB::Table('user')
                  ->select(                    
                     'user.userFullName', 'user.id'

                   ) ;
                  
                 

        for ($i=0; $i < count($data) ; $i++) { 
            
                  if ($i == 0) {
                     $query->where('user.Id', $data[$i]->borrowerId);
                 } else {
                     $query->orwhere('user.Id', $data[$i]->borrowerId);

                 }  

             
            
        }

        $data = $query->get();
         \Log::info($data);
           \Log::info(".......in get notification function returning");


        return $data;


     

         //  $notifications = "alamin";
    //   return $notifications;
   }


	
  

	

}
