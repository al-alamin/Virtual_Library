<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Virtual Library</title>

<link href="resource/css/css.css" rel="stylesheet" type="text/css">

	 <link rel="stylesheet" href="resource/css/bootstrap.min.css">  
  <script src="resource/js/jquery.min.js"></script>
  <script src="resource/js/bootstrap.min.js"></script>
  <script src="resource/js/jquery-1.11.3.min.js"></script>
	<style>
		body {
			font-family: 'Raleway';
			margin-top: 25px;
		}

		.fa-btn {
			margin-right: 6px;
		}

		.table-text div {
			padding-top: 6px;
		}
	</style>

	<script>
		(function () {
			$('#task-name').focus();
		}());
	</script>
</head>

<body>
	<div class="container">
		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>

					<a class="navbar-brand" href="/">Virtual Library</a>
				</div>

				<div id="navbar" class="navbar-collapse collapse">
					<ul class="nav navbar-nav">
						&nbsp;
					</ul>

					 <?php
			            //    echo "from php about to var dump";
			            //     $a = ["alamin", "is ", "awesome"];
			            // echo '<pre>' ;
			            //  var_dump($a);
			            //  echo '</pre>'; 
			 	       $url = ($_SERVER["REQUEST_URI"]);
			      //     echo  ($url);
			      //     echo "<br>";
			           $actionUrl = "";
			           $actionUrl2 = "";
			           if (strpos($url, "auth/login")) {
			        //   	  echo "...Dont ... need to add <br>";
			           	  $actionUrl = "";

			           } else {
			           	   $actionUrl = "index.php/auth/login";
			           	   $actionUrl2 = "index.php/auth/register";
			           	   
			           //	  echo "in else: " . $url . "<br>";
			          // 	  $url = $url . "/auth/login";
			        //   	  echo "add it manually <br>";
			           }
			    //       echo "final url: " . $actionUrl . "<br>";
			        //   echo  ($_SERVER['HTTP_HOST']);
			 	   //     echo "print $serverurl: " . $_SERVER["REQUEST_URI"] . "<br>";
			                        
			        ?>

					<ul class="nav navbar-nav navbar-right">
						@if (Auth::guest())
							<li><a href=<?php echo $actionUrl2 ?>><i class="fa fa-btn fa-heart"></i>Register</a></li>
							<li><a href=<?php echo $actionUrl ?>><i class="fa fa-btn fa-sign-in"></i>Login</a></li>
						@else
							<li class="navbar-text"><i class="fa fa-btn fa-user"></i>{{ Auth::user()->name }}</li>
							<li><a href="auth/logout"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
						@endif
					</ul>
				</div>
			</div>
		</nav>
	</div>

	@yield('content')
</body>
</html>
