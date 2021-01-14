@extends($template)

@section('content')
	
	<div class="container">
		<div class="row justify-content-md-center">
			<div class="col-12 col-sm-8 col-md-6 col-lg-4">
				<div class="card row mt-5 p-3">

					<div class="col-12 text-center pb-2 mb-2">
						<img src="{{ asset('assets/img/logotipo.png') }}" id="icon" alt="logotipo icon" width="50%" />
						<hr/>
					</div>

					{{ Form::open(['url' => 'users/login', 'class' => 'ajax col-12 text-dark text-left']) }}

						<div class="form-group mb-3">
							<label for="iEmail">Usuário</label>
							<input id="iEmail" type="email" class="form-control" required name="email">
						</div>

						<div class="form-group mb-3">
							<label for="iPassword">Senha</label>
							<input id="iPassword" type="password" class="form-control" required name="password">
						</div>

						<button type="submit" class="btn btn-primary w-100">
							Acessar
						</button>

					{{ Form::close() }}

					<div class="col-12 text-right font-size-14 text-dark">
						<a href="{{ url('users/create') }}" class="text-dark font-weight-bold">
							criar conta
						</a> |
						<a href="#" class="text-dark font-weight-bold" data-bs-toggle="modal" data-bs-target="#modalPassword">
							recuperar senha
						</a>
					</div>

				</div>
			</div>
		</div>

	</div>

	<div class="modal fade" id="modalPassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				{{ Form::open(['url' => 'users/password', 'class' => 'ajax col-12 text-dark text-left w-100']) }}
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Recuperar senha</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<p>
							Insira seu e-mail para continuar:
						</p>
						<div class="form-group mb-3">
							<label for="iEmail">Seu e-mail</label>
							<input id="iEmail" type="email" class="form-control" required name="email">
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
						<button type="submit" class="btn btn-primary">Recuperar</button>
					</div>
				{{ Form::close() }}
			</div>
		</div>
	</div>

@endsection