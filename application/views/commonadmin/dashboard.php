
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Welcome to School Admin Panel
      </h1>
      <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">Blank page</li>
      </ol> -->
    </section>

    <!-- Main content -->
    <section class="content">
    	<?php if($this->session->flashdata('updatePassSuccess')){?>
    	<div class="callout callout-success" id="divSuccess">
        	<h4>Status</h4>
        	<?php echo $this->session->flashdata('updatePassSuccess'); unset($_SESSION['updatePassSuccess']);?>
      	</div>
      	<?php }if($this->session->flashdata('updatePassFailed')){ ?>
      	<div class="callout callout-danger" id="divFailed">
        	<h4>Status</h4>
        	<?php echo $this->session->flashdata('updatePassFailed'); ?>
      	</div>	
      	<?php }if($this->session->flashdata('incorrectOld')){ ?>
      	<div class="callout callout-danger" id="divFailedAuth">
        	<h4>Status</h4>
        	<?php echo $this->session->flashdata('incorrectOld');unset($_SESSION['incorrectOld']); ?>
      	</div>
      	<?php } ?>
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Manage</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-institution"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Students</span>
                  <span class="info-box-number"><?php if(isset($no_of_student)) echo $no_of_student;?></span>
                </div>
                <a href="<?php echo base_url('StudentRegCon/index');?>" class="small-box-footer">Explore <i class="fa fa-arrow-circle-right"></i></a>
              </div>
              
            </div>

            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-user-secret"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Tasks</span>
                  <span class="info-box-number"><?php if(isset($no_of_tasks)) echo $no_of_tasks;?></span>
                  <a href="<?php echo base_url('TaskCon/index');?>" class="small-box-footer">Explore <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div>
            </div>

            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-users"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Notices</span>
                  <span class="info-box-number"><?php if(isset($no_of_notice)) echo $no_of_notice;?></span>
                  <a href="<?php echo base_url('NoticeCon/index');?>" class="small-box-footer">Explore <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div>
            </div>

             <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-file-text-o"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Leave Applications</span>
                  <span class="info-box-number"><?php if(isset($No_of_application)) echo $No_of_application;?></span>
                  <a href="<?php echo base_url('AffiliationCon/index');?>" class="small-box-footer">Explore <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  