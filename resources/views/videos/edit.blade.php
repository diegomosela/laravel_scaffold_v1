@extends($template)

@section('content')

	{{ Form::open(['url' => "videos/update/{$video->id}", 'class' => 'ajax col-12 text-dark text-left']) }}

		<div class="mb-3">
			<div class="embed-responsive embed-responsive-16by9">
  				<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{ $video->youtube }}" allowfullscreen style="height: 20vh"></iframe>
			</div>
		</div>

		<div class="mb-3">
			<label for="iTitulo" class="form-label">Título</label>
			<input type="text" class="form-control" id="iTitulo" required minlength="10" name="title" value="{{ $video->title }}" maxlength="200"/>
		</div>

		<div class="mb-3">
			<label for="iUrl" class="form-label">Vídeo do YouTube</label>
			<input type="url" class="form-control" id="iUrl" required name="youtube" value="https://www.youtube.com/watch?v={{ $video->youtube }}">
			<div id="emailHelp" class="form-text">Copie a URL do vídeo do YouTube, exemplo: https://www.youtube.com/watch?v=Y2ypJuf_bLY</div>
		</div>

		<div class="mb-3">
			<label for="iDesc" class="form-label">Descrição</label>
			<textarea class="form-control" id="iDesc" required name="description">{!! $video->description !!}</textarea>
		</div>

		<button type="submit" class="btn btn-success btn-lg">
			Atualizar vídeo
		</button>

	{{ Form::close() }}

@endsection