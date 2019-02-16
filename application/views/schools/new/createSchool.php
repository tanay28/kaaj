
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
          <h3 class="box-title">Register New School</h3>
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
           <form role="form" method="post" action="<?php echo base_url('SchoolCon/editSchool');?>">
          <?php }else{?>
            <form role="form" method="post" action="<?php echo base_url('SchoolCon/createSchool');?>">
          <?php }?>
              <div class="box-body">
                <div class="form-group">
                  <label for="schoolName">School Name</label>
                  <?php if(isset($school_details['school_name'])){?>
                  <input type="text" class="form-control" id="schoolName" value="<?php echo $school_details['school_name'];?>" name="txtSchoolName" readonly>
                  <?php }else {?>
                  <input type="text" class="form-control" id="schoolName" placeholder="Enter School Name" name="txtSchoolName">
                  <?php }if(isset($school_details['school_id'])){?>
                    <input type="hidden" name="txtSchoolId" value="<?php echo $school_details['school_id'];?>">
                  <?php }?>
                </div>

                <div class="form-group">
                  <label>Address</label>
                  <?php if(isset($school_details['school_address'])){?>
                  <textarea class="form-control" rows="3" placeholder="Enter Full Address" name="txtAddress"><?php echo $school_details['school_address'];?></textarea>
                  <?php }else{?>
                  <textarea class="form-control" rows="3" placeholder="Enter Full Address" name="txtAddress"></textarea> 
                  <?php }?> 
                </div>

                 <div class="form-group">
                  <label for="contactNo">Contact No.</label>
                  <?php if(isset($school_details['contact_no'])){?>
                  <input type="text" class="form-control" id="contactNo" value="<?php echo $school_details['contact_no'];?>" name="txtContactNo" maxlength="10">
                  <?php }else{?>
                  <input type="text" class="form-control" id="contactNo" placeholder="Enter Contact Number" name="txtContactNo" maxlength="10">
                  <?php }?>
                </div>

                <div class="form-group">
                  <label>Registered On</label>
                  <?php if(isset($school_details['registered_on'])){?>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right" id="datepicker" name="txtRegisteredOn" value="<?php echo $school_details['registered_on'];?>">
                  </div>
                  <?php }else{?>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right" id="datepicker" name="txtRegisteredOn">
                  </div>
                  <?php }?>
                </div> 

                <div class="form-group">
                  <label>Affliation</label>
                  <select class="form-control select2" style="width: 100%;" name="cmbAffiliation">
                    <option selected="selected">Select</option>
                    <?php if(isset($affiliations) && count($affiliations)>0)
                    {
                        foreach ($affiliations as $ikey => $ivalue)
                        {
                            if(isset($school_details['affiliated_to']) && $ivalue == $school_details['affiliated_to']){
                    ?>

                              <option value="<?php echo $ivalue;?>" selected><?php echo $ivalue;?></option>
                            <?php }else{?>
                              <option value="<?php echo $ivalue;?>"><?php echo $ivalue;?></option>
                            <?php }?>
                    <?php }} ?>
                  </select>
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
        

  