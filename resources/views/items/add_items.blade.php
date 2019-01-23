<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
</head>
<body>
	<h1 class="text-center mt-3">Add new Items</h1>
	<div class="container">
		<div class="row">
			@if(count($errors) > 0)
				@foreach($errors->all() as $error)
				<div class="text-danger">{{ $error }}</div>
				@endforeach
			@endif
		</div>
	</div>

	<div class="container">		
		<div class="row">
			<div class="col-md-8 offset-md-2">

				<form action="" enctype="multipart/form-data" method="POST">

					{{ csrf_field() }}

					<div class="form-group">
						<label for="name">Name</label>
						<input id="name" type="text" name="name" class="form-control">
					</div>

					<div class="form-group">
						<label for="description">Description</label>
						<textarea id="description" class="form-control" name="description"></textarea>
					</div>

					<div class="form-group">
						<label for="price">Price</label>
						<input id="price" type="number" name="price" class="form-control" min="0">
					</div>

					<div class="form-group">
						<label for="category">Category</label>
						<select name="category" id="category" class="form-control mb-3">
							@foreach($categories as $category)
									<option value="{{ $category->id }}">{{ $category->name }}</option>
							@endforeach
						</select>
					</div>

					<div class="form-group">
	 					<label for="image">Upload Image</label>
	 					<input id="image" type="file" name="image" class="form-control-file">
	 				</div>

	 				<button type="submit" class="btn bg-primary" ><i class="fas fa-plus"></i> Add new Item</button>

				</form>
			</div>
		</div>
	</div> {{-- end container --}}
</body>
</html>