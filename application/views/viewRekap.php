<div class="dashboard-stat white">
    <div class="form-group row">
        <div class="col-xs-1">
            <div class="input-group">
                <input type="text" id="filTahun" value="<?php echo date("Y"); ?>" name="filTahun" class="selectpicker form-control tanggal">
            </div>
        </div>
        <div class="col-xs-2">
            <button type="button" class="btn btn-primary" id="filter" onclick="goFilter()">Filter</button>
        </div>
    </div>

</div>

<button class="btn btn-default" onclick="reload_table()"><i class="fa fa-refresh"></i> Reload</button>
<h4 class="form-section">LIST DATA</h4>
<table id="tableListDataRekap" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>Nomor Order</th>
            <th>Tahun Order</th>
            <th>Nomor sample</th>
            <th>Tahun Sample</th>
            <th>Perusahaan</th>
            <th>Pemohon</th>
            <th>Telp</th>
            <th>Kode Uji</th>
            <th>Unit</th>
            <th>Jumlah</th>
            <th>Param</th>
            <th>Harga</th>
            <th>Tanggal</th>


        </tr>
    </thead>
    <tbody>
    </tbody>
</table>

<script type="text/javascript">
    var table;
    var tahun_orderFil;
    var tahun_order = <?php echo date("Y"); ?>;


    //datatables
    table = $('#tableListDataRekap').DataTable({

        "lengthMenu": [
            [10, 25, 50, -1],
            ['10', '25', '50', 'All']
        ],
        "scrollX": true,
        "dom": 'Blfrtip',
        "buttons": [{
            extend: 'excel',
            customizeData: function(data) {
                for (var i = 0; i < data.body.length; i++) {
                    for (var j = 0; j < data.body[i].length; j++) {
                        if (data.header[j] == "NO DOKUMEN") {
                            data.body[i][j] = '\u200C' + data.body[i][j];
                        }
                    }
                }
            },
            text: 'Export Excel'
        }],
        "pageLength": 10,

        "destroy": true,


        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('rekapData/listDataYearRekap?tahun_order=') ?>" + tahun_order,
            "type": "POST"
        },

        //Set column definition initialisation properties.
        "columnDefs": [{
            "targets": [0, 4, 5, 6], //first column / numbering column
            "orderable": false, //set not orderable
        }, ],
    });

    function goFilter() {
        var tahun_orderInput = $("#filTahun").val();
        $('#tableListDataRekap').DataTable().ajax.url("<?php echo site_url('rekapData/listDataYearRekap?tahun_order=') ?>" + tahun_orderInput).load();

    }

    function reload_table() {
        table.ajax.reload(null, false); //reload datatable ajax 
    }
</script>