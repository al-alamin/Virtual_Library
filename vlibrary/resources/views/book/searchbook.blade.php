<!DOCTYPE html>
<html lang="en">
<head>
  <title>Search Book</title>
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
    
	</script>
	<script>
		$(document).ready(function(){
		   console.log ("in search page");
		   $authorNum = 1;
		   $(".author").hide();
		   $("#author1").show();

	      

		   $(".author").focus(function(){
	        $(this).css("background-color", "#cccccc");
	    	});

		    $(".author").blur(function(){

		        $(this).css("background-color", "#ffffff");
		        console.log($(this).val());
		        console.log( "in blur function with id " + $(this).attr("id"));
		        if ($(this).attr('id') === "author" + $authorNum) {
			        if ($(this).val() != "") {
			        	console.log ("we need to append a new author field");
			        	console.log ($(this).attr('id'));
			        	$authorNum += 1;
			        	$("#author" + $authorNum).show();


			        }
		   		}	

				if ($(this).attr('id') === ("author" + ($authorNum - 1))) {
					console.log ("trying to delete");
			        if ($(this).val() === "") {
			        	console.log ("we need to delete last author field");
			        	console.log ($(this).attr('id'));
			        	$authorNum -= 1;
			        	$("#author" + $authorNum).hide();


			        }
		   		}	


		    });


		  //  $(".cb1").prop('checked', true);


		});
</script>

  
	<script>
		$(document).ready(function(){
		   console.log ("in search page");
		   $authorNum = 1;
		   $(".author").hide();
		   $("#author1").show();

	      

		   $(".author").focus(function(){
	        $(this).css("background-color", "#cccccc");
	    	});

		    $(".author").blur(function(){

		        $(this).css("background-color", "#ffffff");
		        console.log($(this).val());
		        console.log( "in blur function with id " + $(this).attr("id"));
		        if ($(this).attr('id') === "author" + $authorNum) {
			        if ($(this).val() != "") {
			        	console.log ("we need to append a new author field");
			        	console.log ($(this).attr('id'));
			        	$authorNum += 1;
			        	$("#author" + $authorNum).show();


			        }
		   		}	

				if ($(this).attr('id') === ("author" + ($authorNum - 1))) {
					console.log ("trying to delete");
			        if ($(this).val() === "") {
			        	console.log ("we need to delete last author field");
			        	console.log ($(this).attr('id'));
			        	$authorNum -= 1;
			        	$("#author" + $authorNum).hide();


			        }
		   		}	


		    });


		});
</script>



</head>
<body>

<div class="container" >
  

  <?php
  		$user = Auth::user();
		echo ".........authencicated User......" . $user->email;
    	echo "<br> <br>";
    	
  ?> 

   <div id='cssmenu'>
	<ul>	  
	<li class='active'><a href='userhomepage'><span>Home</span></a></li>
	 <li > <a href="mybooks">  My Book List</a>	</li>  
	 <li> <a href="addbook">Add Book </a> </li>
	 <li><a href="profile">Profile </a> </li>
	 <li><a href="searchbook">Search Book </a> </li>
	 <li><a href="shownotifications">Show Notifications </a> </li>
	 <li><a href="showlendedbooks">Lended Books </a> </li>
	 <li> <a href="showborrowedbooks">Borrowed Books </a> </li>	 
	 <li><a href="reviewusers">Review Users </a> </li>
	 <li><a href="addcategory">Add New Category </a> </li>
	<li class='last'> <a href="addlocation">Add New Location </a> </li>
    <li class='last'><a href='#'><span>Contact</span></a></li>

	</ul>
</div>

  <h2 align="center">Search Book from the VLibrary</h2>
  <form action="" method="POST" class="form-horizontal">
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
   <div class="form-group">
      <label for="email">Book Name</label>
      <input type="text" class="form-control" id="book" placeholder="Enter book name" name="BookName">
    </div>
    <div class="form-group">

      <label for="author">AuthorName :</label>
      <input type="text" class="form-control author" id="author1" placeholder="Enter author name" name="AuthorName[]">
      <input type="text" class="form-control author" id="author2" placeholder="Enter author name" name="AuthorName[]">
      <input type="text" class="form-control author" id="author3" placeholder="Enter author name" name="AuthorName[]">
      <input type="text" class="form-control author" id="author4" placeholder="Enter author name" name="AuthorName[]">
      <input type="text" class="form-control author" id="author5" placeholder="Enter author name" name="AuthorName[]">
      <input type="text" class="form-control author" id="author6" placeholder="Enter author name" name="AuthorName[]">
      <input type="text" class="form-control author" id="author7" placeholder="Enter author name" name="AuthorName[]">
      <input type="text" class="form-control author" id="author8" placeholder="Enter author name" name="AuthorName[]">
      <input type="text" class="form-control author" id="author9" placeholder="Enter author name" name="AuthorName[]">
      <input type="text" class="form-control author" id="author10" placeholder="Enter author name" name="AuthorName[]">
    </div>

	

<!-- 
    <div class="form-group">
      <label for="pwd">Edition :</label>
      <input type="text" class="form-control" id="pwd" placeholder="Book edition" name="Edition">
    </div>

 -->




    







    <div class="form-group">
      <label for="pwd">Location :</label> <br>
		<div class="row">
		   

		    	<div class="col-sm-4" >
		     		@for ($i = 0; $i < count($LocationName); $i += 3)
		     		    <input type="checkbox" value="{{ $LocationName[$i][0] }}"
					     name="LocationName[]"  class="cb{{ $LocationName[$i][1] }}">
					      {{ $LocationName[$i][0] }} <br>					   
					   
			        @endfor              		  
			    </div>

			    <div class="col-sm-4" >
		     		@for ($i = 1; $i < count($LocationName); $i += 3)					   
					    <input type="checkbox" value="{{ $LocationName[$i][0] }}"
					     name="LocationName[]"  class="cb{{ $LocationName[$i][1] }}">
					      {{ $LocationName[$i][0] }} <br>
			       @endfor
			     	
			   	</div>
			     

			    <div class="col-sm-4" >		
		     		@for ($i = 2; $i < count($LocationName); $i += 3)					   
					     <input type="checkbox" value="{{ $LocationName[$i][0] }}"
					     name="LocationName[]"  class="cb{{ $LocationName[$i][1] }}">
					      {{ $LocationName[$i][0] }} <br>
					@endfor     
			   </div>		



	  	</div>      
    </div>


   
    <br> <br>
    <button type="submit" id="submit" class="btn btn-default">Search Book</button>

  </form>
  <br> <br>
</div>

</body>
</html>
