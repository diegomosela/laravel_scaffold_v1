<div class="row">
	
	<?php if( $videos && count($videos) > 0 ) foreach ($videos as $key => $video ) { ?>

	<div class="col-12 col-sm-6 col-md-4">
		<div class="card" style="width: 18rem;">
			<img src="{{ "https://img.youtube.com/vi/{$video->youtube}/1.jpg" }}" class="card-img-top">
			<div class="card-body">
				<h5 class="card-title">
					{{ $video->title }}
				</h5>
				<p class="mb-2 font-size-10">
					Enviado em {{ date_time_mini($video->created_at) }}
				</p>
				
				<a href="{{ url("videos/read/{$video->id}") }}" class="btn btn-primary">
					Assistir
				</a>

				{{-- OPÇÕES DE PROFESSOR --}}
				@if( session('user')['role'] >= 2 && isset($edit) && $edit )
					<hr/>
					<a href="{{ url("videos/edit/{$video->id}") }}" class="btn btn-light font-size-10">
						<i class="fas fa-edit"></i> editar
					</a>
					<a href="{{ url("videos/delete/{$video->id}") }}" class="btn btn-danger font-size-10 text-white">
						<i class="fas fa-trash"></i> excluir
					</a>
				@endif

			</div>
		</div>
	</div>

	<?php } else { ?>

		<div class="col">
			<div class="alert alert-warning">
				<b>Ooooops!</b>
				<br/>
				Nenhum vídeo encontrado :(
			</div>

	<?php } ?>

</div>