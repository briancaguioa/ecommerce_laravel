<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Edit item page</title>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-sm-8 offset-sm-2">

				<h2>Edit form page</h2>

				<div class="row">
					@if(count($errors) > 0)
						@foreach($errors->all() as $error)
							<p>{{$error}}</p>
						@endforeach
					@endif
				</div>

				<form method="POST" action="/menu/{{$item->id}}/edit" enctype="multipart/form-data">
					{{csrf_field()}}
					{{method_field("PATCH")}}

					<div class="form-group">
						<label for="name">Name</label>
						<input type="text" name="name" class="form-control" id="name" value="{{$item->name}}">
					</div>

					<div class="form-group">
						<label for="description">Description</label>
						<textarea name="description" class="form-control" id="description" cols="30" rows="10">
							{{ $item->description }}
						</textarea>
					</div>

					<div class="form-group">
						<label for="price">Price</label>
						<input id="price" type="number" name="price" class="form-control" value="{{$item->price}}" min="0">
					</div>

					<div class="form-group">
						<label for="category">Category</label>
						<select name="category" id="category" class="form-control mb-3">
							@foreach($categories as $category)
									<option value="{{ $category->id }}" {{$category->id == $item->category_id? "selected" : ""}}>{{$category->name}}</option>
							@endforeach
						</select>
					</div>
					
					<div class="form-group">
						<label for="image">Image</label>
						<input type="file" name="image" id="image" class="form-control-file">
					</div>

					<button type="submit" class="btn btn-block bg-primary mb-3">Update</button>

				</form>
			</div>
		</div>

	</div>
	<form method="POST" action="/menu/{{ $item->id }}"></form>
</body>
</html>