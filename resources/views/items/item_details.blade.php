<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Item Details</title>
		{{-- fontawesome --}}
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-5 offset-md-4">
			  	<h1>Item Details Page</h1>
			  	
			  	<p>Item Name: {{ $item->name }}</p>
			  	<p>Item Description: {{ $item->description }}</p>
			  	<p>Item Price: {{ $item->price }}</p>
			  	<img src="/{{ $item->image_path }}" class="img-fluid d-block mb-3 rounded">
			  	<a href="/menu/{{ $item->id}}/edit" class="btn btn-primary"><i class="fas fa-edit"></i> Edit</a>
			  	<button class="btn btn-danger" data-toggle="modal" data-target="#confirmDelete"><i class="far fa-trash-alt"></i> Delete</button>
			  	<a href="/catalog" class="btn btn-outline-primary"><i class="fas fa-chevron-left"></i> Back to Catalog</a>

			  	<div class="modal fade" id="confirmDelete" role="dialog">
			  		<div class="modal-dialog">
			  			<div class="modal-content">
			  				<div class="modal-header">
			  					<h4>Confirm Delete</h4>
			  				</div>
			  				<div class="modal-body">
			  					<p>Are you sure you want to dealete this item?</p>
			  				</div>
			  				<din class="modal-footer">
			  					<button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>

			  					<form method="POST" action="/menu/{{ $item->id}}/delete">
			  						{{ csrf_field() }}
			  						{{ method_field('DELETE') }}
			  						<button type="submit" class="btn btn-danger">Confirm</button>
			  					</form>
			  				</din>
			  			</div>
			  		</div>
			  	</div>
			</div>
		</div>
	</div>
  	{{-- bootstrap scripts --}}
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

</body>
</html>