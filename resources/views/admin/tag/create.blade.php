@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">
					Crear Etiqueta
					<a href="{{ route('tags.index') }}" class="btn btn-sm btn-success pull-right">Listado</a>
				</div>

				<div class="panel-body">
					<form action="{{ route('tags.store') }}" method="POST">
						{{ csrf_field() }}
						<div class="form-group">
							<label>Nombre</label>
							<input type="text" name="name" id="name" class="form-control">
						</div>
						<div class="form-group">
							<label>Slug</label>
							<input type="text" name="slug" id="slug" class="form-control">
						</div>
						<div>
							<input type="submit" name="save-tag" class="btn btn-sm btn-primary">
						</div>

					</form>
				</div>
			</div>
		</div>
	</div>
</div>




@endsection

@section('script')

<script src="https://cdnjs.cloudflare.com/ajax/libs/speakingurl/14.0.1/speakingurl.min.js"></script>﻿
<script src="{{ asset('vendor/stringToSlug/jquery.stringtoslug.min.js') }}"></script>
<script>
	$(function(){
		$('#name, #slug').stringToSlug({
			callback: function(text){
				$('#slug').val(text);
			}
		});	
	});
</script>
@endsection