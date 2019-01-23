<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Document</title>

	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
</head>
<body>
	<div class="container">

	<h1>Catalog Page</h1>
	<h2>Categories</h2>
	<a href="#" class="btn btn-primary">All</a>
	@foreach($categories as $category)
		<a href="/menu" class="btn btn-primary">{{ $category->name }}</a>
	@endforeach

	<hr>
		<a href="/menu/add" class="btn btn-primary mb-2"><i class="fas fa-plus"></i> Add new item</a>

		<div class="row">

			@foreach($items as $indiv_item)
				<div class="col-sm-4">
					<div class="card mb-3">
						<div class="card-body">
							<h5 class="card-title">{{ $indiv_item->name }}</h5>
							<img src="{{ $indiv_item->image_path }}">

							<p>{{ $indiv_item->description }}</p>
							<p>{{ $indiv_item->category_id }}</p>
							
							<a href="/menu/{{ $indiv_item->id }}" class="btn vtb-block btn-primary">{{ $indiv_item->name }}</a>
						</div>
					</div>
				</div>
			@endforeach
		</div>

	</div>

</body>
</html>