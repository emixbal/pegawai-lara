$('#department').DataTable({
    "paging": false
});
$(document).ready(function () {
    $("#modal_add_btn").on("click", function () {
        $('#modal_add').modal('show');
    })

    $("#modal_add_save_btn").on("click", function () {
        var name = $("#name").val()
        var description = $("#description").val()

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: `${base_app_url}/department`,
            type: "POST",
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
                toast(jqXHR?.responseJSON?.message,"warning")
                console.log("terjadi kesalahan");
                console.log(jqXHR, textStatus, errorThrown);
                return
            },
            complete: function (params) {
                $("#name").val('')
                $("#description").val('')
                $('#modal_add').modal('hide');
                return
            }
        });
    })

    $(".edit-item-btn").on("click", function (event) {
        event.preventDefault();
        var data = $(this).attr("data");
        var department = JSON.parse(data)

        $("#id_edit").val(department.id)
        $("#name_edit").val(department.name)
        $("#description_edit").val(department.description)

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
            url: `${base_app_url}/department/${id}`,
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
                toast(jqXHR?.responseJSON?.message,"warning")
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
        var department = JSON.parse(data)

        $("#id_delete").val(department.id)
        $("#name_delete").val(department.name)
        $("#description_delete").val(department.description)

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
            url: `${base_app_url}/department/${id}`,
            type: "DELETE",
            success: async function (response, textStatus, xhr) {
                toast("sukses")
                location.reload();
                return
            },
            error: function (jqXHR, textStatus, errorThrown) {
                toast(jqXHR?.responseJSON?.message,"warning")
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

})
