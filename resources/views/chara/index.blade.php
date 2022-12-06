@extends('chara.layout')
@section('content')
<a href="{{ route('chara.index_summary') }}" type="button" class="btn btn-success rounded-3">Summary</a>
<a href="{{ route('chara.index') }}" type="button" class="btn btn-success rounded-3">Character</a>
<a href="{{ route('chara.index_va') }}" type="button" class="btn btn-success rounded-3">Voice Actor</a>
<a href="{{ route('chara.index_agency') }}" type="button" class="btn btn-success rounded-3">Agency</a>
<h4 class="mt-5">Data Character</h4>
<a href="{{ route('chara.create') }}" type="button" class="btn btn-success rounded-3">Add Data</a>
<a href="{{ route('chara.restore') }}" type="button" class="btn btn-success rounded-3">Restore Data</a>

@if($message = Session::get('success'))
<div class="alert alert-success mt-3" role="alert">
    {{ $message }}
</div>
@endif
<table class="table table-hover mt-2">
    <thead>
        <tr>
            <th>Character ID</th>
            <th>Character Name</th>
            <th>Alternative Name</th>
            <th>Character From</th>
            <th>Voice Actor ID</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($datas as $data)

        <tr>
            <td>{{ $data->id_chara }}</td>
            <td>{{ $data->chara_name }}</td>
            <td>{{ $data->alt_name }}</td>
            <td>{{ $data->chara_from }}</td>
            <td>{{ $data->id_va }}</td>
            <td>
                <a href="{{ route('chara.edit',$data->id_chara) }}" type="button" class="btn btn-warning rounded-3">
                    Change
                </a>

                <!-- TAMBAHKAN KODE DELETE DIBAWAH BARIS INI -->
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#DeleteModal{{ $data->id_chara }}">
                        Delete
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="DeleteModal{{ $data->id_chara }}" tabindex="-1" aria-labelledby="DeleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="DeleteModalLabel">Confirm</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form method="POST" action="{{ route('chara.delete', $data->id_chara) }}">
                                    @csrf
                                    <div class="modal-body">
                                        Are you sure want to delete {{ $data->chara_name}}?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Sure</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#softDeleteModal{{ $data->id_chara}}">
                        Soft Delete
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="softDeleteModal{{ $data->id_chara}}" tabindex="-1" aria-labelledby="softDeleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="softDeleteModalLabel">Confirm</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form method="POST" action="{{ route('chara.softdelete', $data->id_chara) }}">
                                    @csrf
                                    <div class="modal-body">
                                    Are you sure want to delete {{ $data->chara_name}}?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Sure</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@stop