@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">
					Lista de Entradas
					<a href="{{ route('posts.create') }}" class="btn btn-sm btn-primary pull-right">Crear</a>
				</div>

				<div class="panel-body">
					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th width="10px">ID</th>
								<th>Nombre</th>
								<th colspan="2">&nbsp;</th>
							</tr>
						</thead>
						<tbody>
							@foreach($posts as $post)
							<tr>
								<td>{{ $post->id }}</td>
								<td>{{ $post->name }}</td>
								<td width="10px">
									<a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-warning">Editar</a>
								</td>
								<td width="10px">
									<form action="{{ route('posts.destroy', $post->id) }}" method="POST">
										{{ csrf_field() }}
										<input type="hidden" name="_method" value="DELETE">
										<input type="submit" value="Eliminar" class="btn btn-sm btn-danger">
									</form>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
					{{ $posts->links() }}
				</div>
			</div>
		</div>
	</div>
</div>




@endsection