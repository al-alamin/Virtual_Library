<?php

namespace App\Http\Controllers\Book;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Model\Book;
use App\Model\SearchBook;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class SearchBookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public  $bookName;
    public $authorName = "";
    public $bookId;
    public $edition;
    public $publishers;
    public $publishingYear;
  

    public $userFullName;
    public $userPhoneNo ;
    public $userMobileNo ;
    public $userIsAvailable;
    public $userId;
    public $locationName = "";
    public $categoryName = "";


    public function store(Request $request)
    {
     //   \Log::info ("in SearchBookController store method");
        $BookName = $request->input('BookName', 'BookName not set') ;      
        $AuthorName = $request->input('AuthorName', 'AuthorName not set');
        $LocationName  = $request->input('LocationName', '');
        $Edition =  $request->input('Edition', 'Edition not set') ; 
        $all = $request->all();


       $bookNameOwnedBookListId = SearchBook::getOwnedBooklistIdByBookName($BookName);
       if ($AuthorName[0] == '') {
           $authorNameOwnedBookListId = SearchBook::getAllOwnedBookListId() ;
       } else {
            $authorNameOwnedBookListId = SearchBook::getOwnedBooklistIdByAuthorName($AuthorName);
       }

       if ($LocationName == '') {
            $locationNameOwnedBookListId = SearchBook::getAllOwnedBookListId() ;
       } else {
            $locationNameOwnedBookListId = SearchBook::getOwnedBooklistIdByLocation($LocationName)  ;
       }


       $ownedBookListId1 = $this->getIntegerArrayOfOwnedBooklistId( $bookNameOwnedBookListId);
        $ownedBookListId2 = $this->getIntegerArrayOfOwnedBooklistId( $authorNameOwnedBookListId);
        $ownedBookListId3 = $this->getIntegerArrayOfOwnedBooklistId( $locationNameOwnedBookListId);

        $ownedBookListId = $this->calculateUniqueOwnedBookListId($ownedBookListId1, 
                            $ownedBookListId2, $ownedBookListId3);



       \Log::info($ownedBookListId);
       \Log::info("...*** .above is......got the ******final......");

       $bookInformation = SearchBook::getBookInformation($ownedBookListId);
       $authorInformation = SearchBook::getAuthorInformation($ownedBookListId);
       $userInformation = SearchBook::getuserInformation($ownedBookListId);
       $categoryInformation = SearchBook::getcategoryInformation($ownedBookListId);
       $onwedBookLocationInformation = SearchBook::getbookLocationInformation($ownedBookListId);

      

        $allInformation = array();

        for ($i=0; $i < count($ownedBookListId) ; $i++) { 
           
        

           $this->calculateBookInformation($bookInformation, $ownedBookListId[$i]);
           $this->calculateAuthorInformation($authorInformation, $ownedBookListId[$i]);
           $this->calculateCategoryInformation($categoryInformation, $ownedBookListId[$i]);
           $this->calculateUserInformation($userInformation, $ownedBookListId[$i]);
           $this->calculateOwnedBookLocationInformation($onwedBookLocationInformation, $ownedBookListId[$i]);
          
           $allInformation2 = array(
                            'ownedBookListId' => $ownedBookListId[$i],
                            'bookName' => $this->bookName,
                            'edition'  => $this->edition,
                            'publishingYear'  => $this->publishingYear,
                            'publishers'  => $this->publishers,
                            'userFullName'  => $this->userFullName,
                            'userPhoneNo'  => $this->userMobileNo,
                            'userMobileNo'  => $this->userMobileNo,
                            'authorName'  => $this->authorName,
                            'categoryName'  => $this->categoryName,
                            'locationName' => $this->locationName,
                            'userIsAvailable'  => $this->userIsAvailable

                        );


     //      \Log::info($allInformation);
        //   \Log::info("after all information");

            $this->authorName = "";
            $this->categoryName= "";
            $this->locationName= "";

            $allInformation[$i] = $allInformation2;


        }



            return view('book.searchbookresult',['bookInformation' => $bookInformation, 
                                'authorInformation' =>$authorInformation,
                    'categoryInformation' => $categoryInformation, 
                    'userInformation' => $userInformation, 
                    'onwedBookLocationInformation' => $onwedBookLocationInformation,
                    'ownedBookListId' => $ownedBookListId,
                    'allInformation' => $allInformation
                     ]);
    
    }


    public function showMyBooksPage()
     {


         $curUser = Auth::user();
  
       $ownedBookListId = Book::getOwnedBookListId($curUser->id);




       $bookInformation = SearchBook::getBookInformation($ownedBookListId);
       $authorInformation = SearchBook::getAuthorInformation($ownedBookListId);
       $userInformation = SearchBook::getuserInformation($ownedBookListId);
       $categoryInformation = SearchBook::getcategoryInformation($ownedBookListId);
       $bookLocationInformation = SearchBook::getbookLocationInformation($ownedBookListId);
       $onwedBookLocationInformation = SearchBook::getbookLocationInformation($ownedBookListId);



      

        $allInformation = array();

        for ($i=0; $i < count($ownedBookListId) ; $i++) { 
           
        

           $this->calculateBookInformation($bookInformation, $ownedBookListId[$i]);
           $this->calculateAuthorInformation($authorInformation, $ownedBookListId[$i]);
           $this->calculateCategoryInformation($categoryInformation, $ownedBookListId[$i]);
           $this->calculateUserInformation($userInformation, $ownedBookListId[$i]);
           $this->calculateOwnedBookLocationInformation($onwedBookLocationInformation, $ownedBookListId[$i]);
          
           $allInformation2 = array(
                            'ownedBookListId' => $ownedBookListId[$i],
                            'bookName' => $this->bookName,
                            'edition'  => $this->edition,
                            'publishingYear'  => $this->publishingYear,
                            'publishers'  => $this->publishers,
                            'userFullName'  => $this->userFullName,
                            'userPhoneNo'  => $this->userMobileNo,
                            'userMobileNo'  => $this->userMobileNo,
                            'authorName'  => $this->authorName,
                            'categoryName'  => $this->categoryName,
                            'locationName' => $this->locationName,
                            'userIsAvailable'  => $this->userIsAvailable

                        );



            $this->authorName = "";
            $this->categoryName= "";
           $this->locationName= "";

            $allInformation[$i] = $allInformation2;


        }

         $name = array("alamin");  
        return view('user.myBooksPage' , 
                    ['name' => $name,
                     'allInformation' => $allInformation
                    ]);




    }








    public function calculateBookInformation($bookInformation, $obi) {
        for ($i=0; $i < count($bookInformation); $i++) {         
            if ($bookInformation[$i]->ownedBookListId == $obi) {
                $this->bookName = $bookInformation[$i]->bookName; 
                $this->edition =  $bookInformation[$i]->edition;
                $this->publishers =  $bookInformation[$i]->publishers;
              //  $this->edition =  $bookInformation[$i]->edition;

                 $this->publishingYear =  $bookInformation[$i]->publishingYear;
              //    $bookId = $bookInformation[$i]->bookId;
               
                             
                break;        
            }          
        }
    }

   

    public function calculateAuthorInformation($authorInformation, $obi) {
        for ($i=0; $i < count($authorInformation); $i++) {         
            if ($authorInformation[$i]->ownedBookListId == $obi) {
               $this->authorName .= 'Aut: ' . $authorInformation[$i]->authorName . '<br>';
               
                             
                     
            }          
        }
    }

    public function calculateCategoryInformation($categoryInformation, $obi) {
        for ($i=0; $i < count($categoryInformation); $i++) {         
            if ($categoryInformation[$i]->ownedBookListId == $obi) {

              $this->categoryName .= 'C: ' . $categoryInformation[$i]->categoryName . '<br>';
                       
            }          
        }
    }

    public function calculateUserInformation($userInformation, $obi) {
        for ($i=0; $i < count($userInformation); $i++) {         
            if ($userInformation[$i]->ownedBookListId == $obi) {
               $this->userFullName = $userInformation[$i]->userFullName;
               $this->userPhoneNo = $userInformation[$i]->phoneNo;
               $this->userMobileNo = $userInformation[$i]->mobileNo;
               $this->userIsAvailable = $userInformation[$i]->isAvailable;
                
                 
          
               
                             
                break;        
            }          
        }
    }





    // this function will return array of ownbooklist id not objects
    // returning distinct ownedbooklistid
    public function getIntegerArrayOfOwnedBooklistId($name) {

        $ownedBookListId1 = array();
        for ($i=0; $i < count($name); $i++) { 
            $ownedBookListId1[$i] = $name[$i]->ownedBookListId;
            # code...
        }

        $ownedBookListId2 = array_unique($ownedBookListId1);


  
        $i = 0;
        $ownedBookListId = array();
        foreach ($ownedBookListId2 as $key => $value) {
           $ownedBookListId[$i++] = $value;
        }


        return $ownedBookListId;
    }

    public function showSearchBookPage() {
        $CategoryName = Book::getCategory();
        $LocationName = Book::getLocations();
   
        return view ('book.searchbook',['CategoryName' => $CategoryName, 'LocationName' => $LocationName]);

    
    }


    public function calculateUniqueOwnedBookListId($a , $b, $c) {

        $d = array_intersect($a, $b);
        $e = array_intersect($d, $c);

        $i = 0;
        $ownedBookListId = array();
        foreach ($e as $key => $value) {
             $ownedBookListId[$i++] = $value;
        }

        return $ownedBookListId;


    }


     public function calculateOwnedBookLocationInformation($onwedBookLocationInformation, $obi) {
        for ($i=0; $i < count($onwedBookLocationInformation); $i++) {         
            if ($onwedBookLocationInformation[$i]->ownedBookListId == $obi) {

              $this->locationName .= 'L: ' . $onwedBookLocationInformation[$i]->locationName . '<br>';
                       
            }          
        }
    }





}
