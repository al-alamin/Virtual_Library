<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="../../resource/css/bootstrap.min.css">  
  <script src="../../resource/js/jquery.min.js"></script>
  <script src="../../resource/js/bootstrap.min.js"></script>
  <script src="../../resource/js/jquery-1.11.3.min.js"></script>

  	<script>
		// $(document).ready(function(){
		//    console.log ("in search page");
		  
		//   });
</script>

<style type="text/css">
	
</style>

</head>
<body>

	<div class="container">
		<div class="col-sm-offset-2 col-sm-8">
			<div class="panel panel-default">
				<div class="panel-heading">
					Register
				</div>

				<div class="panel-body">
					<!-- Display Validation Errors -->
				

					<!-- New Task Form -->
					<form action="http://localhost/laravel/vlibrary/public/index.php/auth/register" method="POST" class="form-horizontal">
						{{ csrf_field() }}

						<!-- Name -->
						<div class="form-group">
							<label for="UserFullName" class="col-sm-3 control-label">UserFullName</label>

							<div class="col-sm-6">
								<input type="text" name="UserFullName" class="form-control" value="{{ old('UserFullName') }}">
							</div>
						</div>

						<!-- E-Mail Address -->
						<div class="form-group">
							<label for="Email" class="col-sm-3 control-label">E-Mail</label>

							<div class="col-sm-6">
								<input type="email" name="Email" class="form-control" value="{{ old('Email') }}">
							</div>
						</div>

						<!-- Password -->
						<div class="form-group">
							<label for="password" class="col-sm-3 control-label">password</label>

							<div class="col-sm-6">
								<input type="password" name="password" class="form-control">
							</div>
						</div>

						<!-- Confirm Password -->
						<div class="form-group">
							<label for="password_confirmation" class="col-sm-3 control-label">Confirm Password</label>

							<div class="col-sm-6">
								<input type="password" name="password_confirmation" class="form-control">
							</div>
						</div>

						

						<div class="form-group">
							<label for="PhoneNo" class="col-sm-3 control-label">PhoneNo</label>

							<div class="col-sm-6">
								<input type="text" name="PhoneNo" class="form-control" value="{{ old('PhoneNo') }}">
							</div>
						</div>

						<div class="form-group">
							<label for="MobileNo" class="col-sm-3 control-label">MobileNo</label>

							<div class="col-sm-6">
								<input type="text" name="MobileNo" class="form-control" value="{{ old('MobileNo') }}">
							</div>
						</div>

						<!-- Register Button -->
						<div class="form-group">
							<div class="col-sm-offset-3 col-sm-6">
								<button type="submit" class="btn btn-default">
									<i class="fa fa-btn fa-sign-in"></i>Register
								</button>
							</div>
						</div>

					</form>
				</div>
			</div>
		</div>
	</div>


</body>
</html>
