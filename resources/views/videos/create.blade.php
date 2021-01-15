@extends($template)

@section('content')

	{{ Form::open(['url' => 'videos/store', 'class' => 'ajax col-12 text-dark text-left']) }}

		<div class="mb-3">
			<label for="iTitulo" class="form-label">Título</label>
			<input type="text" class="form-control" id="iTitulo" required minlength="10" name="title" maxlength="200">
		</div>

		<div class="mb-3">
			<label for="iUrl" class="form-label">Vídeo do YouTube</label>
			<input type="url" class="form-control" id="iUrl" required name="youtube">
			<div id="emailHelp" class="form-text">Copie a URL do vídeo do YouTube, exemplo: https://www.youtube.com/watch?v=Y2ypJuf_bLY</div>
		</div>


		<div class="mb-3">
			<label for="iDesc" class="form-label">Descrição</label>
			<textarea class="form-control" id="iDesc" required name="description"></textarea>
		</div>

		<button type="submit" class="btn btn-success btn-lg">
			Cadastrar vídeo
		</button>

	{{ Form::close() }}

@endsection