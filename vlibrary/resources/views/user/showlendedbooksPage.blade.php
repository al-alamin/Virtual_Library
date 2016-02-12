<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Login Page</title>
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
	        ownedBookListId = event.target.id ;
	        borrowerId = $(this).attr('value');
	     //   $.post('http://localhost/laravel/vlibrary/public/index.php/ajax/post', {'ownerId' : '1', 'borrowerOwnedBookListId' : ownedBookListId}, onSuccess);
	
    	//	$('#td1').show();
    	     alert(ownedBookListId + "and borrerid " + borrowerId);
    	     // console.log(borrowerId);
    	     // var curUser = $('#curUser').attr('value');

    	     // if ((isNaN(ownedBookListId) || isNaN(borrowerId))) {
    	     // 	alert ("you cant see details you are not logged in");
    	     // } else {

    	     // //	alert("going to make ajax request");
    	     // 	$.post('http://localhost/laravel/vlibrary/public/index.php/ajax/postborrow', {'ownedBookListId' : ownedBookListId, 'borrowerId' : borrowerId}, onSuccess);
		
    	     // }
    	     
    	});

    	$("#lendBook").click(function(event) {
	    //    alert(event.target.id);
	      //  ownedBookListId = event.target.id ;
	     //   borrowerId = $(this).attr('value');
	     //   $.post('http://localhost/laravel/vlibrary/public/index.php/ajax/post', {'ownerId' : '1', 'borrowerOwnedBookListId' : ownedBookListId}, onSuccess);
	
    	//	$('#td1').show();
    	     alert(ownedBookListId + "and borrerid " + borrowerId);
    	 //    console.log(borrowerId);
    	 //    var curUser = $('#curUser').attr('value');

    	     if ((isNaN(ownedBookListId) || isNaN(borrowerId))) {
    	     	alert ("you cant see details you are not logged in");
    	     } else {

    	     //	alert("going to make ajax request");
    	     	 $.post('http://localhost/laravel/vlibrary/public/index.php/ajax/postlended', {'ownedBookListId' : ownedBookListId, 'borrowerId' : borrowerId}, onSuccess);
		
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

	<li  class='last'> <a href="auth/logout">Log Out </a> </li>
   
	</ul>
</div>

	<h1 align="center"> In Lended Books Page</h1>





	 	<ul class="list-group">

	 		@for($i = 0; $i < count($name); $i++)
			  <li class="list-group-item">
			  		  <b> {{$name[$i]->userFullName}} </b> has to borrowed BookName: <b>
			  		  {{$name[$i]->bookName}} </b> from you on {{$name[$i]->borrowDate}}
			  		   and supposed to return it on  {{$name[$i]->returnDate}}
			  		<div align="right">
			  		<button id="{{ $name[$i]->ownedBookListId }}" 
			  		data-toggle="modal" class="baccept btn" data-target="#myModal"
			  		value="{{$name[$i]->borrowerId}}">Has Returned Book</button>
			  		</div>
			  </li>
			@endfor
		 
		</ul>

		<br><br><br>

		<h4>Lended list over</h4>


<!-- 
		<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>
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
		        <p>Have you goten you book back : </p>
		        <blockquote >
		        	Are you sure you want to make this book available to you??				
				</blockquote>
				
				<button id="lendBook">Book has been Returned</button>
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