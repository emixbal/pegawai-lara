$('#pegawai').DataTable({
    "paging": true,
    "responsive": true,
});

$("#ava").fileinput({
    theme: 'fas',
    showUpload: false,
    allowedFileExtensions: ["jpg", "jpeg", "png"]
});

$(document).ready(function () {

    $.validator.addMethod("dobFormat", function (value, element) {
        // Validasi format dengan regular expression
        return value.match(/^\d{2}\/\d{2}\/\d{4}$/);
    }, "Format tanggal lahir harus DD/MM/YYYY");

    $("#employeeForm").validate({
        rules: {
            name: {
                required: true,
                minlength: 2
            },
            nik: {
                required: true,
                digits: true,
                minlength: 16,
                maxlength: 16
            },
            department_id: {
                required: true
            },
            pob: {
                required: true,
                minlength: 2
            },
            dob: {
                required: true,
                dobFormat: true,
            }
        },
        messages: {
            name: {
                required: "Nama Pegawai wajib diisi",
                minlength: "Nama Pegawai harus terdiri dari minimal 2 karakter"
            },
            nik: {
                required: "NIK wajib diisi",
                digits: "NIK harus berupa angka",
                minlength: "NIK harus terdiri dari 16 angka",
                maxlength: "NIK harus terdiri dari 16 angka"
            },
            department_id: {
                required: "Departemen wajib dipilih"
            },
            pob: {
                required: "Tempat Lahir wajib diisi",
                minlength: "Tempat Lahir harus terdiri dari minimal 2 karakter"
            },
            dob: {
                required: "Tanggal Lahir wajib diisi",
                date: "Format Tanggal Lahir tidak valid"
            },
            ava: {
                required: true,
            }
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid').removeClass('is-valid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).addClass('is-valid').removeClass('is-invalid');
        }
    });

    $("#modal_add_btn").on("click", function () {
        $('#modal_add').modal('show');
    })

    $("#modal_add_save_btn").on("click", function () {
        if (!$("#employeeForm").valid()) {
            return;
        }

        var formData = new FormData();
        var name = $("#name").val();
        var nik = $("#nik").val();
        var pob = $("#pob").val();
        var dob = $("#dob").val();
        var department_id = $("#department_id").val();
        var ava = $("#ava")[0].files[0]; // Ambil file avatar

        formData.append('name', name);
        formData.append('nik', nik);
        formData.append('pob', pob);
        formData.append('dob', dob);
        formData.append('department_id', department_id);
        formData.append('ava', ava); // Tambahkan file avatar ke FormData

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: `${base_app_url}/pegawai`,
            type: "POST",
            data: formData, // Gunakan FormData sebagai data
            contentType: false, // Tidak mengatur tipe konten secara otomatis
            processData: false, // Tidak memproses data (FormData sudah dalam bentuk yang benar)
            success: async function (response, textStatus, xhr) {
                toast("sukses");
                location.reload();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                toast(JSON.stringify(jqXHR?.responseJSON?.message), "warning");
                console.log("terjadi kesalahan");
                console.log(jqXHR, textStatus, errorThrown);
            }
        });
    });

    $(".edit-item-btn").on("click", function (event) {
        event.preventDefault();
        var data = $(this).attr("data");
        var pegawai = JSON.parse(data)

        $("#id_edit").val(pegawai.id)
        $("#name_edit").val(pegawai.name)
        $("#nik_edit").val(pegawai.nik)
        $("#pob_edit").val(pegawai.pob)
        $("#dob_edit").val(pegawai.dob)
        $("#department_id_edit").val(pegawai.department_id)

        var defaultDepartmentId = pegawai.department_id;
        if (defaultDepartmentId) {
            $('#department_id_edit').val(defaultDepartmentId);
        }

        $('#modal_edit').modal('show');
    })

    $("#modal_edit_save_btn").on("click", function () {
        var id = $("#id_edit").val()
        var name = $("#name_edit").val()
        var nik = $("#nik_edit").val()
        var department_id = $("#department_id_edit").val()
        var pob = $("#pob_edit").val()
        var dob = $("#dob_edit").val()

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: `${base_app_url}/pegawai/${id}`,
            type: "PUT",
            data: {
                name, nik, department_id, pob, dob
            },
            success: async function (response, textStatus, xhr) {
                toast("sukses")
                location.reload();
                return
            },
            error: function (jqXHR, textStatus, errorThrown) {
                toast(JSON.stringify(jqXHR?.responseJSON?.message), "warning")
                console.log("terjadi kesalahan");
                console.log(jqXHR, textStatus, errorThrown);
                return
            },
            complete: function (params) {
                $("#name").val('')
                $("#description").val('')
                $('#modal_edit').modal('hide');
                return
            }
        });
    })

    $(".remove-item-btn").on("click", function (event) {
        event.preventDefault();
        var data = $(this).attr("data");
        var pegawai = JSON.parse(data)

        $("#id_delete").val(pegawai.id)
        $("#name_delete").val(pegawai.name)
        $("#description_delete").val(pegawai.description)

        $('#modal_delete').modal('show');
    })

    $("#modal_delete_save_btn").on("click", function () {
        var id = $("#id_delete").val()
        var name = $("#name_delete").val()
        var description = $("#description_delete").val()

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: `${base_app_url}/pegawai/${id}`,
            type: "DELETE",
            success: async function (response, textStatus, xhr) {
                toast("sukses")
                location.reload();
                return
            },
            error: function (jqXHR, textStatus, errorThrown) {
                toast(jqXHR?.responseJSON?.message, "warning")
                console.log("terjadi kesalahan");
                console.log(jqXHR, textStatus, errorThrown);
                return
            },
            complete: function (params) {
                $("#name").val('')
                $("#description").val('')
                $('#modal_delete').modal('hide');
                return
            }
        });
    })

    new Cleave('#dob', {
        date: true,
    });

})
