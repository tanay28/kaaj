<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/bootstrap/dist/css/bootstrap.min.css');?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/font-awesome/css/font-awesome.min.css');?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/Ionicons/css/ionicons.min.css');?>">
  <!-- Theme style -->
  <!-- icheck style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/iCheck/all.css');?>">

  <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/AdminLTE.min.css');?>">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/skins/_all-skins.min.css');?>">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Admin</b> Dashboard</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo base_url('assets/dist/img/userss.jpg');?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php if(isset($name)) echo $name;?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo base_url('assets/dist/img/userss.jpg');?>" class="img-circle" alt="User Image">
                <p><?php if(isset($name)) echo $name;?></p>
              </li>
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat" data-toggle="modal" data-target="#modal-default">Change Password</a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo base_url('SuperAdminCon/SignOut');?>" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Change Password</h4>
              </div>
              <form name="frm" method="post" action="<?php echo base_url('SuperAdminCon/changePassword');?>">
                <div class="modal-body">
                  <div class="modal-body mx-3">
                <div class="md-form mb-5">
                  <input type="password" id="defaultForm-email" class="form-control validate" placeholder="Old Password" name="txtOld">
                  <label data-error="wrong" data-success="right" for="defaultForm-email"></label>
                </div>
                <div class="md-form mb-4">
                  <input type="password" id="defaultForm-pass1" class="form-control validate" placeholder="New Password" name="txtNew">
                  <label data-error="wrong" data-success="right" for="defaultForm-pass1"></label>
                </div>
                <div class="md-form mb-4">
                  <input type="password" id="defaultForm-pass2" class="form-control validate" placeholder="Confirm Password" name="txtConfirm">
                  <label data-error="wrong" data-success="right" for="defaultForm-pass2"></label>
                </div>
            </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                  <input type="submit" name="btnChangePass" class="btn btn-primary" value="Save changes">
                </div>
              </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
   </div>