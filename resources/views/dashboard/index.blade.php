@extends($template)

@section('content')

    @include('elements/videos', ['videos' => $videos, 'edit' => false])

@endsection