@section('title', 'mycart')

<!DOCTYPE html>
<html>
<head>
	<meta>
	<title>My Cart</title>

	{{-- fontawesome --}}
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">


	{{-- Bootstrap cdn --}}
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
	

		<div class="container">
			<div class="row">
				<div class="col-sm-8 offset-sm-2">
					<table class="table table-striped">
						<thead>
							<th>Oders</th>
							<th>Total</th>
							<th>Details</th>
						</thead>
						@foreach($orders as $order)
							<tbody>
								<td>{{ $order->created_at->diffForHumans() }}</td>
								<td>{{number_format($order->total,2,".",".")}}</td>
								<td>
									{{$order->item}}
									@foreach($order->items as $item)
										{{-- {{ var_dump($orders) }} --}}
										{{-- {{var_export($order)}} --}}
										{{-- {{$item}} --}}
										<div>
											{{ $item->name }} : {{$item->pivot->quantity}}
											@if($item->trashed()) {{-- item has been deleted --}}

											<a href="/restoredItem/{{$item->id}}" class="btn btnprimary">Restore Item</a>
											@endif
										</div>
									@endforeach
								</td>
							</tbody>
						@endforeach
					</table>
				</div>
			</div>
		</div>

		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

</body>
</html>