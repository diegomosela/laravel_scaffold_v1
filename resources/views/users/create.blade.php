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

					{{ Form::open(['url' => 'users/store', 'class' => 'ajax col-12 text-dark text-left']) }}

						<div class="form-group mb-3">
							<label for="iName">Nome</label>
							<input id="iName" type="text" class="form-control" required name="name" minlength="5">
						</div>

						<div class="form-group mb-3">
							<label for="iEmail">Email</label>
							<input id="iEmail" type="email" class="form-control" required name="email">
						</div>

						<div class="form-group mb-3">
							<label for="iPassword">Senha</label>
							<input id="iPassword" type="password" class="form-control" required name="password" minlength="6">
						</div>

						<button type="submit" class="btn btn-primary w-100">
							Criar Conta
						</button>

					{{ Form::close() }}

					<div class="col-12 text-right font-size-14 text-dark">
						<a href="{{ url('users/login') }}" class="text-dark font-weight-bold">
							voltar
						</a>
					</div>

				</div>
			</div>
		</div>

	</div>

@endsection