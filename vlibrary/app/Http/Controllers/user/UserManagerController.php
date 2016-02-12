<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Http\Requests;
use App\Model\Book;
use App\Model\User;
use App\Model\SearchBook;
use App\Http\Controllers\Controller;

class UserManagerController extends Controller
{
   
     public $curUserId;

     public function showNotificationPage()
    {
     
        $name = array("alamin");

        if (Auth::check()) {
            $curUser = Auth::user();
            $this->curUserId = $curUser->id;
        //    $name = $curUserId;
          
        } else {
             $this->curUserId = -1;
        }


        $name = User::getNotifications($this->curUserId);
       // $name = $this->curUserId;
        return view('user.showNotificationPage' , ['name' => $name]);
        //
    }


    public function showlendedbooksPage()
    {
     
        $name = array("alamin");

        if (Auth::check()) {
            $curUser = Auth::user();
            $this->curUserId = $curUser->id;
        //    $name = $curUserId;
          
        } else {
             $this->curUserId = -1;
        }

        \Log::info("current user id");
        \Log::info($this->curUserId);
         \Log::info("current user id");
       $name = User::getLendedBooks($this->curUserId);
       // $name = $this->curUserId;
        return view('user.showlendedbooksPage' , ['name' => $name]);
        //
    }

    public function showborrowedbooksPage()
    {
     
        $name = array("alamin");

        if (Auth::check()) {
        //    $name = $curUserId;
            $curUser = Auth::user();
            $this->curUserId = $curUser->id;
          
        } else {
             $this->curUserId = -1;
        }

       $name = User::getBorrowedBooks($this->curUserId);
       // $name = $this->curUserId;
        return view('user.showborrowedbooksPage' , ['name' => $name]);
        //
    }

    public function showReviewUserPage()
    {
     
        $name = array("alamin");

        if (Auth::check()) {
            $curUser = Auth::user();
            $this->curUserId = $curUser->id;
        //    $name = $curUserId;
          
        } else {
             $this->curUserId = -1;
        }

        \Log::info("current user id");
        \Log::info($this->curUserId);
         \Log::info("current user id");
       $name = User::getReviewAbleUser($this->curUserId);
       // $name = $this->curUserId;
        return view('user.reviewUserPage' , ['name' => $name]);
        //
    }


     public function allUserReview()
    {
     
        $name = array("alamin");

       
      // $name = User::getReviewAbleUser($this->curUserId);
       // $name = $this->curUserId;

        DB::statement('CALL UserRep(@res);');
        $name = DB::select('select @res as res');

         $name = $name[0]->res;
        $arr1= explode(",", $name);
           $arr2 = array();

           for ($i=0; $i < count($arr1) ; $i++) { 
             
               $temp= explode(":", $arr1[$i]);
                $arr2[$i] = $temp;
           }


        return view('user.allUserReview' , ['name' => $arr2]);
        //
    }


     public function procedure()
    {

        DB::statement('CALL TopLocName(@res);');
        $topLocation = DB::select('select @res as res');

        DB::statement('CALL TopUser(@res);');
        $topBorrower = DB::select('select @res as res');
     
     


        return view('user.procedure', ['topLocation' => $topLocation,
            'topBorrower' => $topBorrower
             ]);
        //
    }








    public function index()
    {
     


        return view('user.userhomepage', ['ownedBookList' => $ownedBookList]);
        //
    }

    public function showAddCategoryPage()
    {
     
        $name = array("alamin");
        $CategoryName = Book::getCategory();      
       
        return view('user.addCategoryPage' , ['name' => $name,
         'CategoryName' => $CategoryName]);
       
    }

     public function addNewCategory(Request $request)
    {
     
        $name = array("alamin");
        $CategoryName = $request->input('CategoryName', 'CategoryName not set');
        Book::addToCategory($CategoryName);

        $CategoryName = Book::getCategory();
       
        return view('user.addCategoryPage' , ['name' => $name,
         'CategoryName' => $CategoryName]);
      
    }



    public function showAddLocationPage()
    {
     
        $name = array("alamin");
        $LocationName = Book::getLocations();
        return view('user.addLocationPage' , ['name' => $name,
         'LocationName' => $LocationName]);
      
    }

     public function addNewLocation(Request $request)
    {
     
        $name = array("alamin");
        $LocationName = $request->input('LocationName', 'CategoryName not set');
        Book::addToLocations($LocationName);        
        $LocationName = Book::getLocations();
       
        return view('user.addLocationPage' , ['name' => $name,
         'LocationName' => $LocationName]);
      
    }




      public function showUserProfile()
    {
     
        $name = array("alamin");
      
        $LocationName = Book::getLocations();
       
        return view('user.profilePage' , ['name' => $name,
         'LocationName' => $LocationName]);
        
    }

     public function updateUserProfile(Request $request)
    {
     
        $name = array("alamin");
        $LocationName = $request->input('LocationName', 'LocationName not set') ;

        $curUser = Auth::user();
        $userId = $curUser->id;
        Book::deleteFromUserLocations($userId);
        Book::addToUserLocations($userId, $LocationName);

         $LocationName = Book::getLocations();
        return view('user.profilePage' , ['name' => $name,
         'LocationName' => $LocationName]);
        //
    }
    
    
    



  
   
}
