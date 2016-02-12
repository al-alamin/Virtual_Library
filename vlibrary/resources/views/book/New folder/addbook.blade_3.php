<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

    <script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.11.3.min.js">
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

<style type="text/css">
	input {
		
		margin-bottom: 5px;
	}

</style>

</head>
<body>

<div class="container" >
  

  <?php
  		echo "trying to find out if current user is authenticated or not " . '<br>';
  		if (Auth::check()) {
  			$user = Auth::user();
  			echo "<h1>.........authencicate......</h1>" . $user->email;  
  			var_dump($user);  	
		} else {
			echo "<h1>not.............not authenticated.... </h1>";
		}
		echo "<h3>php checking over</h3>";
  ?>

  <h2>Add new book to your collection</h2>
  <form action="http://localhost/laravel/vlibrary/public/index.php/addbook" method="POST" class="form-horizontal">
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

	


    <div class="form-group">
      <label for="pwd">Edition :</label>
      <input type="text" class="form-control" id="pwd" placeholder="Book edition" name="Edition">
    </div>

    <div class="form-group">
      <label for="pwd">Publishing Year :</label>
      <input type="text" class="form-control" id="pwd" placeholder="Publishing Year" name="PublishingYear">
    </div>

    <div class="form-group">
      <label for="pwd">Language :</label>
      <input type="text" class="form-control" id="pwd" placeholder="Language " name="Language">
    </div>

    <div class="form-group">
      <label for="pwd">Publishers :</label>
      <input type="text" class="form-control" id="pwd" placeholder="Publishers" name="Publishers">
    </div>

    <div class="form-group">
      <label for="pwd">Pages :</label>
      <input type="text" class="form-control" id="pwd" placeholder="Pages" name="PageNumbers">
    </div>



    <div class="form-group">
      <label for="pwd">Share Type :</label> <br>
		<div class="row">
		    <div class="col-sm-4" >
		      <input type="checkbox"  value="Read" name="ShareType[]"> Exchange Book to Read <br>
		      <!--  <input type="checkbox" name="vehicle" value="Bike"> <br> -->
		    </div>
		    <div class="col-sm-4" >
		      <input type="checkbox" value="Sell" name="ShareType[]"> Sell Book <br>
		    </div>
		    	<!-- <input type="checkbox" name="vehicle" value="Bike"> Azimpur<br> -->
		    <div class="col-sm-4" >		      
		    </div>
	  	</div>      
    </div>

    <?php

 //   	var_dump($CategoryName);

    ?>

    <div class="form-group">
      <label for="pwd">Catagory :</label> <br>
		<div class="row">
			<?php

		    
		     foreach ($CategoryName as $Category) {
		     //	   echo $Category->CategoryName;
		     //	  var_dump($Category->CategoryName);
		     	echo '<div class="col-sm-4" >';

                echo '<input type="checkbox"  value="' . $Category->CategoryName . '" name="CatagoryName[]"> '. $Category->CategoryName .' <br>';
		     //    <input type="checkbox" value="Medical" name="CatagoryName[]"> Medical <br>
			    	//
			    	echo '</div>';

			    echo	'<div class="col-sm-4" >';
			    echo   ' <input type="checkbox"  value="Novel" name="CatagoryName[]"> Novel <br>';
			    echo 	'<input type="checkbox"  value="Poem" name="CatagoryName[]"> Poem <br>';
			    
			   	echo	' </div>';
			     

			     echo  '<div class="col-sm-4" >	';	      
			    echo    '</div>';
	      
          	}
		      

		    ?>
	  	</div>      
    </div>

    <div class="form-group">
      <label for="pwd">Location :</label> <br>
		<div class="row">
		    <div class="col-sm-4" >
		      <input type="checkbox" name="vehicle" value="Dhaka" name="LocationName[]"> Dhaka<br>
		       <input type="checkbox" name="vehicle" value="Mirpur" name="LocationName[]"> Mirpur<br>
		    </div>
		    <div class="col-sm-4" >
		      <input type="checkbox" name="vehicle" value="Malibag" name="LocationName[]"> Malibag<br>
		    </div>
		    	<input type="checkbox" name="vehicle" value="Azimpur" name="LocationName[]"> Azimpur<br>
		    <div class="col-sm-4" >		      
		    </div>
	  	</div>      
    </div>

    <div class="form-group">
      <label for="pwd">Price :</label>
      <input type="text" class="form-control" id="pwd" placeholder="Price" name="Price">
    </div>


    <br> <br>
    <button type="submit" id="submit" class="btn btn-default">Add This Book</button>

  </form>
  <br> <br>
</div>

</body>
</html>
