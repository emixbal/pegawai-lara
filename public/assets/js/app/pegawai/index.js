$('#pegawai').DataTable({
    "paging": false
});

$(document).ready(function () {
    $("#modal_add_btn").on("click", function () {
        $('#modal_add').modal('show');
    })

    $("#modal_add_save_btn").on("click", function () {
        var name = $("#name").val()
        var nik = $("#nik").val()
        var pob = $("#pob").val()
        var dob = $("#dob").val()
        var department_id = $("#department_id").val()

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: `${base_app_url}/pegawai`,
            type: "POST",
            data: {
                name, nik, pob, dob, department_id
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
                return
            }
        });
    })

    $(".edit-item-btn").on("click", function (event) {
        event.preventDefault();
        var data = $(this).attr("data");
        var pegawai = JSON.parse(data)

        $("#id_edit").val(pegawai.id)
        $("#name_edit").val(pegawai.name)
        $("#description_edit").val(pegawai.description)

        $('#modal_edit').modal('show');
    })

    $("#modal_edit_save_btn").on("click", function () {
        var id = $("#id_edit").val()
        var name = $("#name_edit").val()
        var description = $("#description_edit").val()

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: `${base_app_url}/pegawai/${id}`,
            type: "PUT",
            data: {
                name,
                description
            },
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
