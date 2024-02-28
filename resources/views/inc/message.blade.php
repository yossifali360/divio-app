@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if (session()->get('success') != null)
    <div class="alert alert-success">{{ session()->get('success') }}</div>
@endif
