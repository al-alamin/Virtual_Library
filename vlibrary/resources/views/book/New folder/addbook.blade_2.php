@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="col-sm-offset-2 col-sm-8">
			<div class="panel panel-default">
				<div class="panel-heading">
					Add New Book
				</div>

				<div class="panel-body">
					<!-- Display Validation Errors -->
					@include('common.errors')

					<!-- New Task Form -->
					<form action="http://localhost/laravel/vlibrary/public/index.php/addbook" method="POST" class="form-horizontal">
						{{ csrf_field() }}

						<!-- E-Mail Address -->
						<div class="form-group">
							<label for="BookName" class="col-sm-3 control-label">Book Name</label>

							<div class="col-sm-6">
								<input type="text" name="BookName" class="form-control" value="{{ old('BookName') }}">
							</div>
						</div>

						<!-- Password -->
						<div class="form-group">
							<label for="AuthorName" class="col-sm-3 control-label">Author's Name</label>

							<div class="col-sm-6">
								<input type="text" name="AuthorName" class="form-control">
							</div>
						</div>

						<!-- PublishingYear -->
						<div class="form-group">
							<label for="PublishingYear" class="col-sm-3 control-label">PublishingYear</label>

							<div class="col-sm-6">
								<input type="text" name="PublishingYear" class="form-control">
							</div>
						</div>




						<!-- Login Button -->
						<div class="form-group">
							<div class="col-sm-offset-3 col-sm-6">
								<button type="submit" class="btn btn-default">
									<i class="fa fa-btn "></i>Add book
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection
