           <?php
            defined('BASEPATH') or exit('No direct script access allowed');
            ?>

           <ul class="nav nav-tabs" role="tablist">
             <li class="nav-item active">
               <a class="nav-link" href="#order" role="tab" data-toggle="tab">Lembar Order</a>
             </li>
             <li class="nav-item">
               <a class="nav-link" href="#profile" role="tab" data-toggle="tab">Profile</a>
             </li>
             <li class="nav-item">
               <a class="nav-link" href="#param" role="tab" data-toggle="tab">Parameter</a>
             </li>
             <li class="nav-item">
               <a class="nav-link" href="#backupDb" role="tab" data-toggle="tab">Backup Database</a>
             </li>
           </ul>

           <!-- Tab panes -->
           <div class="tab-content">
             <div role="tabpanel" class="tab-pane fade in active" id="order">

               <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                 <div class="dashboard-stat white">
                   <div class="form-horizontal">
                     <div class="form-group">
                       <label class="control-label col-sm-4" style="text-align:left" for="tglIso">Tanggal ISO</label>
                       <div class="col-sm-8">
                         <?php
                            $user = $this->ion_auth->user()->row()->wilayah;
                            if($user=='ADMIN'){
                              ?>
                               <input type="text" class="form-control input_capital" id="tglIso" value="<?php echo $configDataTglIso ?>">
                              <?php
                            }else{
                              ?>
                               <input type="text" class="form-control input_capital" id="tglIso" value="<?php echo $configDataTglIso ?>" disabled>   
                              <?php
                            } 
                         ?>

                       </div>
                     </div>
                     <div class="form-group">
                       <label class="control-label col-sm-4" style="text-align:left" for="formIso">Form ISO</label>
                       <div class="col-sm-8">
                         <?php
                            $user = $this->ion_auth->user()->row()->wilayah;
                            if($user=='ADMIN'){
                              ?>
                               <input type="text" class="form-control input_capital" id="formIso" value="<?php echo $configDataFormIso ?>">
                              <?php
                            }else{
                              ?>
                               <input type="text" class="form-control input_capital" id="formIso" value="<?php echo $configDataFormIso ?>" disabled> 
                              <?php
                            } 
                         ?>

                       </div>
                     </div>
                     <div class="form-group">
                       <label class="control-label col-sm-4" style="text-align:left" for="noreg">Tebitan</label>
                       <div class="col-sm-8">
                       <?php
                            $user = $this->ion_auth->user()->row()->wilayah;
                            if($user=='ADMIN'){
                              ?>
                               <input type="text" min="2020" class="form-control input_capital" id="terbitan" value="<?php echo $configDataTerbitan ?>">
                              <?php
                            }else{
                              ?>
                               <input type="text" min="2020" class="form-control input_capital" id="terbitan" value="<?php echo $configDataTerbitan ?>" disabled>
                              <?php
                            } 
                         ?>
                       </div>
                     </div>
                     
                     <!-- <div class="form-group">
                       <label class="control-label col-sm-4" style="text-align:left" for="noreg">Baku Mutu Lingkungan</label>
                       <div class="col-sm-8">
                         <?php
                            $user = $this->ion_auth->user()->row()->wilayah;
                            if($user=='ADMIN'){
                              ?>
                               <input type="text" min="2020" class="form-control input_capital" id="bml" value="<?php echo $configDataBml ?>">
                              <?php
                            }else{
                              ?>
                               <input type="text" min="2020" class="form-control input_capital" id="bml" value="<?php echo $configDataBml ?>" disabled>
                              <?php
                            } 
                         ?>

                       </div>
                     </div> -->
                     
                     <?php
                      $user = $this->ion_auth->user()->row()->wilayah;
                      if($user=='ADMIN'){
                        ?>
                          <div class="form-group">
                            <div class="col-sm-offset-4 col-sm-8">
                              <button id="save_data" onclick="saveConfig()" class="btn btn-primary">Save</button>
                            </div>
                          </div>                            
                        <?php
                      } 
                      ?>

                   </div>
                 </div>
               </div>
             </div>

             <div role="tabpanel" class="tab-pane fade" id="profile">
               <div class="col-md-6">
                 <div style="text-align:center;" class="card-header">
                   <h3>Ubah Password</h3>
                 </div>
                 <div class="form-group has-success has-feedback">
                   <label class="control-label" for="inputSuccess2">Password Baru</label>
                   <input id="passbaru1" type="password" class="form-control" autocomplete="false" placeholder="Input Password" name="password" aria-label="Recipient's username" aria-describedby="basic-addon2">
                   <div onclick="show1('newPass')">
                     <span class="form-control-feedback"><i id="p1" toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></i></span>
                   </div>
                   <div class="nullpass1" style="color:red;display:none">
                     Tidak Boleh Kosong
                   </div>
                 </div>
                 <div class="form-group has-success has-feedback">
                   <label class="control-label" for="inputSuccess2">Ulangi Password Baru</label>
                   <input id="passbaru2" type="password" class="form-control" autocomplete="false" placeholder="Input Password" name="password" aria-label="Recipient's username" aria-describedby="basic-addon2">
                   <div onclick="show2('newPass')">
                     <span class="form-control-feedback"><i id="p2" toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></i></span>
                   </div>
                   <div id="notmatch" style="color:red;display:none">
                     Password tidak sama
                   </div>
                   <div class="nullpass2" style="color:red;display:none">
                     Tidak Boleh Kosong
                   </div>
                 </div>
                 <button id="savechangepass" class="btn btn-primary" onclick="savechangepass()">Simpan</button>
               </div>
             </div>



             <div role="tabpanel" class="tab-pane fade" id="param">
                      <?php
                      $user = $this->ion_auth->user()->row()->wilayah;
                      if($user=='ADMIN'){
                        ?>
                         <button class="btn btn-success" onclick="addParam()"><i class="fa fa-plus"></i> Tambah Parameter</button>                      
                        <?php
                      } 
                      ?>

               <button class="btn btn-default" onclick="reload_table()"><i class="fa fa-refresh"></i> Reload</button>
               <br />
               <br />
               <table id="tableParam" class="table table-striped table-bordered" cellspacing="0" width="100%">
                 <thead>
                   <tr>
                     <th>No</th>
                     <th>Nama Parameter</th>
                     <th>Tipe Parameter</th>
                     <th>Harga</th>
                     <th>Action</th>
                   </tr>
                 </thead>
                 <tbody>
                 </tbody>
               </table>
             </div>


             <div role="tabpanel" class="tab-pane fade" id="backupDb">
               <button class="btn btn-success" onclick="backupDb()"><i class="fa fa-save"></i> Backup Database</button>
               <a href="<?php echo base_url() ?>backupDb/downloadDb">
                 <button class="btn btn-primary"><i class="fa fa-download"></i> Download Backup Database</button>
               </a>
             </div>

           </div>




           <script type="text/javascript">
             function show1(id) {
               var a = document.getElementById('passbaru1');
               $("#p1").toggleClass("fa-eye fa-eye-slash");

               if (a.type == "password") {
                 a.type = "text";
                 $('#td_id').removeClass('fa-eye').addClass('fa-slash');
               } else {
                 a.type = "password";

               }
             }

             function show2(id) {
               var a = document.getElementById('passbaru2');
               $("#p2").toggleClass("fa-eye fa-eye-slash");

               if (a.type == "password") {
                 a.type = "text";
                 $('#td_id').removeClass('fa-eye').addClass('fa-slash');
               } else {
                 a.type = "password";

               }
             }


             function backupDb() {

               $.ajax({
                 url: "<?php echo site_url('backupDb') ?>",
                 type: "GET",
                 dataType: "JSON",
                 success: function(data) {
                   if (data.status == 'ok') {
                     alert("Database Berhasil Disimpan di folder backup");
                     //           window.location.href = "<?php echo site_url() ?>";
                   };
                 },
                 error: function(jqXHR, textStatus, errorThrown) {
                   alert("Database Gagal disimpan !");
                 }
               });
             }

             function saveConfig() {

               var tglIso = document.getElementById("tglIso").value;
               var formIso = document.getElementById("formIso").value;
               var terbitan = document.getElementById("terbitan").value;
               var bml = document.getElementById("bml").value;

               $.ajax({
                 url: "<?php echo site_url('profile/saveConfig') ?>",
                 data: {
                   tglIso: tglIso,
                   formIso: formIso,
                   terbitan: terbitan,
                   bml: bml
                 },
                 type: "POST",
                 dataType: "JSON",
                 success: function(data) {
                   if (data.status == 'ok') {
                     alert("Data Config berhasil diupdate");
                     window.location.href = "<?php echo site_url() ?>";
                   };
                 },
                 error: function(jqXHR, textStatus, errorThrown) {
                   alert("Data Config error diupdate !");
                 }
               });
             }

             function savechangepass() {

               var passbaru1 = document.getElementById("passbaru1").value;
               var passbaru2 = document.getElementById("passbaru2").value;


               if (passbaru1 == "") {
                 $('.nullpass1').show();
                 return false;
               } else if (passbaru2 == "") {
                 $('.nullpass2').show();
                 return false;
               } else if (passbaru1 != passbaru2) {
                 $('#notmatch').show();
                 return false;
               } else {
                 //                alert('logic benar');

                 $.ajax({
                   url: "<?php echo site_url('profile/changepass') ?>",
                   data: {
                     passbaru1: passbaru1,
                     passbaru2: passbaru2
                   },
                   type: "POST",
                   dataType: "JSON",
                   success: function(data) {
                     if (data.status == 'ok') {
                       alert("Password berhasil di ubah");
                       window.location.href = "<?php echo site_url('auth/logout') ?>";
                       //                            document.getElementById("passlama").value = "";
                       //                            document.getElementById("passbaru1").value = "";
                       //                            document.getElementById("passbaru2").value = "";
                     };
                   },
                   error: function(jqXHR, textStatus, errorThrown) {

                   }
                 });

               }
             }
           </script>

           <script type="text/javascript">
             var save_method; //for save method string
             var table;
             var base_url = '<?php echo base_url(); ?>';

             $(document).ready(function() {

               //datatables
               table = $('#tableParam').DataTable({

                 "processing": true, //Feature control the processing indicator.
                 "serverSide": true, //Feature control DataTables' server-side processing mode.
                 "order": [], //Initial no order.

                 // Load data for the table's content from an Ajax source
                 "ajax": {
                   "url": "<?php echo site_url('param/paramList') ?>",
                   "type": "POST"
                 },

                 //Set column definition initialisation properties.
                 "columnDefs": [{
                     "targets": [-1], //last column
                     "orderable": false, //set not orderable
                   },
                   {
                     "targets": [-2], //2 last column (photo)
                     "orderable": false, //set not orderable
                   },
                 ],

               });
               //datepicker
               $('.datepicker').datepicker({
                 autoclose: true,
                 format: "yyyy-mm-dd",
                 todayHighlight: true,
                 orientation: "top auto",
                 todayBtn: true,
                 todayHighlight: true,
               });

               //set input/textarea/select event when change value, remove class error and remove text help block 
               $("input").change(function() {
                 $(this).parent().parent().removeClass('has-error');
                 $(this).next().empty();
               });
               $("textarea").change(function() {
                 $(this).parent().parent().removeClass('has-error');
                 $(this).next().empty();
               });
               $("select").change(function() {
                 $(this).parent().parent().removeClass('has-error');
                 $(this).next().empty();
               });

             });

             function reload_table() {
               table.ajax.reload(null, false); //reload datatable ajax 
             }



             function addParam() {
               save_method = 'add';
               $('#formParam')[0].reset(); // reset form on modals
               $('.form-group').removeClass('has-error'); // clear error class
               $('.help-block').empty(); // clear error string
               $('#modal_formParam').modal('show'); // show bootstrap modal
               $('.modal-title').text('Tambah Parameter'); // Set Title to Bootstrap modal title
             }

             function saveParameter() {
               $('#btnSave').text('saving...'); //change button text
               $('#btnSave').attr('disabled', true); //set button disable 
               var url;

               if (save_method == 'add') {
                 url = "<?php echo site_url('param/addParam') ?>";
               } else {
                 url = "<?php echo site_url('param/updateParam') ?>";
               }

               // ajax adding data to database

               var formData = new FormData($('#formParam')[0]);
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
                     $('#modal_formParam').modal('hide');
                     reload_table();
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

             function deleteParam(idParam) {
               if (confirm('Hapus Data Parameter?')) {
                 // ajax delete data to database
                 $.ajax({
                   url: "<?php echo site_url('param/deleteParam') ?>/" + idParam,
                   type: "POST",
                   dataType: "JSON",
                   success: function(data) {
                     //if success reload ajax table
                     $('#modal_formParam').modal('hide');
                     reload_table();
                   },
                   error: function(jqXHR, textStatus, errorThrown) {
                     alert('Error deleting data');
                   }
                 });

               }
             }

             function editParam(idParam) {
               save_method = 'update';
               $('#formParam')[0].reset(); // reset form on modals
               $('.form-group').removeClass('has-error'); // clear error class
               $('.help-block').empty(); // clear error string

               //Ajax Load data from ajax
               $.ajax({
                 url: "<?php echo site_url('param/editParam') ?>/" + idParam,
                 type: "GET",
                 dataType: "JSON",
                 success: function(data) {

                   $('[name="id_param"]').val(data.id_param);
                   $('[name="namaParameter"]').val(data.nama_param);
                   $('[name="tipeParameter"]').val(data.tipe_param);
                   $('[name="harga"]').val(data.harga);

                   $('#modal_formParam').modal('show'); // show bootstrap modal when complete loaded
                   $('.modal-title').text('Edit Parameter'); // Set title to Bootstrap modal title

                   $('#photo-preview').show(); // show photo preview modal

                 },
                 error: function(jqXHR, textStatus, errorThrown) {
                   alert('Error get data from ajax');
                 }
               });
             }
           </script>


           <!-- Bootstrap modal -->
           <div class="modal fade" id="modal_formParam" role="dialog">
             <div class="modal-dialog">
               <div class="modal-content">
                 <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                   <h3 class="modal-title"></h3>
                 </div>
                 <div class="modal-body form">
                   <form action="#" id="formParam" class="form-horizontal">
                     <input type="hidden" value="" name="id_param" />
                     <div class="form-body">
                       <div class="form-group">
                         <label class="control-label col-md-3">Nama Parameter</label>
                         <div class="col-md-9">
                           <input name="namaParameter" placeholder="Nama Parameter" class="form-control" type="text">
                           <span class="help-block"></span>
                         </div>
                       </div>
                       <div class="form-group">
                         <label class="control-label col-md-3">Tipe Parameter</label>
                         <div class="col-md-9">
                           <input name="tipeParameter" placeholder="Tipe Parameter" class="form-control" type="text">
                           <span class="help-block"></span>
                         </div>
                       </div>
                       <div class="form-group">
                         <label class="control-label col-md-3">Harga</label>
                         <div class="col-md-9">
                           <input name="harga" placeholder="Harga" class="form-control" type="number">
                           <span class="help-block"></span>
                         </div>
                       </div>

                     </div>
                   </form>
                 </div>
                 <div class="modal-footer">
                   <button type="button" id="btnSave" onclick="saveParameter()" class="btn btn-primary">Save</button>
                   <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                 </div>
               </div><!-- /.modal-content -->
             </div><!-- /.modal-dialog -->
           </div><!-- /.modal -->
           <!-- End Bootstrap modal -->