@extends('chara.layout')
@section('content')
<a href="{{ route('chara.index_summary') }}" type="button" class="btn btn-success rounded-3">Summary</a>
<a href="{{ route('chara.index') }}" type="button" class="btn btn-success rounded-3">Character</a>
<a href="{{ route('chara.index_va') }}" type="button" class="btn btn-success rounded-3">Voice Actor</a>
<a href="{{ route('chara.index_agency') }}" type="button" class="btn btn-success rounded-3">Agency</a>
<h4 class="mt-5">All Data</h4>
<form action="{{ route('chara.search_summary') }}" method="post">
    @csrf
    <div class="mb-3">

        <label for="name" class="form-label">Search Character Name</label>

        <input type="text" class="form-control" name="search">
    </div>

    <div class="text-center">
        <input type="submit" class="btn btn-primary" value="Search" />

    </div>
</form>

<table class="table table-hover mt-2">
    <thead>
        <tr>
            <th>Character Name</th>
            <th>Alternative Name</th>
            <th>Character From</th>
            <th>Voice Actor</th>
            <th>Agency</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($datas as $data)

        <tr>
            <td>{{ $data->chara_name }}</td>
            <td>{{ $data->alt_name }}</td>
            <td>{{ $data->chara_from }}</td>
            <td>{{ $data->va_name }}</td>
            <td>{{ $data->agency_name }}</td>
        </tr>
        @endforeach


    </tbody>
</table>
@stop