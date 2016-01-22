@if ($errors->has())
    <div class="row">
        <div class="col-md-6">
            @foreach ($errors->all() as $error)
                <div class='bg-danger alert'>{{ $error }}</div>
            @endforeach
        </div>
    </div>
@endif