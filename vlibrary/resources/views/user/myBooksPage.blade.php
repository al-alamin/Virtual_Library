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

  <style>
	table {
		width: 100% !important;

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

	td {
		font-weight: italic;
		font-family: Helvetica;
	}


	body {
	  	background-color: #FAFAD2;
	  	
	  	font-family: Helvetica;
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
		$('#td1').hide();
		$("#curUser").hide();
		$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

	    $("button").click(function(event) {
	    //    alert(event.target.id);
	        ownedBookListId = event.target.id ;
	     //   $.post('http://localhost/laravel/vlibrary/public/index.php/ajax/post', {'ownerId' : '1', 'borrowerOwnedBookListId' : ownedBookListId}, onSuccess);
	
    	//	$('#td1').show();
    	     var curUser = $('#curUser').attr('value');
    	     if (curUser === '-1') {
    	     	alert ("you cant see details you are not logged in");
    	     } else {

    	     	alert(curUser);
    	     	$.post('http://localhost/laravel/vlibrary/public/index.php/ajax/post', {'ownerOwnedBookListId' : ownedBookListId, 'borrowerId' : curUser}, onSuccess);
		
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

	<br><br>


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

	
	<h2>Vlibrary Own Book Collections: </h2>
  
	
 

  	
  	
           
	  <table class="table table-bordered" >
	    <thead>
	      <tr>
	        <th>ID</th>
	        <th>Name</th>
	        <th>Authors</th>
	        <th>Edition</th>
	        <th>Category</th>
	        <th>Year</th>	        
	        <th>Locations</th>	        
	                      
	        <th>Availabilty</th>	       
	        <th>Publishers</th>
	       
	        
		   </tr>
		    </thead>
		    <tbody>
		      <tr>
		        <td>----</td>
		        <td>----</td>
		        <td>----</td>
		        <td>----</td>
		        <td>----</td>
		        
		        <td>----</td>
		        <td>----</td>

		        <td>----</td>
		         <td>----</td>
		        



		      </tr>
		      @for ($i = 0; $i < count($allInformation); $i++)	      
		      	

			      <tr>
			        <td>{{ $i }}</td>
			        <td>{{ $allInformation[$i]['bookName'] }}</td>
			        <td>{!! $allInformation[$i]['authorName'] !!}</td>
			        <td>{{ $allInformation[$i]['edition'] }}</td>
			        <td>{!! $allInformation[$i]['categoryName'] !!}</td>
			        <td>{{ $allInformation[$i]['publishingYear'] }}</td>
			         <td>{!! $allInformation[$i]['locationName'] !!}</td>
			       
			        
			        <td>{{ $allInformation[$i]['userIsAvailable'] }}</td>
			        <td>{{ $allInformation[$i]['publishers'] }}</td>
			       
			        
			      </tr>
		      @endfor
		    
		    </tbody>
		  </table>



		  <br><br><br>

	   <!--  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>
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










<!-- ['bookInformation' => $bookInformation, 
                                'authorInformation' =>$authorInformation,
                    'categoryInformation' => $categoryInformation, 
                    'userInformation' => $userInformation, 
                    'bookLocationInformation' => $bookLocationInformation
                     ]); -->