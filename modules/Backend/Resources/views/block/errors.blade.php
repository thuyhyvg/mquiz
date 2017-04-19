@if (count($errors) > 0)
    <div class="alert alert-danger">
    	<button class="close" type="button" data-dismiss="alert">&times;</button>
        <strong> Lỗi! </strong>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif