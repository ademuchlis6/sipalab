<input type="checkbox" class="custom-control-input data-check" value="1">
<input type="checkbox" class="custom-control-input data-check" value="2">


<a title="Cetak tanda terima" class="btn btn-sm btn-info" onclick="cetak()"><i class="fa fa-ticket"></i></a>

<a title="Cetak tanda terima" class="btn btn-sm btn-info" onclick="cetak_kwi()"><i class="fa fa-ticket"></i></a>


<script type='text/javascript'>
    function cetak() {
        var list = [];
        var filTahun = 2020;
        $(".data-check:checked").each(function() {
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
        var filTahun = 2020;
        $(".data-check:checked").each(function() {
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
                <h4 class="modal-title" id="myModalLabel">Lembar Order</h4>
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
                <h4 class="modal-title" id="myModalLabel">Kwitansi</h4>
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