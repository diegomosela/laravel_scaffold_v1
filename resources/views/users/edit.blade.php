@extends($template)

@section('content')

	{{ Form::open(['url' => "users/update", 'class' => 'ajax col-12 text-dark text-left']) }}

		<div class="mb-3">
			<label for="iName" class="form-label">Nome</label>
			<input type="text" class="form-control" id="iName" required minlength="5" maxlength="50" name="name" value="{{ $user->name }}"/>
		</div>

		<div class="mb-3">
			<label for="iUsername" class="form-label">Usuário</label>
			<input type="text" class="form-control" id="iUsername" required minlength="3" maxlength="30" name="username" value="{{ $user->username }}"/>
		</div>

		<div class="mb-3">
			<label for="iEmail" class="form-label">Email</label>
			<input type="email" class="form-control" id="iEmail" required name="email" value="{{ $user->email }}"/>
		</div>

		<div class="mb-3">
			<label for="iPassword" class="form-label">Senha</label>
			<input type="password" class="form-control" id="iPassword" name="password" minlength="6" />
			<small>Deixe em branco para não atualizar</small>
		</div>


		<button type="submit" class="btn btn-success btn-lg">
			Atualizar conta
		</button>

	{{ Form::close() }}

@endsection