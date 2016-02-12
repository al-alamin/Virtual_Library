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
  <link rel="stylesheet" href="../resource/css/mycss.css">
  
	
	<script>
	
	</script>
</head>
<body>

<div class="container">
	<?php 
		$user = Auth::user();
		echo ".........authencicated User......" . $user->email;
		
  	?>
  	<div id='cssmenu'>
	<ul>	  
	<li class='active'><a href='userhomepage'><span>Home</span></a></li>
	 <li > <a href="mybooks">  My Book List</a>	</li>  
	 <li> <a href="addbook">Add Book </a> </li>
	 <li><a href="searchbook">Search Book </a> </li>
	 <li><a href="searchbook">Search Book </a> </li>
	 <li><a href="shownotifications">Show Notifications </a> </li>
	 <li><a href="showlendedbooks">Lended Books </a> </li>
	 <li> <a href="showborrowedbooks">Borrowed Books </a> </li>	 
	 <li><a href="reviewusers">Review Users </a> </li>
	 <li><a href="addcategory">Add New Category </a> </li>
	<li class='last'> <a href="addlocation">Add New Location </a> </li>
    <li class='last'><a href='#'><span>Contact</span></a></li>
    <li  class='last'> <a href="auth/logout">Log Out </a> </li>

	</ul>
</div>



  	<form action="" method="POST" class="form-horizontal">
	  	 <input type="hidden" name="_token" value="{{ csrf_token() }}">
	     <br><br><br>
	     <div class="form-group">
      		<label for="pwd">Write New Category Name: </label>
	    	 <input  name="CategoryName" placeholder="Add New Category">
	     </div>
	     
	     <button type="submit" id="submit" class="btn btn-default">Add This Category</button>

  	</form>


  	<br><br><br>
  	<br><br><br>
  	<div class="form-group">
      <label for="pwd">Available Categories</label> <br>
		<div class="row"> 

		     	<div class="col-sm-4" >
		     		@for ($i = 0; $i < count($CategoryName); $i += 3)					   
					    <input type="checkbox" value="{{ $CategoryName[$i]->CategoryName }}" 
					    name="CategoryName[]"> {{ $CategoryName[$i]->CategoryName }} <br>
			        @endfor              		  
			    </div>

			    <div class="col-sm-4" >
		     		@for ($i = 1; $i < count($CategoryName); $i += 3)					   
					    <input type="checkbox" value="{{ $CategoryName[$i]->CategoryName }}" 
					    name="CategoryName[]"> {{ $CategoryName[$i]->CategoryName }} <br>
			    	@endfor
			     	
			   	</div>
			     

			    <div class="col-sm-4" >		
		     		@for ($i = 2; $i < count($CategoryName); $i += 3)					   
					    <input type="checkbox" value="{{ $CategoryName[$i]->CategoryName }}"
					     name="CategoryName[]"> {{ $CategoryName[$i]->CategoryName }} <br>
			    
					@endfor     
			   </div>					


			    		
		     		  
	  	</div>      
    </div> 







</div>

</body>
</html>
