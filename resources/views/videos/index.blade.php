@extends($template)

@section('content')

    @include('elements/videos', ['videos' => $videos, 'edit' => true])

@endsection