@extends('chara.layout')
@section('content')

@if($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<div class="card mt-4">
    <div class="card-body">
        <h5 class="card-title fw-bolder mb-3">Add Voice Actor</h5>

        <form method="post" action="{{route('chara.store_va') }}">
            @csrf
            <div class="mb-3">

                <label for="id_va" class="form-label">Voice Actor ID</label>

                <input type="text" class="form-control" id="id_va" name="id_va">
            </div>
            <div class="mb-3">

                <label for="va_name" class="form-label">Voice Actor Name</label>

                <input type="text" class="form-control" id="va_name" name="va_name">
            </div>
            <div class="mb-3">

                <label for="birthdate" class="form-label">Birthdate (YYYY-MM-DD)</label>

                <input type="text" class="form-control" id="birthdate" name="birthdate">
            </div>
            <div class="mb-3">

                <label for="id_agency" class="form-label">Agency ID</label>

                <input type="text" class="form-control" id="id_agency" name="id_agency">
            </div>

            <div class="text-center">
                <input type="submit" class="btn btn-primary" value="Add" />

            </div>
        </form>
    </div>
</div>
@stop