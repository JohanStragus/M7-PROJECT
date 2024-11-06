@extends('layouts.app') @section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">Edita el post #{{$post->id}}</div>


				<div class="card-body">
					<form action="{{route('posts.update',$post->id)}}" method="POST">
					@csrf
					<input type="hidden" name="_method" value="PUT">
						Titol:<br> <input type="text" name="titol" value="{{$post->titol}}"> <br> Contingut:<br> <textarea name="contingut" rows="10" cols="30"> {{$post->contingut}}</textarea><br> user_id<br> <input type="number"
							name="user_id" value="{{$post->user_id}}"> <br>
						<br> <input type="submit" value="Submit">
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
