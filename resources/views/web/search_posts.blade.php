@extends('layouts/app')

@section('content')

<div class="container">
	<div class="col-md-8">
		<h1>Lista de articulos</h1>

		@foreach($posts as $post)
			<div class="panel panel-default">
				<div class="panel-heading">
					{{ $post->name }}
				</div>
				<div class="panel-body">
					@if($post->file)
							<img src=" {{ $post->file }}" class="img-responsive">
					@endif
					{{ $post->excerpt }}
					<a href=" {{ route('post', $post->slug) }} " class="pull-right">Leer más</a>
				</div>
			</div>
		@endforeach
	</div>
	<div class="col-md-4">
		<div>
			<form class="form-inline">
				<input type="search" name="search" class="form-control" placeholder="Buscar Entrada..">
				<input type="submit" name="btn_search" class="btn btn-sm btn-success" value="Buscar">
			</form>
		</div>
	</div>
</div>

@endsection()