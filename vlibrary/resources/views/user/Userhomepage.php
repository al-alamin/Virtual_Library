<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="../resource/css/bootstrap.min.css">  
  <script src="../resource/js/jquery.min.js"></script>
  <script src="../resource/js/bootstrap.min.js"></script>
  <script src="../resource/js/jquery-1.11.3.min.js"></script>

  <link rel="stylesheet" href="../resource/css/stylemenu.css">

   <style type="text/css">
	  body {
	  	background-color: #FAFAD2;
	  	font-family: "Times New Roman", Georgia, Serif;
	  	color: 	#00008B;
	  }

	  input[type="text"] {
	  	background-color: 	#D3D3D3;
	  }

	  form {
	  	 width: 50%;
	  	 margin-right:auto;
	  	  margin-left:auto;"

	  }

	  input {		
			margin-bottom: 5px;
		}

	  h1, h2 {
	  	color: #00FF00;
	  }


	  label {
	  	color: #00CED1;
	  	font-size:15pt;
	  }

	  button.btn{
	  	background-color: #00FF00 !important;
	  }


  </style>
	
	
</head>
<body>

<div class="container">
	  <?php 
		$user = Auth::user();
		// echo ".........authencicated User......" . $user->email;
		
  		?>





  
  <div id='cssmenu'>
	<ul>
	   <!-- <li class='active'><a href='#'><span>Home</span></a></li> -->
	  <!--  <li><a href='mybooks'><span>Products</span></a></li>
	    <li><a href='mybooks'>Products</a></li>
	   
	   <li><a href='#'><span>Company</span></a></li> -->
	  



	<!--  <li class='active'> <a href="profile"> Profile </a> </li> -->
     <li class='active'><a href=''><span>Home</span></a></li>
     <li><a href="profile">Profile </a> </li>
	 <li > <a href="mybooks">  My Book List</a>	</li>  
	 <li> <a href="addbook">Add Book </a> </li>
	 <li><a href="searchbook">Search </a> </li>
	 
	 <li><a href="shownotifications">Show Notifications </a> </li>
	 <li><a href="showlendedbooks">Lended Books </a> </li>
	 <li> <a href="showborrowedbooks">Borrowed Books </a> </li>	 
	 <li><a href="reviewusers">Review Users </a> </li>
	 <li><a href="addcategory">Add New Category </a> </li>
	<li > <a href="addlocation">Add New Location </a> </li>
    <li ><a href='procedure'><span>Procedures</span></a></li>

    <li  class='last'> <a href="auth/logout">Log Out </a> </li>



	</ul>
</div>
  <div class="btn-group">
	    
	 <!-- <a href="profile"><button type="button" class="btn btn-primary" >Profile</button> </a>

	 <a href="mybooks">  <button type="button" class="btn btn-primary">My Book List</button></a>	  
	 <a href="addbook"><button type="button" class="btn btn-primary" >Add Book</button> </a>
	 <a href="searchbook"><button type="button" class="btn btn-primary" >Search Book</button> </a>
	 <a href="shownotifications"><button type="button" class="btn btn-primary" >Show Notifications</button> </a>
	 <a href="showlendedbooks"><button type="button" class="btn btn-primary" >Lended Books</button> </a>
	  <a href="showborrowedbooks"><button type="button" class="btn btn-primary" >Borrowed Books</button> </a>
	 
	 <a href="reviewusers"><button type="button" class="btn btn-primary" >Review Users</button> </a>
	 <a href="addcategory"><button type="button" class="btn btn-primary" >Add New Category</button> </a>
	 <a href="addlocation"><button type="button" class="btn btn-primary" >Add New Location</button> </a> -->
	 


  </div>

  <h2 align="center">Virtual Library </h2>





  <br> <br>



  <h3>This websites UI is not very attractive nor intuitive. 
  Hence Pls Read the Instructions.

  </h3>

  <h4><p>Search Book and How to borrow books 
  describes most part of the system
  </p> </h4>

  <br>
  <br>
  <h2 align="center">Instruction:</h2>

	<h3>Profile:</h3>
		When you register and log in to the system for the first time click on Profile to update you location info.
		Here you will find a list of locations <b>(dynamically generated) </b> to choose. If you dont find your location in the list then click on Add New Location to add your location to our system location list.
		you can select multiple locations. Suppose you live at Mirpur 12 but you also regulary come Shabag ie you are available to Shabag too then select Marpur 12 and Shabag too

	<h3>Add New Location:</h3>
		If you find that your location is not availabe on that list then click on Add new location and add your location to the location list.
		When you add a new location it will be saved to the system database and when other people log in they will be able to see the location.

	<h3>Add New Category:</h3>
	    It is just like Add New Location
	    If you find that your desired book category is not availabe on that list then click on Add new category and add your category to the category list.
		When you add a new category it will be saved to the system database and when other people log in they will be able to see the category.


	<h3>My Book List:</h3>
		Here you will find the information the books you have.
		Basically it will show the collection of your books

		When you Add a new book Through Add New Book that new book information will appear here



	<h3>Lended books:</h3>
		It will show the list of books that you have so far lended to other users ie person or other user(library)
		when they return the book it will be removed from this list

	<h3>Borrowed books:</h3>
		It will show the list of books that you have so far borrowed from other users ie person or other user(library)
		when you return the book it will be removed from this list


	<h3>Show Notification:</h3>
		When a user search and find your book in the search result if he wants to borrow that book form you then he will send you a request to borrow.

		When you log in to the system you will be able to see the request in the notification

		If the owner wants to lend the book then he will have to click lend books. Then another window will appear asking the owner for how many days he wants to borrow the book. If he confirms then the borrowed book list and owned book list will be updated


	<h3>Add Book:</h3>
		Through this system users will be able to add new book info to the system

		<h5>Author name: </h5>
		  you can add multiple auther name. when you write one author name dynamically other author name will appear
		<h5>Category: </h5>
		  Category list is dynamically generated not hard coded. Read about Add new Cagegory system
		  you can select mulple category for one book

		<h5>Location: </h5>
		  Location list is dynamically generated not hard coded. Read about Add new Location system



		  you can select mulple location for one book.
		  A book can be available in multile location that is a user might live in two place(you now live in one place but you can also lend this book to other people from your office/school/ college) or a book shop might have two branch location

		  Initially the location you selected for you location from the profile tab will be selected.
		  You can deselect those location and even select another location



	<h1 align="center">Search Book:</h3>
	    This is the most important feature of this system.
	    There is several ways you can search a book:
	    <ul>
		     <li> Search by book name </li>
		   <li> Search by auther name: you can add multiple auther name. 
		   As you write one auther name space to write another auther 
		   name will appear </li>
		    <li> You can search book by location. You 
		    can select multiple location.</li>
		    	

	    
	   
	    <li> You can combine these 3 option ie
	    search by a) book name and location 
                  b) book name auther name
                  c) auther name location
                  and so on
        </li>
         </ul>
	    If you dont select any of these then all the books in the database will appear



<h1 align="center">How to borrow a book:</h3>
	<p>First click on search book and search for a book.
	Then a search result will appear and from that  click on details on any of the result
	Then a new window will appear and prompt you if you 
	want to send the owner a request
	If you agree then it will use AJAX to send a request to
	the owner
	</p>
	<p>
	When the owner log in to the system he will see a notification
	If the owner wants to lend the book then he will have to click lend books. Then another window will appear asking the owner for how many days he wants to borrow the book. If he confirms then the borrowed book list and owned book list will be updated
	</p>

<h3>Review User:</h3>
	The users who borrowed books from you can be reviewed by you. You can give them a review point from 1 to 5










  



</div>

</body>
</html>
