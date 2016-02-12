<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Review User Page</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="../resource/css/bootstrap.min.css">  
  <script src="../resource/js/jquery.min.js"></script>
  <script src="../resource/js/bootstrap.min.js"></script>
  <script src="../resource/js/jquery-1.11.3.min.js"></script>

   <link rel="stylesheet" href="../resource/css/stylemenu.css">
  <link rel="stylesheet" href="../resource/css/mycss.css">
 

<script>	
	function onSuccess(data, status, xhr)
	{
		// with our success handler, we're just logging the data...
		console.log(data, status, xhr);
		// but you can do something with it if you like - the JSON is deserialised into an object
		console.log(String(data.value).toUpperCase());
	//	$("#div1").text("value form ajax: " + String(data.value));
		alert ("ajax successful");

	}
	$(document).ready(function() {
		var ownedBookListId;
		var borrowerId;
		// $("#myModal").modal('show');
		// $('#myModal').modal('show');
	//	$('#td1').hide();
	//	$("#curUser").hide();
		$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

	    $("button.baccept").click(function(event) {
	    //    alert(event.target.id);
	        userId = event.target.id ;
	        borrowerId = $(this).attr('value');
	     //   $.post('http://localhost/laravel/vlibrary/public/index.php/ajax/post', {'ownerId' : '1', 'borrowerOwnedBookListId' : ownedBookListId}, onSuccess);
	
    	
    	     alert(userId + "and borrerid " + borrowerId);
    	    
    	     
    	});

    	$("#lendBook").click(function(event) {
	 
    	 	var point = $("#point").val();
    	 	alert ("ui: " + userId + " borrowerId: " + 
    	 		borrowerId + " point: " + point);
    	     if ((isNaN(userId) || isNaN(borrowerId) || isNaN(point))) {
    	     	alert ("you cant see details you are not logged in");
    	     } else {

    	     	
    	     	if (point > 5) {
    	     		point = 5;
    	     	}
    	     //	alert("going to make ajax request");
    	     	 $.post('http://localhost/laravel/vlibrary/public/index.php/ajax/postreview', {'userId' : userId, 'borrowerId' : borrowerId, 'point' : point}, onSuccess);
		
    	     }
    	     
    	});





//	$.post('http://localhost/laravel/vlibrary/public/index.php/ajax/post', {'ownerId' : '1', 'borrowerId' : '2'}, onSuccess);
	
	});
</script>


</head>

<body>
	<meta name="csrf-token" content="<?php echo csrf_token() ?>" />
	<div class="container">

	

	<?php 
		//var_dump($name);
		



	 ?>

	 <h1 align="center">Review Users</h1>


	 <div id='cssmenu'>
	<ul>	  
	<li class='active'><a href='userhomepage'><span>Home</span></a></li>
	<li><a href="profile">Profile </a> </li>
	 <li > <a href="mybooks">  My Book List</a>	</li>  
	 <li> <a href="addbook">Add Book </a> </li>
	 <li><a href="searchbook">Search Book </a> </li>
	 
	 <li><a href="shownotifications">Show Notifications </a> </li>
	 <li><a href="showlendedbooks">Lended Books </a> </li>
	 <li> <a href="showborrowedbooks">Borrowed Books </a> </li>	 
	 <li><a href="reviewusers">Review Users </a> </li>
	 <li><a href="addcategory">Add New Category </a> </li>
	<li class='last'> <a href="addlocation">Add New Location </a> </li>
	<li  class='last'> <a href="auth/logout">Log Out </a> </li>
   
	</ul>
</div>



	 	<ul class="list-group">

	 		

			@for($i = 0; $i < count($name); $i++)
			  <li class="list-group-item">
			  		{{$name[$i]->userFullName}} has  borrowed  from you  and you Review Him... 
			  		<div align="right">
				  		<button id="{{ $name[$i]->id }}" 
				  		data-toggle="modal" class="baccept btn" 
				  		data-target="#myModal"
				  		value="{{$name[$i]->id}}">Review</button>
			  		</div>
			  		
			  </li>
			@endfor

	 		
		 
		</ul>

		<h4>Review User list over</h4>

		<button class="btn"><a href="alluserreview" 
    target="_blank">All Reviews are here</a> </button>




	<!-- 	<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>
 -->
		<!-- Modal -->
		<div id="myModal" class="modal fade" role="dialog">
		  <div class="modal-dialog">

		    <!-- Modal content-->
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h6 class="modal-title">Modal Header</h6>
		      </div>
		      <div class="modal-body">
		        <p>Review this user : </p>
		        <blockquote >
		        	Are you sure you want to send this review point??				
				</blockquote>
				Review Point <input type="text" name="point" id="point"> <br><br><br>
				<button id="lendBook">Review The User</button>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		      </div>
		    </div>

		  </div>
		</div>



  </div>
</body>
</html>