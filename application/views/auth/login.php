<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<head>
    <meta charset="utf-8" />
    <title>SIPALAB</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="<?php echo $this->config->item('nama_site') ?>" name="description" />
    <meta content="ade muchlis" name="author" />

    <link rel="shortcut icon" href="<?php echo base_url() ?>assets/img/favicon.png" />

    <link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlogin/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link href="<?php echo base_url() ?>assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url() ?>assets/adminlogin/bootstrap/css/my_style.css" rel="stylesheet" media="screen" />
    <link href="<?php echo base_url() ?>assets/adminlogin/bootstrap/css/index.css" rel="stylesheet" media="screen" />

    <link rel="icon" type="image/png" href="<?php echo base_url() ?>assets/img/favicon.png" />

</head>

<body id="login">
    <div class="container">
        <div class="row-fluid">
            <div class="span6">
                <div class="title_index">
                    <div class="row-fluid">
                        <div class="span12"></div>
                        <div class="row-fluid">
                            <div class="span10">
                            </div>
                            <div class="row" style='margin-top: 200px;'>
                                <div class='col-md-6'>
                                    <div class="motto" style='background-color:rgba(0, 240, 152, 0.47);border-radius: 25px;'>
                                        <p style='color:black'>SISTEM PENGELOLAAN ADMINISTRASI PELAYANAN PENGUJIAN LABORATORIUM</p>
                                        <!-- <h2><b>ARDIK</b></h2> -->
                                    </div>
                                </div>

                                <div class='col-md-4' style='border-radius: 25px;background-color:rgba(0, 240, 152, 0.47);padding-top:20px;padding-right:20px;padding-bottom:20px;padding-left:20px'>
                                    <?php if ($message) : ?>
                                        <div class="alert alert-warning">
                                            <?php echo $message; ?>
                                        </div>
                                    <?php endif; ?>
                                    <form style='backgroud-color:red' id="login_form1" class="form col-md-12 center-block" action="<?php echo site_url('auth/login'); ?>" method="post" class="form col-md-12 center-block">
                                        <h3 class="form-signin-heading"><i class="fa fa-lock"></i> <b style='color:#000'>SILAHKAN LOGIN</b></h3>
                                        <br>
                                        <div class="input-group mb-3">
                                            <input type="text" id='identity' name='identity' class="form-control" placeholder="Input Username" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                        </div>

                                        <div class="input-group mb-3">
                                            <input id="password-field" type="password" class="form-control" autocomplete="false" placeholder="Input Password" name="password" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                            <div class="input-group-append" onclick="show('newPass')">
                                                <span class="input-group-text" id="basic-addon2"><i id="p" toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></i></span>
                                            </div>

                                        </div>

                                        <div class="form-group">
                                            <?php echo form_submit('submit', lang('login_submit_btn'), 'class="btn btn-info"'); ?>
                                            <br>
                                            <br>
                                        </div>
                                    </form>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>

    <footer style='
        position: absolute;
        right: 0;
        bottom: 0;
        left: 0;
        padding: 1rem;
        text-align: center;
	'>
        <!-- <p style='color:#000'>ademuchlis &copy; <?php echo date('Y'); ?></p> -->
    </footer>



    </div>
</body>

<script src="<?php echo base_url() ?>assets/plugins/jquery-1.10.2.min.js" type="text/javascript"></script>

<script>
    function show(id) {
        var a = document.getElementById('password-field');
        $("#p").toggleClass("fa-eye fa-eye-slash");

        if (a.type == "password") {
            a.type = "text";
            $('#td_id').removeClass('fa-eye').addClass('fa-slash');
        } else {
            a.type = "password";

        }
    }

    $('.input_capital').on('input', function(evt) {
        $(this).val(function(_, val) {
            return val.toUpperCase();
        });
    });
</script>