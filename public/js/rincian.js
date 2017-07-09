    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
        $('[data-toggle="popover"]').popover({html:true});
    });
    function tambahPenginapan() {
        var strVar="";
            strVar += "<div class=\"input-group\"><br>";
            strVar += "                            <div class=\"input-daterange input-group\" id=\"datepicker\">";
            strVar += "                                <span class=\"input-group-addon\">Jml<\/span>";
            strVar += "                                <input type=\"number\" class=\"form-control qty_penginapan\" min=\"0\" step=\"1\" name=\"qty_penginapan[]\">";
            strVar += "                                <span class=\"input-group-addon\">Rp. <\/span>";
            strVar += "                                <input type=\"number\" class=\"form-control  harga_penginapan\" min=\"0\" step=\"1\" data-toggle=\"tooltip\" title=\"Max: {{$response['data']['referensi']['uang_penginapan']}}\" max=\"{{$response['data']['referensi']['uang_penginapan']}}\" style=\"min-width: 150px\" name=\"harga_penginapan[]\"";
            strVar += "                                <span class=\"input-group-btn input-group-btn-danger\">";
            strVar += "                                    <button class=\"btn btn-danger\" type=\"button\" onclick=\"$(this).parent().parent().parent().remove();recalculatePenginapan($(this));\"><i class=\"fa fa-trash\" style=\"color:red;\"><\/i><\/button>";
            strVar += "                                <\/span>";
            strVar += "                            <\/div>";
            strVar += "                        <\/div>";

        $('#peng').append(strVar);
        $('[data-toggle="tooltip"]').tooltip();
    }

    function limitThis(obj) {
        if ( ! obj.attr('max')){
            return false;
        }

        var maxim = parseFloat(obj.attr('max'));
        if (parseFloat(obj.val()) > maxim) {
            notie.alert('warning', 'Maximum ' + maxim, 1);
            obj.val(maxim).focus().removeClass('animated shake').addClass('animated shake');
        }
    }

    function recalculatePenginapan(objct) {
        var o = limitThis(objct);
        var total = 0;
        $('.harga_penginapan').each(function (index, value) {
            var curQty = ($(value).parent().find('.qty_penginapan').val().length == 0) ? 0 : $(value).parent().find('.qty_penginapan').val();
            var curPrice = ($(value).val().length == 0) ? 0 : $(value).val();
            total = total + (parseFloat(curQty) * parseFloat(curPrice));
            $('#subtotal_penginapan').val(total);
        });
    }

    $(document).on('change', '.qty_penginapan', function() {
        var qty = ($(this).val().length == 0) ? 0 : $(this).val();
        var price = ($(this).parent().find('.harga_penginapan').val().length == 0) ? 0 : $(this).parent().find('.harga_penginapan').val();
        var sub = parseFloat(qty) * parseFloat(price);
        recalculatePenginapan($(this));
    });

    $(document).on('change', '.harga_penginapan', function() {
        var price = ($(this).val().length == 0) ? 0 : $(this).val();
        var qty = ($(this).parent().find('.qty_penginapan').val().length == 0) ? 0 : $(this).parent().find('.qty_penginapan').val();
        var sub = parseFloat(qty) * parseFloat(price);
        recalculatePenginapan($(this));
    });


    $(document).on('change', '#qty_lumpsum', function() {
        var ref = parseFloat(($('#harga_lumpsum').val().length == 0) ? 0 : $('#harga_lumpsum').val());
        var qty = parseFloat(($(this).val().length == 0) ? 0 : $(this).val());
        $('#subtotal_lumpsum').val(ref * qty);
    });

    $(document).on('change', '#uang_harian_jenis', function() {
        $('#uang_harian_qty, #uang_harian_subtotal').val('0');
        $('#uang_harian_harga').val(($(this).val().length == 0) ? 0 : $(this).val());
        if (parseFloat($(this).val()) != 0) {
            $('#jenis_uang_harian').val($('#uang_harian_jenis option:selected').text());
        }
    });

    $(document).on('change', '#uang_harian_qty', function() {
        if (parseFloat($('#uang_harian_jenis').val()) == 0) {
            notie.alert('info', 'Silahkan pilih jenis uang harian', 1);
            $('#uang_harian_jenis').focus().removeClass('animated shake').addClass('animated shake');
            return false;
        }

        var qty = parseFloat($(this).val());
        var price = parseFloat($('#uang_harian_harga').val());
        var sub = parseFloat(qty * price);
        $('#uang_harian_subtotal').val(sub);
    });

    $(document).on('change', '#representatif_qty', function(){
        var ref = parseFloat(($('#representatif_harga').val().length == 0) ? 0 : $('#representatif_harga').val());
        var qty = parseFloat(($(this).val().length == 0) ? 0 : $(this).val());
        $('#representatif_subtotal').val(ref * qty);
    });

    $(document).on('change', 'input', function(){
        var lumpsum = parseFloat(($('#subtotal_lumpsum').val().length == 0) ? 0 : $('#subtotal_lumpsum').val());
        var uang_harian = parseFloat(($('#uang_harian_subtotal').val().length == 0) ? 0 : $('#uang_harian_subtotal').val());
        var uang_representasi = parseFloat(($('#representatif_subtotal').val().length == 0) ? 0 : $('#representatif_subtotal').val());
        var penginapan = parseFloat(($('#subtotal_penginapan').val().length == 0) ? 0 : $('#subtotal_penginapan').val());
        var tiket_pp = parseFloat(($('#tiket_pp').val().length == 0) ? 0 : $('#tiket_pp').val());
        var airport_tax = parseFloat(($('#airport_tax').val().length == 0) ? 0 : $('#airport_tax').val());
        var lainnya = parseFloat(($('#lainnya').val().length == 0) ? 0 : $('#lainnya').val());
        var tot = parseFloat(lumpsum + uang_harian + uang_representasi + tiket_pp + penginapan + airport_tax + lainnya);
        $('#jumlah_total').val(tot);
        $('#jumlah_total_terbilang').val(terbilang(tot));
    });