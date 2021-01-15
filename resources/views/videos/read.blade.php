@extends($template)

@section('content')

   	<div class="row">

   		<div class="col-12 mb-3">
   			<div class="embed-responsive embed-responsive-16by9">
  				<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{ $video->youtube }}" allowfullscreen width="100%" style="height: 50vh"></iframe>
			</div>
   		</div>

   		<div class="col-12 font-weight-bold font-size-24">

   			{{ $video->title }}

   		</div>

   		<div class="col-12 font-weight-bold font-size-16">

   			<hr/>

   			<i class="far fa-calendar"></i> {{ date_time_mini($video->created_at) }} |
   			<i class="far fa-user"></i> {{ $user->name }} |
   			<i class="far fa-eye"></i> {{ $views }}

   		</div>

   		<div class="col-12">

   			<hr/>

   			{!! $video->description !!}

   		</div>

   	</div>

@endsection