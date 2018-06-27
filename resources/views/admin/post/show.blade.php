@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">
					Ver Entrada
					<a href="{{ route('posts.index') }}" class="btn btn-sm btn-success pull-right">Listado</a>
				</div>

				<div class="panel-body">
					<p><strong>Nombre: </strong>{{ $post->name }}</p>
					<p><strong>URL Amigable: </strong>{{ $post->slug }}</p>
					<p><strong>Descripción: </strong>{{ $post->body }}</p>



				</div>
			</div>
		</div>
	</div>
</div>




@endsection