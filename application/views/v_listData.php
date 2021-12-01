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

       <button class="btn btn-default" onclick="reload_table()"><i class="fa fa-refresh"></i> Reload</button>
       <h4 class="form-section">LIST DATA</h4>
       <table id="tableListData" class="table table-striped table-bordered" cellspacing="0" width="100%">
           <thead>
               <tr>
                   <th>Nomor Order</th>
                   <th>Tahun Order</th>
                   <th>Nama Perusahaan</th>
                   <th>Kontak</th>
                   <th><input type="checkbox" id="check-all"></th>
                   <th>Detail</th>
                   <th>Action</th>
               </tr>
           </thead>
           <tbody>
           </tbody>
       </table>
       <br>
       <div class="col-md-3">
           <select name="opsi_cetak" class="form-control input-sm" id="opsi_cetak">
               <option value="0" selected="selected">-- PILIHAN --</option>
               <option value="1">Lembar Order</option>
               <option value="2">Kwitansi</option>
           </select>
       </div>
       <div class="col-md-2" align="left">
           <button style="display: none;" onclick="cetak()" class="btn blue btn-sm btnCetak" id="btnCtk" data-list="listCetak" data-target="_edit" data-hidden="_list" style="display: inline-block;">
               <i class="fa fa-print"></i>Cetak
           </button>
           <button style="display: none;" onclick="cetak_kwi()" class="btn blue btn-sm btnCetak" id="btnCtkKwi" data-list="listCetak" data-target="_edit" data-hidden="_list" style="display: inline-block;">
               <i class="fa fa-print"></i>Cetak
           </button>
       </div>

   </div>

   <script type="text/javascript">
       $("#opsi_cetak").change(function() {
           var val = $(this).val();
           if (val === "0") {
               // $("#btnCtk").show();
               $("#btnCtk").hide();
               $("#btnCtkKwi").hide();
           } else if (val === "1") {
               $("#btnCtk").show();
               $("#btnCtkKwi").hide();
           } else if (val === "2") {
               $("#btnCtkKwi").show();
               $("#btnCtk").hide();
           }
       });

       $("#check-all").click(function() {
           $(".data-check").prop('checked', $(this).prop('checked'));
       });

       var table;
       var tahun_orderFil;
       var tahun_order = <?php echo date("Y"); ?>;


       //datatables
       table = $('#tableListData').DataTable({

           "processing": true, //Feature control the processing indicator.
           "serverSide": true, //Feature control DataTables' server-side processing mode.
           "order": [], //Initial no order.

           // Load data for the table's content from an Ajax source
           "ajax": {
               "url": "<?php echo site_url('listData/listDataYear?tahun_order=') ?>" + tahun_order,
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
           $('#tableListData').DataTable().ajax.url("<?php echo site_url('listData/listDataYear?tahun_order=') ?>" + tahun_orderInput).load();

       }

       function reload_table() {
           table.ajax.reload(null, false); //reload datatable ajax 
       }

       function cetak() {
           var filterTahun;
           var filTahun = $("#filTahun").val();

           if (filTahun != tahun_order) {
               filterTahun = filTahun;
           } else {
               filterTahun = tahun_order;
           }
           var list = [];
           $("#nomor_order:checked").each(function() {
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
           var filterTahun;
           var filTahun = $("#filTahun").val();
           if (filTahun != tahun_order) {
               filterTahun = filTahun;
           } else {
               filterTahun = tahun_order;
           }
           var list = [];
           $("#nomor_order:checked").each(function() {
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

       function deleteOrder(nomor_order, tahun_order) {
           if (confirm('Delete Order ini?')) {
               // ajax delete data to database
               $.ajax({
                   url: "<?php echo site_url('listData/deleteOrder?nomor_order=') ?>" + nomor_order + "&tahun_order=" + tahun_order,
                   type: "POST",
                   dataType: "JSON",
                   success: function(data) {
                       //if success reload ajax table
                       // $('#modal_form').modal('hide');
                       reload_table();
                   },
                   error: function(jqXHR, textStatus, errorThrown) {
                       alert('Error deleting data');
                   }
               });

           }
       }
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