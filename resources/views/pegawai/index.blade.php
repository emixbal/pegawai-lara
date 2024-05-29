@extends('layout')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-8">
                            <h5 class="card-title p-1 mb-0">List Pegawai</h5>
                        </div>
                        <div class="col-lg-4">
                            <div class="float-sm-end">
                                <button id="modal_add_btn" class="btn btn-primary btn-sm">+ Tambah Data</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="pegawai" class="table dt-responsive align-middle table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>NIK</th>
                                    <th>Tempat Lahir</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Departemen</th>
                                    <th style="width: 20px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $pegawai)
                                    <tr>
                                        <td>{{ $pegawai->name }}</td>
                                        <td>{{ $pegawai->nik }}</td>
                                        <td>{{ $pegawai->pob }}</td>
                                        <td>{{ $pegawai->dob }}</td>
                                        <td>{{ $pegawai->department->name }}</td>
                                        <td>
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ri-more-fill align-middle"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                        <button data="{{ json_encode($pegawai) }}"
                                                            class="dropdown-item edit-item-btn" id="modal_edit_btn"><i
                                                                class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                            Edit
                                                        </button>
                                                    </li>
                                                    <li>
                                                        <button data="{{ json_encode($pegawai) }}"
                                                            class="dropdown-item remove-item-btn">
                                                            <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                            Delete
                                                        </button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('pegawai.modal_add')
    @include('pegawai.modal_edit')
    @include('pegawai.modal_delete')

@endsection

@section('css')
    <style>

        /* Responsif untuk tampilan seluler */
        @media (max-width: 768px) {
            .table-responsive {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }
        }
    </style>

    <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.5.4/css/fileinput.min.css" integrity="sha512-yDVMONIXJPPAoULZ92Ygngsn8ZUGB4ejm6fCc6q9ZvdH8blFAOgg75XZSEaAJ5m4E/yPI1BAi5fF2axMHVuZ5w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

@stop

@section('js')
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="{{ url('public') }}/assets/libs/cleave.js/cleave.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.5.4/js/fileinput.min.js"></script>

    <script src="{{ url('public/assets/js/app/pegawai/index.js') }}"></script>
@stop
