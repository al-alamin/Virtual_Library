<?php

namespace App\Model;
use DB;

use Illuminate\Database\Eloquent\Model;

class SearchBook extends Model
{ 
    //return array of objects with ownedbooklistId
      // can optimize search by using book::getbookidsbybookname

    public static function getOwnedBooklistIdByBookName($bookName) {
     //  \Log::info("........in searchbook model ");
        $name = DB::Table('bookinfo')
                ->select('bookinfo.BookName', 
                  'bookinfo.bookId', 'ownedBookList.ownedBookListId', 'ownedBookList.userId')                
                ->join('ownedBookList', 'bookinfo.bookid', '=',
                 'ownedBookList.bookid')      
                 ->where('bookinfo.bookName', 'like', '%'. $bookName . '%')  
                 ->where('ownedBookList.isAvailable', 1 )     
                ->get();

        return $name;


    }

    //authorName is array of string authorNamr

     public static function getOwnedBooklistIdByAuthorName($AuthorName) {
     //  \Log::info("........in searchbook model ");

     //   \Log::info($AuthorName);
     //   \Log::info(".....above is AuthorName");   
        $query = DB::Table('bookinfoauthors')
                ->select( 
                   'ownedBookList.ownedBookListId')                
                ->join('ownedBookList', 'bookinfoauthors.bookid', '=',
                 'ownedBookList.bookid')   
                 ->join('authors', 'authors.authorId', '=', 'bookinfoauthors.authorId')   ;
        for ($i=0; $i < count($AuthorName) ; $i++) { 
             if(strlen($AuthorName[$i]) > 0){
                  if ($i == 0) {
                     $query->where('AUTHORS.AuthorName', 'like', '%'. $AuthorName[$i] . '%');
                 } else {
                     $query->orwhere('AUTHORS.AuthorName', 'like', '%'. $AuthorName[$i] . '%');

                 }  

             } 
            
        }
                
         $data = $query->get();

        return $data;


    }

    
   //locatio is array of string of location 
    // will return array of object containing ownedbooklistid

    public static function getOwnedBooklistIdByLocation($Location) {
     //  \Log::info("........in searchbook model ");
        \Log::info($Location);
        \Log::info(".....above is locationName");   


        $query = DB::Table('Locations')
                ->select( 
                   'ownedBooklocations.ownedBookListId')                
                ->join('ownedBooklocations', 'locations.locationid', '=',
                 'ownedBooklocations.locationid')   ;
        for ($i=0; $i < count($Location) ; $i++) {             
                  if ($i == 0) {
                     $query->where('Locations.locationName', 'like', '%'. $Location[$i] . '%');
                 } else {
                     $query->orwhere('Locations.locationName', 'like', '%'. $Location[$i] . '%');

                 }             
            
        }
                
         $data = $query->get();

        return $data;


    }




    public static function getBookInformation($ownedBookListId) {
     $collection = DB::Table('ownedBookList')
                      ->select(
                        'ownedBookList.ownedBookListId',
                        'bookinfo.bookName', 'bookinfo.edition', 'bookinfo.publishers',
                        'bookinfo.Language' , 'BOOKINFO.publishingYear'
                        
                        )
                      ->join('bookinfo', 'bookinfo.bookid', '=', 'ownedBookList.bookid');
                     

          for ($i = 0; $i < count($ownedBookListId); $i++) {
              if($i == 0) {
                   $collection->where('ownedBookList.ownedBookListId', $ownedBookListId[$i]);
              } else {
                $collection->orwhere('ownedBookList.ownedBookListId', $ownedBookListId[$i]);
              }
          }  

          $collection = $collection->orderby('ownedBookList.ownedBookListId');
           

            
          $bookInformation = $collection->get();

          return $bookInformation;


    }

   public static function getAuthorInformation($ownedBookListId) {
     $collection = DB::Table('ownedBookList')
                      ->select(
                        'ownedBookList.ownedBookListId',
                         'ownedBookList.bookId',
                         
                        'authors.authorName'
                        )
                      ->join('BOOKINFOAUTHORS', 'ownedBookList.bookid', '=', 'BOOKINFOAUTHORS.bookid')
                      ->join('AUTHORS','authors.authorId', '=', 'BOOKINFOAUTHORS.AUTHORID');
                      
      for ($i = 0; $i < count($ownedBookListId); $i++) {
              if($i == 0) {
                   $collection->where('ownedBookList.ownedBookListId', $ownedBookListId[$i]);
              } else {
               $collection->orwhere('ownedBookList.ownedBookListId', $ownedBookListId[$i]);
              }
          }  
          $collection = $collection->orderby('ownedBookList.ownedBookListId');
          $authorInformation = $collection->get();
          return $authorInformation;



   }


    public static function getCategoryInformation($ownedBookListId) {
     $collection = DB::Table('ownedBookList')
                      ->select(
                        'ownedBookList.ownedBookListId',
                         'ownedBookList.bookId',
                         
                        'category.categoryName'
                        )
                      ->join('BOOKINFOCATEGORY', 'ownedBookList.bookid', '=', 'BOOKINFOCATEGORY.bookid')
                      ->join('CATEGORY', 'CATEGORY.CATEGORYID', '=', 'BOOKINFOCATEGORY.CATEGORYID');
                      
     for ($i = 0; $i < count($ownedBookListId); $i++) {
              if($i == 0) {
                   $collection->where('ownedBookList.ownedBookListId', $ownedBookListId[$i]);
              } else {
               $collection->orwhere('ownedBookList.ownedBookListId', $ownedBookListId[$i]);
              }
          }  
         
                      
           $collection = $collection->orderby('ownedBookList.ownedBookListId');
          $categoryInformation = $collection->get();
          return $categoryInformation;



   }


    public static function getUserInformation($ownedBookListId) {
     $collection = DB::Table('ownedBookList')
                  ->select( 'ownedBookList.ownedBookListId',
                   'ownedBookList.bookId',
                   'user.id',   'ownedBookList.isAvailable', 'user.email',                 
                    'user.userFullName', 'user.phoneNo', 'user.mobileNo')
                   ->join('user', 'user.Id', '=', 'ownedBookList.userId')
                   ;
                      
            for ($i = 0; $i < count($ownedBookListId); $i++) {
            if($i == 0) {
                 $collection->where('ownedBookList.ownedBookListId', $ownedBookListId[$i]);
            } else{
             $collection->orwhere('ownedBookList.ownedBookListId', $ownedBookListId[$i]);
            }
           }  
            $collection = $collection->orderby('ownedBookList.ownedBookListId');
           $userInformation = $collection->get();

           return $userInformation;



   }



    public static function getbookLocationInformation($ownedBookListId) {
     $collection = DB::Table('ownedBooklocations')
                  ->select(                    
                    'ownedBooklocations.ownedBookListId','Locations.locationName'                                       
                   )                   
                   ->join('locations', 'locations.locationId',
                    '=', 'ownedbooklocations.locationId')
                   ->orderby('ownedBooklocations.ownedBookListId');

                      
            for ($i = 0; $i < count($ownedBookListId); $i++) {
            if($i == 0) {
                 $collection->where('ownedBooklocations.ownedBookListId', $ownedBookListId[$i]);
              } else {
               $collection->orwhere('ownedBooklocations.ownedBookListId', $ownedBookListId[$i]);
              }
             }  

              $collection = $collection->orderby('ownedBooklocations.ownedBookListId');
           $bookLocationInformation = $collection->get();

           return $bookLocationInformation;




   }

   // will return an array of obli integer not objects
   public static function getAllOwnedBookListId() {

      $query = DB::table('ownedBookList')
              ->select('ownedBookListId');

       $data = $query->get();

      // $ownedBookListId = array();

      // $i = 0;
      // foreach ($data as $key => $value) {
      //   $ownedBookListId[$i++] = $value->ownedBookListId;
      // }

      return $data;



   }






   



   






	
   












 






	

}












 // $collection = DB::Table('ownedBookList')
        //               ->select('bookinfo.bookName', 'bookinfo.edition', 'bookinfo.publishers',
        //                 'bookinfo.Language', 'ownedBookList.isAvailable',
        //                 'authors.authorName', 'CATEGORY.CATEGORYNAME', 
        //                 'user.userFullName', 'user.phoneNo', 'user.mobileNo')
        //               ->leftjoin('BOOKINFOAUTHORS', 'ownedBookList.bookid', '=', 'BOOKINFOAUTHORS.bookid')
        //               ->leftjoin('AUTHORS','authors.authorId', '=', 'BOOKINFOAUTHORS.AUTHORID')
        //               ->join('bookinfo', 'bookinfo.bookid', '=', 'ownedBookList.bookid')
        //               ->leftjoin('BOOKINFOCATEGORY', 'BOOKINFOCATEGORY.bookId', '=', 'BOOKINFO.bookId')
        //               ->leftjoin('CATEGORY', 'BOOKINFOCATEGORY.CATEGORYID', '=', 'CATEGORY.CATEGORYID')
        //               ->join('user', 'user.Id', '=', 'ownedBookList.userId')

        //               ->where('ownedBookList.ownedBookListId', $ownedBookListId[0]);
        //  for ($i = 0; $i < count($ownedBookListId); $i++) {
        //     if($i == 0) {
        //          $collection->where('ownedBookList.ownedBookListId', $ownedBookListId[$i]);
        //     }
        //      $collection->orwhere('ownedBookList.ownedBookListId', $ownedBookListId[$i]);
        //    }  

