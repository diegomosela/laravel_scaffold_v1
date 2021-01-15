@extends($template)

@section('content')
	
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