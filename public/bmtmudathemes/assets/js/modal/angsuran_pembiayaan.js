$(document).ready(function() {
    $('#confirmAngModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.

        if(button.data('jenis')=="Tunai"){
            $("#atoHideAng").hide();
            $("#atoHideAngBank").hide();
            $("#atoHideAngBank2").hide();
            $("#atoHideTabungan").hide();
        }
        else if(button.data('jenis')=="Transfer"){
            $("#atoHideAng").show();
            $("#atoHideAngBank").show();
            $("#atoHideAngBank2").show();
            $("#atoHideTabungan").hide();
        }
        else if(button.data('jenis')=="Tabungan"){
            $("#atoHideAng").hide();
            $("#atoHideAngBank").hide();
            $("#atoHideAngBank2").hide();
            $("#atoHideTabungan").show();
        }

        $("#atabungan").val(button.data('bank') );

        $("#aidRekA").val(button.data('id') );
        $("#aidTabA").val(button.data('idtab') );
        $("#jenis_pembiayaan_angsuran").val(button.data('idtab') );
        $("#ajenisAng").val(button.data('jenis') );
        $("#abankAng").val(button.data('bankuser') );
        $("#abank").val(button.data('bank') );
        $("#abagi_pokok").val(button.data('pokok') );
        $("#abagi_margin").val(button.data('nisbah') );
        $("#abayar_ang").val(button.data('ang') );
        $("#abayar_margin").val(button.data('mar') );
        $("#atagihan_pokok").val(button.data('sisa_pinjaman') )
        $("#atagihan_margin").val(button.data('sisa_mar') );
        $("#aatasnamaAng").val(button.data('atasnama') );
        $("#anobankAng").val(button.data('no_bank') );
        $("#apicAng").attr("src", button.data('path') );

    });

    $("#angidRek").change(function() {
        var form_value = $(this).val();
        var id_user = form_value.split(" ")[9];
        var formatter = new Intl.NumberFormat('en-US', {maximumFractionDigits:2});
        $("#tabungan option").remove();

        $.ajax({
            type: "GET",
            url: window.location.origin + "/api/get_user_tabungan/" + id_user,
            dataType: "JSON",
            success: function (response) {
                response.forEach(element => {
                    var detail = JSON.parse(element.detail);
                    var template = `<option value="` + element.id + `"> [` + element.id_tabungan + `] ` + element.jenis_tabungan + ` [ ` + formatter.format(detail.saldo) + ` ] </option>`;
                    $("#tabungan").append(template);
                });
            }
        });
    })
});