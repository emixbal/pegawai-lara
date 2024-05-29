<!-- Default Modals -->
<div id="modal_edit" class="modal fade" tabindex="-1" aria-labelledby="modal_edit_label" aria-hidden="true"
    style="display: none;" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_edit_label">Edit Data Pegawai</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>

            <input type="hidden" class="form-control" id="id_edit" name="id_edit">

            <div class="modal-body">
                <div class="form-group">
                    <label for="name_edit" class="form-label">Nama Pegawai</label>
                    <input type="text" class="form-control" id="name_edit" name="name_edit">
                </div>

                <div class="form-group mt-2">
                    <label for="nik_edit" class="form-label">NIK</label>
                    <input type="text" class="form-control" id="nik_edit" name="nik_edit">
                </div>

                <div class="form-group mt-2">
                    <label for="department_id_edit" class="form-label">Departemen</label>
                    <select name="department_id_edit" id="department_id_edit" class="form-select">
                        <option value="">Select Departemen...</option>
                        @foreach ($departments as $department)
                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="row mt-2">
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="pob_edit" class="form-label">Tempat Lahir</label>
                            <input type="text" class="form-control" id="pob_edit" name="pob_edit">
                        </div>
                    </div><!--end col-->
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="cleave-date" class="form-label">Tanggal Lahir</label>
                            <input type="text" class="form-control" placeholder="DD/MM/YYYY" id="dob_edit" name="dob_edit">
                        </div>
                    </div>
                </div>


                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batalkan</button>
                    <button type="button" class="btn btn-primary" id="modal_edit_save_btn">Simpan Data</button>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
