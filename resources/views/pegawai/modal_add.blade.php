<!-- Default Modals -->
<div id="modal_add" class="modal fade" tabindex="-1" aria-labelledby="modal_add_label" aria-hidden="true"
    style="display: none;" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_add_label">Tambah Data Pegawai</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>

            <div class="modal-body">
                <form id="employeeForm">
                    <div class="form-group">
                        <label for="name" class="form-label">Nama Pegawai</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>

                    <div class="form-group">
                        <label for="nik" class="form-label">NIK</label>
                        <input type="text" class="form-control" id="nik" name="nik">
                    </div>

                    <div class="form-group mt-1">
                        <label for="department_id" class="form-label">Departemen</label>
                        <select name="department_id" id="department_id" class="form-select">
                            <option value="">Select Departemen...</option>
                            @foreach ($departments as $department)
                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="row mt-1">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="pob" class="form-label">Tempat Lahir</label>
                                <input type="text" class="form-control" id="pob" name="pob">
                            </div>
                        </div><!--end col-->
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="dob" class="form-label">Tanggal Lahir</label>
                                <input type="text" class="form-control" placeholder="DD/MM/YYYY" id="dob"
                                    name="dob">
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batalkan</button>
                <button type="button" class="btn btn-primary" id="modal_add_save_btn">Simpan Data</button>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
