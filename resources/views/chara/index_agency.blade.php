@extends('chara.layout')
@section('content')
<a href="{{ route('chara.index_summary') }}" type="button" class="btn btn-success rounded-3">Summary</a>
<a href="{{ route('chara.index') }}" type="button" class="btn btn-success rounded-3">Character</a>
<a href="{{ route('chara.index_va') }}" type="button" class="btn btn-success rounded-3">Voice Actor</a>
<a href="{{ route('chara.index_agency') }}" type="button" class="btn btn-success rounded-3">Agency</a>
<h4 class="mt-5">Agency Data</h4>
<a href="{{ route('chara.create_agency') }}" type="button" class="btn btn-success rounded-3">Add Data</a>
<a href="{{ route('chara.restore_agency') }}" type="button" class="btn btn-success rounded-3">Restore Data</a>

@if($message = Session::get('success'))
<div class="alert alert-success mt-3" role="alert">
    {{ $message }}
</div>
@endif
<table class="table table-hover mt-2">
    <thead>
        <tr>
            <th>Agency ID</h>
            <th>Agency Name</th>
            <th>Established</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($datas as $data)

        <tr>
            <td>{{ $data->id_agency }}</td>
            <td>{{ $data->agency_name }}</td>
            <td>{{ $data->established }}</td>
            <td>
                <a href="{{ route('chara.edit_agency',$data->id_agency) }}" type="button" class="btn btn-primary rounded-3">
                    Change
                </a>

                <!-- TAMBAHKAN KODE DELETE DIBAWAH BARIS INI -->
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#DeleteModal{{ $data->id_agency }}">
                        Delete
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="DeleteModal{{ $data->id_agency }}" tabindex="-1" aria-labelledby="DeleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="DeleteModalLabel">Confirm</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form method="POST" action="{{ route('chara.delete_agency', $data->id_agency) }}">
                                    @csrf
                                    <div class="modal-body">
                                        Are you sure want to delete {{ $data->agency_name}}?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Sure</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#softDeleteModal{{ $data->id_agency}}">
                        Soft Delete
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="softDeleteModal{{ $data->id_agency}}" tabindex="-1" aria-labelledby="softDeleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="softDeleteModalLabel">Confirm</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form method="POST" action="{{ route('chara.softdelete_agency', $data->id_agency) }}">
                                    @csrf
                                    <div class="modal-body">
                                    Are you sure want to delete {{ $data->agency_name}}?
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