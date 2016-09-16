<form action="import" method="POST" enctype="multipart/form-data">
	<input type="hidden" name="_token" value="{!! csrf_token() !!}">
	<input type="file" name="file">
	<button type="submit">Inport</button>
</form>