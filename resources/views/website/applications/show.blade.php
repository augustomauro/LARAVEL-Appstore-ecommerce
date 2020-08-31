@extends('website.layouts.website')
<!-- Index Template -->

@section('title')
Application Detail
@endsection


@section('content')

<!-- Check if the user has Wishes / Votes / Orders -->
<?php 
$is_wishes = auth()->user() ? auth()->user()->wishes()->where('application_id', $application->id)->first() : false;
$is_voted = auth()->user() ? $application->votes()->where('user_id', auth()->user()->id)->first() : false;
$is_order = auth()->user() ? auth()->user()->orders()->where('application_id', $application->id)->where('user_id', auth()->user()->id)->first() : false;
$order_method = $is_order ? 'DELETE':'POST';
$order_count = $application->orders()->count();
$votes_count = $application->votes()->count();
?>


<div class="content-wrap">

<article class="card card-product-list mb-4">
	<div class="card-body">
		<div class="row">
			<aside class="col-sm-3">
				<a href="#" class="img-wrap"><img src="{{ asset($application->image) }}"></a>
			</aside> <!-- col.// -->
			<article class="col-sm-6">
					<!-- <a href="#" class="title mt-2 h5">{{ $application->name }}</a> -->
					<h5 class="title mt-2 h5" style="text-align: left">{{ $application->name }}</h5>
					<small class="developer-name">{{ $application->user->username }}</small>
					<div class="rating-wrap mb-3">
						<ul class="rating-stars" title="{{ $application->getRating() }}% of the total">
								<li style="width:{{ $application->getRating() }}%" class="stars-active">
								<i class="fa fa-star"></i> <i class="fa fa-star"></i>
								<i class="fa fa-star"></i> <i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
							</li>
							<li>
								<i class="fa fa-star"></i> <i class="fa fa-star"></i>
								<i class="fa fa-star"></i> <i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
							</li>
						</ul>
						<small class="label-rating text-muted"><i class="far fa-thumbs-up"></i>{{ $votes_count }} vote{{ ($order_count > 1 || $order_count == 0) ? 's':'' }}</small>
						<small class="label-rating text-success">
							<i class="fas fa-clipboard-check"></i> {{ $order_count }} order{{ ($order_count > 1 || $order_count == 0) ? 's':'' }} </small>
					</div> <!-- rating-wrap.// -->
					<p>{{ $application->description }}</p>

			</article> <!-- col.// -->
			<aside class="col-sm-3">
				<div class="price-wrap mt-2">
                    <span class="price h5"> $@money($application->price) </span>
                    <!-- 25% Discount Example -->
					<del class="price-old"> $@money($application->price / 1.25) </del>
				</div> <!-- info-price-detail // -->

				<p class="small text-success"> Free shipping </p>
				
				<br>

				<p>
					@guest
					<div id="order-buttons">
						<button class="btn btn-<?= $is_order ? 'danger':'primary' ?>"
							onclick="redirectToLogin()"> {{ $is_order? 'Remove':'Buy' }} </button>
						<button class="btn btn-light"> Details  </button>
					</div>
					@else
						@if(auth()->user()->id != $application->user_id)
							<!-- If the Application DOES NOT Belong To the Auth User -->
							<div id="order-buttons">
								<button class="btn btn-<?= $is_order ? 'secondary':'success' ?>"
									onclick="manageOrder()"> {{ $is_order? 'Remove':'Buy' }} </button>
								<button class="btn btn-light"> Details  </button>
							</div>
						@else
							<!-- If the Application Belongs To the Auth User -->
							<div id="order-buttons">
								<a href="{{ url('/me/apps/'.$application->id.'/edit') }}" class="btn btn-warning"> Edit </a>
								<button class="btn btn-danger" 
									onclick="deleteApp();"> 
									Delete  
								</button>
							</div>
							<form id="delete-form" action="{{ url('me/apps/'.$application->id) }}" method="POST" style="display: none;">
								@csrf
								@method('delete')
							</form>
						@endif
					@endguest				
				</p>

				<br>
				
					@guest
					<!-- Add / Del Wishes -->
					<a class="small" href="{{ route('user_wishes') }}" 
						onclick="event.preventDefault(); document.getElementById('wishes-form').submit(); ">
						<i class="fa fa-heart" style="<?= $is_wishes ? 'color: crimson' : '' ?>"></i> 
							{{ $is_wishes ? 'Remove from ' : 'Add to ' }} wishlist
					</a>
					@else
						@if(auth()->user()->id != $application->user_id)
							<!-- Add / Del Wishes -->
							<a class="small" href="{{ route('user_wishes') }}" 
								onclick="event.preventDefault(); document.getElementById('wishes-form').submit();">
								<i class="fa fa-heart" style="<?= $is_wishes ? 'color: crimson' : '' ?>"></i> 
									{{ $is_wishes ? 'Remove from ' : 'Add to ' }} wishlist
							</a>
						@endif
					@endguest
					
					<br>

					@guest
					<!-- Vote the App -->
					<a class="small" href="{{ route('user_vote') }}" style="color: {{ $is_voted ? '#696969':'#228b22' }}"
						onclick="event.preventDefault(); document.getElementById('votes-form').submit();">
						<i class="far fa-thumbs-<?= $is_voted ? 'down':'up' ?>"></i> 
						Vote this App
					</a>
					@else
						@if(auth()->user()->id != $application->user_id)
							<!-- Vote the App -->
							<a class="small" href="{{ route('user_vote') }}" style="color: {{ $is_voted ? '#696969':'#228b22' }}"
								onclick="event.preventDefault(); document.getElementById('votes-form').submit();">
								<i class="far fa-thumbs-<?= $is_voted ? 'down':'up' ?>"></i> 
								Vote this App
							</a>
						@endif
					@endguest

					<!-- Wishes Form -->
					<form id="wishes-form" action="{{ route('user_wishes') }}" method="POST" style="display: none;">
						@csrf
						@if($is_wishes)
						@method('delete')
						@else
						@method('post')
						@endif
						<input type="hidden" name="user_id" value="{{ auth()->user() ? auth()->user()->id : null }}">
						<input type="hidden" name="application_id" value="{{ auth()->user() ? $application->id : null }}">
					</form>

					<!-- Votes Form -->
					<form id="votes-form" action="{{ route('user_vote') }}" method="POST" style="display: none;">
						@csrf
						@if($is_voted)
						@method('delete')
						@else
						@method('post')
						@endif
						<input type="hidden" name="user_id" value="{{ auth()->user() ? auth()->user()->id : null }}">
						<input type="hidden" name="application_id" value="{{ auth()->user() ? $application->id : null }}">
					</form>

			</aside> <!-- col.// -->
		</div> <!-- row.// -->
	</div> <!-- card-body .// -->
</article>

</div>

<script type="text/javascript">

	function manageOrder() {
		let url = window.location.origin + '/api/buy';
		let method = @json($order_method);	// PHP variable
		let id = @json($application->id);	// PHP variable
		fetch(url, {
			method: method,
			body: JSON.stringify({application_id: id}),
			headers: {
				'Content-Type': 'application/json;charset=utf-8'
			}
		})
		.then( function (response) {
			return response.json();
		})
		.then(function (data) {
			console.log(data);
			location.reload();
		})
		.catch(function (error) {
			console.error(error);			
		});
	}

	function redirectToLogin() {
		<?php \Session::flash('redirect',\Request::path()); ?>
		let url = @json(route('login'));	// PHP variable
		window.open(url,'_self');
	}

	function deleteApp() {
        if(confirm('Are you sure you want to delete this application ?')){
            document.getElementById('delete-form').submit();
            console.log('application deleted !');
        } else {
            console.log('operation canceled !');
        }
    }

</script>

@endsection

