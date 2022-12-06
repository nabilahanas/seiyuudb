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
        <h5 class="card-title fw-bolder mb-3">Add Agency</h5>

        <form method="post" action="{{route('chara.store_agency') }}">
            @csrf
            <div class="mb-3">

                <label for="agency_name" class="form-label">Agency Name</label>

                <input type="text" class="form-control" id="agency_name" name="agency_name">
            </div>
            <div class="mb-3">

                <label for="established" class="form-label">Established (YYYY-MM-DD)</label>

                <input type="text" class="form-control" id="established" name="established">
            </div>

            <div class="text-center">
                <input type="submit" class="btn btn-primary" value="Add" />

            </div>
        </form>
    </div>
</div>
@stop