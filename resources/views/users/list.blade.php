@extends($template)

@section('content')

	<div class="row">
		<div class="col-12 col-md-6 col-lg-3">
			<form method="get" class="form-inline row">
				<div class="col">
  					<input type="text" class="form-control mb-2 mr-sm-2" name="search" placeholder="Pesquisar aluno..." value="{{ $r->search }}">
  				</div>
  				<div class="col-auto">
  				 	<button type="submit" class="btn btn-primary mb-2">Buscar</button>
  				</div>
  			</form>
		</div>
	</div>

	<hr/>
	
	<div class="row">
		
		@if( $users && count($users) > 0 )

			<div class="col">
				<table class="table table-striped">
					<thead>
						<tr>
							<th scope="col">Cód.</th>
							<th scope="col">Nome</th>
							<th scope="col">Usuário</th>
							<th scope="col">Email</th>
							<th scope="col">Status</th>
							<th scope="col">Data Cadastro</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($users as $key => $user )
							<tr>
								<td scope="col">#{{ $user->id }}</td>
								<td scope="col" class="font-weight-bold">{{ $user->name }}</td>
								<td scope="col">{{ $user->username }}</td>
								<td scope="col">{{ $user->email }}</td>
								<td scope="col">{{ $user->status ? 'Ativado' : 'Desativado' }}</td>
								<td scope="col">{{ date_time_mini( $user->created_at ) }}</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>

		@else

			<div class="col">
				<div class="alert alert-warning">
					<b>Ooooops!</b>
					<br/>
					Nenhum aluno encontrado :(
				</div>
			</div>

		@endif

	</div>

@endsection