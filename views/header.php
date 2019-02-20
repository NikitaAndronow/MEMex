<?php Session::init(); ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <title>Document</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo URL; ?>public/css/default.css">
    <script src="<?php echo URL; ?>public/js/jquery-3.2.1.min.js"></script>
    <script src="http://malsup.github.com/jquery.form.js"></script> 
    <script src="https://use.fontawesome.com/8e8bd153da.js"></script>
    <!-- Magnific Popup core CSS file -->
        <link rel="stylesheet" href="../public/js/pupup/magnific-popup.css">
       
        <script src="../public/js/pupup/jquery.magnific-popup.min.js"></script>
        <!-- Magnific Popup core JS file -->
     
  
    
    <!-- Add the slick-theme.css if you want default styling -->
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick.css"/>
<!-- Add the slick-theme.css if you want default styling -->
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick-theme.css"/>
  <script type="text/javascript" src="//cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick.min.js"></script>  
      <?php 
    if (isset($this->js))
    {
        foreach($this->js as $js)
        {
       echo '<script src="'.URL.'views/'.$js.' "></script>';
        }
    }
    
    ?>
    
    
</head>

<body>

    <div id="header">
        <div class="container">

            <div class="row">
                <div class="col-sm-8 col-md-8">
                   
                    <a href="<?php echo URL; ?>index"><img class="mainIcon" src="../public/img/icon_memex.png" alt="MemEX">MEMEX</a>
                   
                    <!-- <a href="<?php echo URL; ?>help"><i class="fa fa-info-circle" aria-hidden="true"></i> Help</a> -->
                      <?php if (Session::get("loggedIn")==true ):?>
                    
                      <?php if (Session::get("role")=="admin" ):?>
                       <a href="<?php echo URL; ?>admin"> <i class="fa fa-unlock-alt" aria-hidden="true"></i> Admin</a>
                         <?php endif; ?> 
                    <!-- <a href="<?php echo URL; ?>dashboard"><i class="fa fa-home" aria-hidden="true"></i>Dashboard</a>-->
                       <a href="<?php echo URL; ?>board"><i class="fa fa-leanpub" aria-hidden="true"></i>Card Board</a>
                       <a href="<?php echo URL; ?>test"><i class="fa fa-play" aria-hidden="true"></i>Test</a>
                        <a href="<?php echo URL; ?>study">  <i class="fa fa-graduation-cap" aria-hidden="true"></i>Study</a>
                        <?php endif; ?>

                </div>
                <div class="col-sm-4 col-md-4 myRight">
                    <?php if (Session::get("loggedIn")==true ):?>
                   
                    <a href="<?php echo URL; ?>dashboard/logout"><i class="fa fa-sign-out" aria-hidden="true"></i>Logout</a>


                    <?php else: ?>

                    <a href="<?php echo URL; ?>login"><i class="fa fa-sign-in" aria-hidden="true"></i> Login</a>

                    <?php endif; ?>
                    <a href="<?php echo URL; ?>registration"><i class="fa fa-plus-square" aria-hidden="true"></i>Registration</a>
                </div>
            </div>




        </div>
    </div>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="wrap-content">
