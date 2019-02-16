
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Welcome to Admin Panel
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
          <?php if(isset($edit) && $edit == 1){?>
          <h3 class="box-title">Edit School</h3>
        <?php } else { ?>
          <h3 class="box-title">Assign School Admin and Teacher</h3>
        <?php } ?>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
            <form role="form" method="post" action="<?php echo base_url('SuperAdminCon/createSchoolMap');?>">
              <div class="box-body">
                <div class="form-group">
                  <label>School Name</label>
                  <select class="form-control select2" style="width: 100%;" name="cmbSchool" id="cmbSchool">
                    <option selected="selected">Select</option>
                    <?php if(isset($school_details) && count($school_details)>0){
                        foreach ($school_details as $ikey => $ivalue){?>
                          <option value="<?php echo $ivalue['school_id'];?>"><?php echo $ivalue['school_name'];?></option>
                    <?php }} ?>
                  </select>
                </div>
                <div class="form-group">
                  <label>School Admin Name</label>
                  <select class="form-control select2" style="width: 100%;" name="cmbSchoolAdmin" id="cmdSchoolAdmin">
                    <option selected="selected">Select</option>
                    <?php if(isset($school_admin_details) && count($school_admin_details)>0){
                        foreach ($school_admin_details as $ikey => $ivalue){?>
                          <option value="<?php echo $ivalue['schoolAdmin_id'];?>"><?php echo $ivalue['schoolAdmin_name'];?></option>
                    <?php }} ?>
                  </select>
                </div>
                <div class="form-group">
                  <label>Teacher's Name</label>
                  <select class="form-control select2" style="width: 100%;" name="cmbTeacher" id="cmdTeacher">
                    <option value="none">Select</option>
                    <?php if(isset($teacher_details) && count($teacher_details)>0){
                        foreach ($teacher_details as $ikey => $ivalue){?>
                          <option value="<?php echo $ivalue['teacher_id'];?>"><?php echo $ivalue['teacher_name'];?></option>
                    <?php }} ?>
                  </select>
                 
                </div>
            </div>
            <div class="box-footer">
              <button type="submit" class="btn btn-primary" name="btnCreate">Save</button>
            </div>
          </form>
        </div>
        <!-- /.box-body -->