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
        <h5 class="card-title fw-bolder mb-3">Add Character</h5>

        <form method="post" action="{{route('chara.store') }}">
            @csrf
            <div class="mb-3">

                <label for="chara_name" class="form-label">Character Name</label>

                <input type="text" class="form-control" id="chara_name" name="chara_name">
            </div>

            <div class="mb-3"/>

                <label for="alt_name" class="form-label">Alternative Name</label>

                <input type="text" class="form-control" id="alt_name" name="alt_name">
            </div>

            <div class="mb-3">
            
                <label for="chara_from" class="form-label">Character From</label>
            
                <input type="text" class="form-control" id="chara_from" name="chara_from">
            </div>

            <div class="mb-3">

                <label for="id_va" class="form-label">Voice Actor ID</label>

                <input type="text" class="form-control" id="id_va" name="id_va">
            </div>

            <div class="text-center">
                <input type="submit" class="btn btn-primary" value="Add" />

            </div>
        </form>
    </div>
</div>
@stop