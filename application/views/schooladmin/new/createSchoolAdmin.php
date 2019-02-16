
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
          <h3 class="box-title">Edit School Admin</h3>
        <?php } else { ?>
          <h3 class="box-title">Register New School Admin</h3>
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
          <?php if(isset($edit) && $edit == 1){?>
           <form role="form" method="post" action="<?php echo base_url('SchoolAdminCon/editSchoolAdmin');?>">
          <?php }else{?>
            <form role="form" method="post" action="<?php echo base_url('SchoolAdminCon/createSchoolAdmin');?>">
          <?php }?>
              <div class="box-body">
                <div class="form-group">
                  <label for="schoolName">School Admin Name</label>
                  <?php if(isset($schoolAdmin_details['schoolAdmin_name'])){?>
                  <input type="text" class="form-control" id="schoolAdminName" value="<?php echo $schoolAdmin_details['schoolAdmin_name'];?>" name="txtSchoolAdminName">
                  <?php }else {?>
                  <input type="text" class="form-control" id="schoolName" placeholder="Enter School AdminName" name="txtSchoolAdminName">
                  <?php }if(isset($schoolAdmin_details['schoolAdmin_id'])){?>
                    <input type="hidden" name="txtSchoolAdminId" value="<?php echo $schoolAdmin_details['schoolAdmin_id'];?>">
                  <?php }?>
                </div>

                <div class="form-group">
                  <label>Address</label>
                  <?php if(isset($schoolAdmin_details['schoolAdmin_address'])){?>
                  <textarea class="form-control" rows="3" placeholder="Enter Full Address" name="txtAddress"><?php echo $schoolAdmin_details['schoolAdmin_address'];?></textarea>
                  <?php }else{?>
                  <textarea class="form-control" rows="3" placeholder="Enter Full Address" name="txtAddress"></textarea> 
                  <?php }?> 
                </div>

                 <div class="form-group">
                  <label for="contactNo">Contact No.</label>
                  <?php if(isset($schoolAdmin_details['contact_no'])){?>
                  <input type="text" class="form-control" id="contactNo" value="<?php echo $schoolAdmin_details['contact_no'];?>" name="txtContactNo" maxlength="10">
                  <?php }else{?>
                  <input type="text" class="form-control" id="contactNo" placeholder="Enter Contact Number" name="txtContactNo" maxlength="10">
                  <?php }?>
                </div>
                 <div class="form-group">
                  <label for="contactNo">Email Id.</label>
                  <?php if(isset($schoolAdmin_details['email_id'])){?>
                  <input type="text" class="form-control" id="contactNo" value="<?php echo $schoolAdmin_details['email_id'];?>" name="txtEmailId" readonly>
                  <?php }else{?>
                  <input type="text" class="form-control" id="contactNo" placeholder="Enter Contact Number" name="txtEmailId">
                  <?php }?>
                </div>
            </div>
            <div class="box-footer">
            <?php if(isset($edit) && $edit == 1){?>
              <button type="submit" class="btn btn-primary" name="btnCreate">Edit</button>
            <?php } else {?>
              <button type="submit" class="btn btn-primary" name="btnCreate">Save</button>
            <?php }?>
            </div>
          </form>
        </div>
        <!-- /.box-body -->
        

  