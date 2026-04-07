<!DOCTYPE html>
<html>
<head>
    <title>Steyler Beanery Login</title>
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    <!-- Web Fonts  -->
    <link rel="apple-touch-icon" sizes="128x128" href="<?= base_url(); ?>assets\images\BEANERY-removebg-preview.png">
    <link rel="icon" type="image" href="<?= base_url(); ?>assets\images\BEANERY-removebg-preview.png"/>
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/vendor/bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" href="<?= base_url(); ?>assets/vendor/font-awesome/css/font-awesome.css" />
    <link rel="stylesheet" href="<?= base_url(); ?>assets/vendor/magnific-popup/magnific-popup.css" />
    <link rel="stylesheet" href="<?= base_url(); ?>assets/vendor/bootstrap-datepicker/css/datepicker3.css" />

    <!-- Theme CSS -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/vendor/pnotify/pnotify.custom.css" />

    <link rel="stylesheet" href="<?= base_url(); ?>assets/stylesheets/theme.css" />

    <!-- Skin CSS -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/stylesheets/skins/default.css" />

    <!-- Theme Custom CSS -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/stylesheets/theme-custom.css">

    <!-- Head Libs -->
    <script src="<?= base_url(); ?>assets/vendor/modernizr/modernizr.js"></script>

</head>


<body>
    <!-- start: page -->
    <section class="body-sign">
        <div class="center-sign">
            <div class="panel panel-sign">
                <div class="row">
                    <div class="col-md-6">
                        <div class="col-md-offset-4 col-md-8">
                            <div class="panel-body-login">
                                <img class="img-responsive" src="<?= base_url(); ?>assets\images\BEANERY-removebg-preview.png" alt="Steyler Beanery"  style="min-height: 260px !important; max-height: 380px !important; min-width: 310px !important;" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 align-items-center">    
                        <div class="col-md-8">
                            <div class="panel-body" style="background: #FFF !important; min-height: 380px !important; max-height: 380px !important; min-width: 310px !important;">
                                <?php echo form_open('login/verify', array('id'=>'login')); ?>
                                    <div class="form-group mb-lg">
                                        <label><b>Username</b></label>
                                        <div class="input-group input-group-icon">
                                            <input name="username" type="text" class="form-control input-lg" />
                                            <span class="input-group-addon">
                                                <span class="icon icon-lg">
                                                    <i class="fa fa-user"></i>
                                                </span>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="form-group mb-lg">
                                        <div class="clearfix">
                                            <label class="pull-left"><b>Password</b></label>
                                            <?php 
                                                // echo anchor('login/forgotpassword', 'Lost Password?', array('class'=> 'pull-right')); 
                                            ?>
                                        </div>
                                        <div class="input-group input-group-icon">
                                            <input name="password" type="password" class="form-control input-lg" />
                                            <span class="input-group-addon">
                                                <span class="icon icon-lg">
                                                    <i class="fa fa-lock"></i>
                                                </span>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-8">
                                        </div>
                                        <div class="col-sm-4 text-right">
                                            <button type="submit" class="btn btn-primary hidden-xs">Log In</button>
                                            <button type="submit" class="btn btn-primary btn-block btn-lg visible-xs mt-lg">Log In</button>
                                        </div>
                                    </div>

                                <?php echo form_close(); ?> 
                                <br>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <p class="text-center mt-md mb-md">&copy; Copyright @ Steyler Beanery <?= date('Y') ?>. All Rights Reserved.</p>
        </div>
    </section>
    <!-- end: page -->
    <!-- Vendor -->
    <script src="<?= base_url(); ?>assets/vendor/jquery/jquery.js"></script>
    <script src="<?= base_url(); ?>assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
    <script src="<?= base_url(); ?>assets/vendor/bootstrap/js/bootstrap.js"></script>
    <script src="<?= base_url(); ?>assets/vendor/nanoscroller/nanoscroller.js"></script>
    <script src="<?= base_url(); ?>assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <script src="<?= base_url(); ?>assets/vendor/magnific-popup/magnific-popup.js"></script>
    <script src="<?= base_url(); ?>assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>
    <script src="<?= base_url(); ?>assets/vendor/pnotify/pnotify.custom.js"></script>
    
    <!-- Theme Base, Components and Settings -->
    <script src="<?= base_url(); ?>assets/javascripts/theme.js"></script>
    
    <!-- Theme Custom -->
    <script src="<?= base_url(); ?>assets/javascripts/theme.custom.js"></script>
    
    <!-- Theme Initialization Files -->
    <script src="<?= base_url(); ?>assets/javascripts/theme.init.js"></script>
</body>

<script>
    var getaction = '<?= $flashdata ?>';

    if(getaction != ''){
        if(getaction == 'success'){
            new PNotify({
              title: 'SUCCESS',
              text: 'You successfully submitted the registration form. You can now LOGIN.',
              delay: 20000,
              type: 'success',
              sticker: true
            });
        } else if(getaction == 'deactivated'){
            new PNotify({
              title: 'Account is NOT YET ACTIVATED or SUSPENDED',
              text: 'Your account is not yet activated or tagged as suspended by the Administrator.',
              delay: 20000,
              type: 'error',
              sticker: true
            });
        } else if(getaction == 'invalidkey') {
            new PNotify({
              title: 'ERROR',
              text: 'The URL provided is invalid or the activation key has already been used.',
              delay: 5000,
              type: 'error',
              sticker: true
            });
        } else if(getaction == 'successrecover') {
            new PNotify({
              title: 'SUCCESS',
              text: 'Successfully changed password.',
              delay: 5000,
              type: 'success',
              sticker: true
            });
        } else if(getaction == 'invalidregistration') {
            new PNotify({
              title: 'Invalid registration',
              text: 'Unsuccessful registration. Please try again. If registration fails again, please contact the administrator',
              delay: 3000,
              type: 'error',
              sticker: true
            });
        } else {
            new PNotify({
              title: 'Invalid Username or Password',
              text: 'Invalid username/password. Please try again.',
              delay: 3000,
              type: 'error',
              sticker: true
            });
        }
    }
</script>
</html>
