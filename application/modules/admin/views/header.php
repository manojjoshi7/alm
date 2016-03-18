<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>ALM</title>

    <!-- Bootstrap core CSS -->

    <link href="<?php echo base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet">

    <link href="<?php echo base_url('assets/fonts/css/font-awesome.min.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/animate.min.css');?>" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="<?php echo base_url('assets/css/custom.css');?>" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/maps/jquery-jvectormap-2.0.1.css');?>" />
    <link href="<?php echo base_url('assets/css/icheck/flat/green.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/floatexamples.css');?>" rel="stylesheet" />

    <script src="<?php echo base_url('assets/js/jquery.js');?>"></script>
<script>

$(document).ready(function(){
$("#user_login").click(function()
{
$("#losspassform").hide();
$("#loginform").show();
});
$("#lost_pass").click(function()
{
$("#loginform").hide();
$("#losspassform").show();
});
})
</script>
    </head>


