<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Login Page</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.11.3.min.js"></script>
<style>
	table {
		width: 100%;
		 border-collapse: collapse;
		 background-color: #ffe5e5;
	}
	td {
		text-align: center;
	}
	table, tr {
  		 border: 1px solid black;
	}
	th {
	    background-color: #4CAF50;
	    color: white;
	}
	tr:hover{background-color:#00ffbf}
</style>

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
		var borrowerId ;

		
		$("#curUser").hide();
		$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

	    $("button.baccept").click(function(event) {
	    //    alert(event.target.id);
	        ownedBookListId = event.target.id ;	     
    	    borrowerId = $('#curUser').attr('value');
    	    alert(ownedBookListId + "and borrerid " + borrowerId);
    	});

    	$("#lendBook").click(function(event) {	   
    	     alert(ownedBookListId + "and borrerid " + borrowerId);
    	
    	     if ((isNaN(ownedBookListId) || isNaN(borrowerId))) {
    	     	alert ("you cant see details you are not logged in");
    	     } else {    	     
    	     	$.post('http://localhost/laravel/vlibrary/public/index.php/ajax/postrequestborrow', {'ownedBookListId' : ownedBookListId, 'borrowerId' : borrowerId}, onSuccess);
		
    	     }
    	     
    	});


	});
</script>
</head>


<body>
<meta name="csrf-token" content="<?php echo csrf_token() ?>" />
<div class="container">

	

	



		  <br><br><br>


		  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>

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
		        <p>This message will be sent to : </p>
		        <blockquote >
		        	Hi i am .... and i would like to borrow this book from you				
				</blockquote>
				<button id="sendMessage">Send Messege</button>
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






