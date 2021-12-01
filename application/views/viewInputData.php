<!-- BEGIN PAGE HEADER-->
<style>
    /* Absolute Center Spinner */
    .loading {
        position: fixed;
        z-index: 999;
        height: 2em;
        width: 2em;
        overflow: show;
        margin: auto;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
    }

    /* Transparent Overlay */
    .loading:before {
        content: '';
        display: block;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: radial-gradient(rgba(20, 20, 20, .8), rgba(0, 0, 0, .8));

        background: -webkit-radial-gradient(rgba(20, 20, 20, .8), rgba(0, 0, 0, .8));
    }

    /* :not(:required) hides these rules from IE9 and below */
    .loading:not(:required) {
        /* hide "loading..." text */
        font: 0/0 a;
        color: transparent;
        text-shadow: none;
        background-color: transparent;
        border: 0;
    }

    .loading:not(:required):after {
        content: '';
        display: block;
        font-size: 10px;
        width: 1em;
        height: 1em;
        margin-top: -0.5em;
        -webkit-animation: spinner 150ms infinite linear;
        -moz-animation: spinner 150ms infinite linear;
        -ms-animation: spinner 150ms infinite linear;
        -o-animation: spinner 150ms infinite linear;
        animation: spinner 150ms infinite linear;
        border-radius: 0.5em;
        -webkit-box-shadow: rgba(255, 255, 255, 0.75) 1.5em 0 0 0, rgba(255, 255, 255, 0.75) 1.1em 1.1em 0 0, rgba(255, 255, 255, 0.75) 0 1.5em 0 0, rgba(255, 255, 255, 0.75) -1.1em 1.1em 0 0, rgba(255, 255, 255, 0.75) -1.5em 0 0 0, rgba(255, 255, 255, 0.75) -1.1em -1.1em 0 0, rgba(255, 255, 255, 0.75) 0 -1.5em 0 0, rgba(255, 255, 255, 0.75) 1.1em -1.1em 0 0;
        box-shadow: rgba(255, 255, 255, 0.75) 1.5em 0 0 0, rgba(255, 255, 255, 0.75) 1.1em 1.1em 0 0, rgba(255, 255, 255, 0.75) 0 1.5em 0 0, rgba(255, 255, 255, 0.75) -1.1em 1.1em 0 0, rgba(255, 255, 255, 0.75) -1.5em 0 0 0, rgba(255, 255, 255, 0.75) -1.1em -1.1em 0 0, rgba(255, 255, 255, 0.75) 0 -1.5em 0 0, rgba(255, 255, 255, 0.75) 1.1em -1.1em 0 0;
    }

    /* Animation */

    @-webkit-keyframes spinner {
        0% {
            -webkit-transform: rotate(0deg);
            -moz-transform: rotate(0deg);
            -ms-transform: rotate(0deg);
            -o-transform: rotate(0deg);
            transform: rotate(0deg);
        }

        100% {
            -webkit-transform: rotate(360deg);
            -moz-transform: rotate(360deg);
            -ms-transform: rotate(360deg);
            -o-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }

    @-moz-keyframes spinner {
        0% {
            -webkit-transform: rotate(0deg);
            -moz-transform: rotate(0deg);
            -ms-transform: rotate(0deg);
            -o-transform: rotate(0deg);
            transform: rotate(0deg);
        }

        100% {
            -webkit-transform: rotate(360deg);
            -moz-transform: rotate(360deg);
            -ms-transform: rotate(360deg);
            -o-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }

    @-o-keyframes spinner {
        0% {
            -webkit-transform: rotate(0deg);
            -moz-transform: rotate(0deg);
            -ms-transform: rotate(0deg);
            -o-transform: rotate(0deg);
            transform: rotate(0deg);
        }

        100% {
            -webkit-transform: rotate(360deg);
            -moz-transform: rotate(360deg);
            -ms-transform: rotate(360deg);
            -o-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }

    @keyframes spinner {
        0% {
            -webkit-transform: rotate(0deg);
            -moz-transform: rotate(0deg);
            -ms-transform: rotate(0deg);
            -o-transform: rotate(0deg);
            transform: rotate(0deg);
        }

        100% {
            -webkit-transform: rotate(360deg);
            -moz-transform: rotate(360deg);
            -ms-transform: rotate(360deg);
            -o-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }


    .modal-dialog {
        width: 100%;
        height: 100%;
        margin: 0;
        padding: 0;
    }

    .modal-content {
        height: auto;
        min-height: 100%;
        border-radius: 0;
    }
</style>


<div style="display: none;" class="loading">Loading&#8230;</div>


<div id="main_show" class="row">
    <div class="col-md-12" id="_list">
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">INPUT DATA</div>
            </div>
            <div class="portlet-body form">
                <!-- BEGIN FORM-->
                <div class="form-body">
                    <form action="#" id="formOrder" class="form-horizontal">
                        <h4 class="form-section">DATA ORDER</h4>
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label class="control-label col-md-5">Nomor Order</label>
                                    <div class="control-label col-md-6">
                                        <strong class="font_biru"><?php echo $nowno ?> Tahun : <?php echo date("Y"); ?></strong>
                                        <input type="hidden" name="nomor_order" id="nomor_order" class="form-control input-sm" value="<?php echo $nowno ?>">
                                        <input type="hidden" name="tahun_order" id="tahun_order" class="form-control input-sm" value="<?php echo date("Y"); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label class="control-label col-md-4">Nama Perusahaan<span class="required" aria-required="true"></span></label>
                                    <div class="col-md-8">
                                        <input oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" type="text" name="nama_perusahaan" id="nama_perusahaan" maxlength="60" class="form-control input-sm mask-nama input_capital" data-rule-required="true" data-msg-required="Nama Lengkap harus diisi" aria-required="true">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label class="control-label col-md-5">Nama Pemohon</label>
                                    <div class="col-md-6">
                                        <input oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" type="text" name="nama_pemohon" id="nama_pemohon" maxlength="40" class="form-control input-sm mask-alamat input_capital">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label class="control-label col-md-4">Alamat Perusahaan</label>
                                    <div class="col-md-8">
                                        <input oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" type="text" name="alamat_perusahaan" id="alamat_perusahaan" maxlength="300" class="form-control input-sm mask-alamat input_capital">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label class="control-label col-md-5">Telepon Perusahaan</label>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-phone"></i>
                                            </span>
                                            <input oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" type="text" name="telp_perusahaan" id="telp_perusahaan" class="form-control input-sm mask-date input_capital" data-rule-dateina="true" data-msg-dateina="Tanggal Berakhir Paspor harus benar">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label class="control-label col-md-4">Fax Perusahaan</label>
                                    <div class="col-md-4">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-fax"></i>
                                            </span>
                                            <input oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" type="text" name="fax_perusahaan" id="fax_perusahaan" class="form-control input-sm mask-date input_capital" data-rule-dateina="true" data-msg-dateina="Tanggal Berakhir Paspor harus benar">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class='row'>
                            <div class="col-m-12">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Dengan Baku Mutu Lingkungan (BML)<span class="required" aria-required="true"></span></label>
                                        <div class="col-md-9">
                                        <textarea name="bml" id="bml" class="form-control" rows="3" maxlength="500"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <h4 class="form-section">CATATAN</h4>
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label class="control-label col-md-5">Tanggal Pengambilan Sample</label>
                                    <div class="col-md-7">
                                        <input oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" type="text" id="tgl_ambil_sample" name="tgl_ambil_sample" class="selectpicker form-control tanggal input_capital">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label class="control-label col-md-4">Transportasi / Pengamanan</label>
                                    <div class="col-md-8">
                                        <input oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" type="text" class="form-control input-sm mask-nama input_capital" name="transportasi" id="transportasi" maxlength="60">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label class="control-label col-md-5">Pengawetan<span class="required" aria-required="true"></span></label>
                                    <div class="col-md-7">
                                        <input oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" type="text" class="form-control input-sm mask-nama input_capital" name="pengawetan" id="pengawetan" maxlength="60" data-rule-required="true" data-msg-required="Nama Petugas Registrasi harus diisi" value="" aria-required="true">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label class="control-label col-md-4">Parameter Lapangan</label>
                                    <div class="col-md-8">
                                        <input oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" type="text" class="form-control input-sm mask-angka input_capital" name="paramlap" id="paramlap" maxlength="18" value="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h4 class="form-section">KWITANSI</h4>
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label class="control-label col-md-5">Catatan Kwitansi<span class="required" aria-required="true"></span></label>
                                    <div class="col-md-7">
                                        <textarea class="form-control input-sm mask-nama input_capital" name="catatanKwi" id="catatanKwi" data-rule-required="true" data-msg-required="Nama Petugas Registrasi harus diisi" value="" aria-required="true"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label class="control-label col-md-4">Tanggal Kwitansi</label>
                                    <div class="col-md-8">
                                        <input oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" type="text" id="tgl_kwi" name="tgl_kwi" class="selectpicker form-control tanggal input_capital">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </form>

                    <button name="sbm" id="btnSimpanOrder" onclick="simpanOrder()" class="btn green pull-right" value="Simpan"><i class="fa fa-save"></i> Simpan Order</button>
                    <br>
                    <br>
                    <br>
                    <button id="btnTambahSample" class="btn blue" onclick="addSample()"><i class="fa fa-plus"></i> Tambah Sample</button>
                    <button class="btn btn-default" onclick="reload_table()"><i class="fa fa-refresh"></i> Reload</button>
                    <h4 class="form-section">DATA SAMPLE</h4>
                    <table id="tableSample" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th style="width: 50px;">Nomor Order</th>
                                <th style="width: 50px;">Tahun Order</th>
                                <th style="width: 50px;">Nomor Sample</th>
                                <th style="width: 50px;">Tahun Sample</th>
                                <th>Parameter</th>
                                <th style="width: 100px;">Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <br>
                    <a class="ajaxify" href="<?php echo site_url('inputData') ?>">
                        <button id="btnNewOrder" class="btn btn-warning"><i class="fa fa-plus"></i>
                            Input Order Baru
                        </button>
                    </a>
               
                    <a title="Cetak tanda terima" id="btnCetak" class="btn btn btn-info" onclick="cetak()"><i class="fa fa-file"> Cetak Order</i></a>
                    <a title="Cetak tanda terima" id="btnCetakKwi" class="btn btn btn-info" onclick="cetak_kwi()"><i class="fa fa-ticket"> Cetak Kwitansi</i></a>

                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12" id="_edit"></div>
    <div id="_gelar"></div>
    <div class="col-md-12" id="_foto"></div>
    <script type="text/javascript">
        $('.tanggal').datepicker({
            format: "dd-mm-yyyy",
            autoclose: true
        });
        // $('.input_capital').on('input', function(evt) {
        //     $(this).val(function(_, val) {
        //         return val.toUpperCase();
        //     });
        // });

        // $(function() {
        //     $('.input_capital').keyup(function() {
        //         this.value = this.value.toLocaleUpperCase();
        //     });
        // });

        // $(".input_capital").keyup(function() {
        //     $(this).val($(this).val().toUpperCase());
        // });



        $('#btnTambahSample').attr('disabled', true); //set button disable 
        $('#btnCetak').attr('disabled', true); //set button disable 
        $('#btnCetakKwi').attr('disabled', true); //set button disable 



        var table;
        var nomor_order = <?php echo $nowno ?>;
        var tahun_order = <?php echo date("Y"); ?>;

        //datatables
        table = $('#tableSample').DataTable({

            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('inputData/sample_list?nomor_order=') ?>" + nomor_order + '&tahun_order=' + tahun_order,
                "type": "POST"
            },

            //Set column definition initialisation properties.
            "columnDefs": [{
                "targets": [0], //first column / numbering column
                "orderable": false, //set not orderable
            }, ],

        });

        function simpanOrder() {
            if (confirm('Simpan Order ?')) {
                $('.loading').fadeIn(function() {
                    $('#btnSimpanOrder').attr('disabled', true); //set button disable 
                    var formData = new FormData($('#formOrder')[0]);
                    $.ajax({
                        url: "<?php echo site_url('inputData/saveData') ?>",
                        type: "POST",
                        data: formData,
                        contentType: false,
                        processData: false,
                        dataType: "JSON",
                        success: function(data) {

                            if (data.status) //if success close modal and reload ajax table
                            {
                                alert('Data Order Berhasil Disimpan');
                                $('#btnTambahSample').attr('disabled', false); //set button disable 
                                $("#formOrder input").attr("disabled", true);
                                $("#catatanKwi").attr("disabled", true);
                                $("#bml").attr("disabled", true);


                                $("#btnNewOrder").attr("disabled", true);

                            } else {
                                for (var i = 0; i < data.inputerror.length; i++) {
                                    $('[name="' + data.inputerror[i] + '"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                                    $('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]); //select span help-block class set text error string
                                }
                            }

                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            alert('Error adding data');
                            $('#btnSimpanOrder').attr('disabled', false); //set button disable 
                        }
                    });
                    $('.loading').fadeOut();

                });
            }
        }

        function addSample() {
            url = "<?php echo site_url('inputData/getNomorSample') ?>";
            save_method = 'add';
            $('#formSample')[0].reset(); // reset form on modals
            $('.form-group').removeClass('has-error'); // clear error class
            $('.help-block').empty(); // clear error string
            $('#modal_formSample').modal('show'); // show bootstrap modal
            $('.modal-title').text('Tambah Sample'); // Set Title to Bootstrap modal title
            $('input[type="checkbox"]').prop('checked', false);
            $.ajax({
                url: url,
                type: "GET",
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function(data) {
                    // $('#maxnoSample').text(data.maxnoSample); // Set Title to Bootstrap modal title
                    $('#nownoSample').text(data.nownoSample); // Set Title to Bootstrap modal title
                    $('#inputNoSample').val(data.nownoSample); // Set Title to Bootstrap modal title
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error adding / update data');
                    $('#btnSave').text('save'); //change button text
                    $('#btnSave').attr('disabled', false); //set button enable 

                }
            });

        }

        function save() {
            $('#btnSave').text('saving...'); //change button text
            $('#btnSave').attr('disabled', true); //set button disable 
            var url;

            if (save_method == 'add') {
                url = "<?php echo site_url('inputData/sampleAdd') ?>";
            } else {
                url = "<?php echo site_url('inputData/sampleEdit') ?>";
            }

            // ajax adding data to database

            var param = [];
            $('.param').each(function() {
                if ($(this).is(":checked")) {
                    param.push($(this).val());
                }
            });
            var jsonStringParam = JSON.stringify(param);

            var formData = new FormData($('#formSample')[0]);
            $.ajax({
                url: url,
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function(data) {

                    if (data.status) //if success close modal and reload ajax table
                    {
                        alert('Data Sample Berhasil Disimpan');
                        $('#modal_formSample').modal('hide');
                        $("#btnNewOrder").attr("disabled", false);
                        reload_table();
                        $('#btnCetak').attr('disabled', false); //set button disable 
                        $('#btnCetakKwi').attr('disabled', false); //set button disable 

                    } else {
                        for (var i = 0; i < data.inputerror.length; i++) {
                            $('[name="' + data.inputerror[i] + '"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                            $('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]); //select span help-block class set text error string
                        }
                    }
                    $('#btnSave').text('save'); //change button text
                    $('#btnSave').attr('disabled', false); //set button enable 


                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error adding / update data');
                    $('#btnSave').text('save'); //change button text
                    $('#btnSave').attr('disabled', false); //set button enable 

                }
            });
        }

        function reload_table() {
            table.ajax.reload(null, false); //reload datatable ajax 
        }
    </script>
</div>


<!-- Bootstrap modal -->
<div class="modal fade" id="modal_formSample" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title"></h3>
                Nomor sample : <nobr id="nownoSample"></nobr> Tahun Sample : <?php echo date("Y"); ?>
            </div>
            <div class="modal-body form">
                <form action="#" id="formSample" class="form-horizontal">
                    <input type="hidden" value="<?php echo $nowno ?> " name="nomor_order" />
                    <input type="hidden" value="<?php echo date("Y"); ?>" name="tahun_order" />
                    <input type="hidden" value="<?php echo $nownoSample ?>" id="inputNoSample" name="nomor_sample" />
                    <input type="hidden" value="<?php echo date("Y"); ?>" name="tahun_sample" />
                    <div class="form-body">
                        <div class="form-group">
                            <div class="col-md-4">
                                <label class="control-label col-md-3">KODE UJI</label>
                                <div class="col-md-6">
                                    <input oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" name="kodeUji" placeholder="Kode Contoh Uji" class="form-control input_capital" type="text">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="control-label col-md-3">UNIT/KEMASAN</label>
                                <div class="col-md-6">
                                    <input oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" name="unit" placeholder="Unit" class="form-control input_capital" type="text">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="control-label col-md-3">JUMLAH(Ml)</label>
                                <div class="col-md-6">
                                    <input oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" name="jumlah" placeholder="Jumlah" class="form-control input_capital" type="text">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <?php
                                foreach ($paramData as $listParam) {
                                ?>
                                    <div class="col-md-4">
                                        <div class="checkbox">
                                            <label><input class="param" name="check[]" id="id<?php echo $listParam['id_param'] ?>" type="checkbox" value="<?php echo $listParam['id_param'] ?>"><?php echo $listParam['nama_param'] ?></label>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->





<script type='text/javascript'>
    function cetak() {
        var list = [];
        var filTahun = $("#tahun_order").val();
        $("#nomor_order").each(function() {
            list.push(this.value);
        });
        let url = "<?php echo site_url('cetak/showModal') ?>";
        $("#modalCetak").modal('show');
        $('#komentar').val('');
        $.post(url, {
                listid: list,
                tahun: filTahun,
            },
            function(html) {
                $("#modal_arsiptiket").html(html);
            }
        );
    };

    function cetak_kwi() {
        var list = [];
        var filTahun = $("#tahun_order").val();
        $("#nomor_order").each(function() {
            list.push(this.value);
        });
        let url = "<?php echo site_url('cetak/showModalKwi') ?>";
        $("#modalCetakKwi").modal('show');
        $('#komentar').val('');
        $.post(url, {
                listid: list,
                tahun: filTahun,
            },
            function(html) {
                $("#modal_arsiptiketKwi").html(html);
            }
        );
    };
</script>



<!-- Modal tiket -->
<div class="modal fade" id="modalCetak" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <input type="hidden" value="" name="id_pengajuan" id='id_pengajuan' />
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-titlex" id="myModalLabel">Lembar Order</h4>
            </div>
            <div class="modal-body" id='modal_arsiptiket'>
            </div>

            <div class="form-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>


<!-- Modal tiket -->
<div class="modal fade" id="modalCetakKwi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <input type="hidden" value="" name="id_pengajuan" id='id_pengajuan' />
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-titlex" id="myModalLabel">Kwitansi</h4>
            </div>
            <div class="modal-body" id='modal_arsiptiketKwi'>
            </div>

            <div class="form-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>