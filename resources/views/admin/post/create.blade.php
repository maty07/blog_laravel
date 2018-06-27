@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">
					Crear Entrada
					<a href="{{ route('posts.index') }}" class="btn btn-sm btn-success pull-right">Listado</a>
				</div>

				<div class="panel-body">
					<form action="{{ route('posts.store') }}" method="POST">
						{{ csrf_field() }}
						<input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
						<div class="form-group">
							<label>Categoria</label>
							<select name="category_id" id="category_id" class="form-control">
								<option>::Seleccione Categoria::</option>
								@foreach($categories as $category)
									<option value="{{ $category->id }}">{{ $category->name }}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group">
							<label>Nombre</label>
							<input type="text" name="name" id="name" class="form-control">
						</div>
						<div class="form-group">
							<label>URL Amigable</label>
							<input type="text" name="slug" id="slug" class="form-control">
						</div>
						<div class="form-group">
							<label>Imagen</label>
							<input type="file" name="file" class="form-control">
						</div>
						<div class="form-group">
							<label>Estado&nbsp;&nbsp;</label>
								<input type="radio" name="status" value="PUBLISHED">
								<label for="PUBLISHED">Publicado</label>

								<input type="radio" name="status" value="DRAFT" checked="">
								<label for="DRAFT">Borrador</label>
						</div>
						<div class="form-group">
							<label>Etiquetas</label>
							@foreach($tags as $tag)
								<input type="checkbox" name="tags" value="{{ $tag->id }}">{{ $tag->name }}&nbsp;
							@endforeach
						</div>
						<div class="form-group">
							<label>Extracto</label>
							<textarea name="excerpt" class="form-control" rows="2"></textarea>
						</div>
						<div class="form-group">
							<label>Descripción</label>
							<textarea name="body" class="form-control" rows="6"></textarea>
						</div>
						<div>
							<input type="submit" name="save-post" class="btn btn-sm btn-primary">
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

		$('#category_id').change(function(){
			alert('#category_id').val();
		});	
	});
</script>
@endsection