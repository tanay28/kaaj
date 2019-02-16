
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
          <h3 class="box-title">Edit Teachers</h3>
        <?php } else { ?>
          <h3 class="box-title">Create Teacher</h3>
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
           <form role="form" method="post" action="<?php echo base_url('TeachersCon/editTeacher');?>">
          <?php }else{?>
            <form role="form" method="post" action="<?php echo base_url('TeachersCon/createTeacher');?>">
          <?php }?>
              <div class="box-body">
                <div class="form-group">
                  <label for="schoolName">Teacher Name</label>
                  <?php if(isset($teacher_details['teacher_name'])){?>
                  <input type="text" class="form-control" id="schoolAdminName" value="<?php echo $teacher_details['teacher_name'];?>" name="txtTeacherName">
                  <?php }else {?>
                  <input type="text" class="form-control" id="schoolName" placeholder="Enter Teacher Name" name="txtTeacherName">
                  <?php }if(isset($teacher_details['teacher_id'])){?>
                    <input type="hidden" name="txtTeacherId" value="<?php echo $teacher_details['teacher_id'];?>">
                  <?php }?>
                </div>

                <div class="form-group">
                  <label>Address</label>
                  <?php if(isset($teacher_details['address'])){?>
                  <textarea class="form-control" rows="3" placeholder="Enter Full Address" name="txtAddress"><?php echo $teacher_details['address'];?></textarea>
                  <?php }else{?>
                  <textarea class="form-control" rows="3" placeholder="Enter Full Address" name="txtAddress"></textarea> 
                  <?php }?> 
                </div>

                 <div class="form-group">
                  <label for="contactNo">Contact No.</label>
                  <?php if(isset($teacher_details['contact_no'])){?>
                  <input type="text" class="form-control" id="contactNo" value="<?php echo $teacher_details['contact_no'];?>" name="txtContactNo" maxlength="10">
                  <?php }else{?>
                  <input type="text" class="form-control" id="contactNo" placeholder="Enter Contact Number" name="txtContactNo" maxlength="10">
                  <?php }?>
                </div>
                 <div class="form-group">
                  <label for="contactNo">Email Id.</label>
                  <?php if(isset($teacher_details['email_id'])){?>
                  <input type="text" class="form-control" id="contactNo" value="<?php echo $teacher_details['email_id'];?>" name="txtEmailId" readonly>
                  <?php }else{?>
                  <input type="text" class="form-control" id="contactNo" placeholder="Enter Email Id" name="txtEmailId">
                  <?php }?>
                </div>
                <div class="form-group">
                  <?php if(isset($teacher_details['sex']) && $teacher_details['sex'] == 'MALE'){?>
                  <label>
                    <input type="radio" name="RdoSex" class="minimal-red" checked value="MALE">  MALE
                  </label>
                  <label>
                    <input type="radio" name="RdoSex" class="minimal-red" value="FEMALE">  FEMALE
                  </label>
                  <?php }elseif(isset($teacher_details['sex']) && $teacher_details['sex'] == 'FEMALE'){?>
                  <label>
                    <input type="radio" name="RdoSex" class="minimal-red" value="MALE">  MALE
                  </label>
                  <label>
                    <input type="radio" name="RdoSex" class="minimal-red" checked value="FEMALE">  FEMALE
                  </label>
                  <?php }else{?>
                  <label>
                    <input type="radio" name="RdoSex" class="minimal-red" checked value="MALE">  MALE
                  </label>
                  <label>
                    <input type="radio" name="RdoSex" class="minimal-red" value="FEMALE">  FEMALE
                  </label>
                  <?php }?>
                </div>
                 <div class="form-group">
                  <label for="contactNo">Age</label>
                  <?php if(isset($teacher_details['age'])){?>
                  <input type="text" class="form-control" id="contactNo" value="<?php echo $teacher_details['age'];?>" name="txtAge" maxlength="2">
                  <?php }else{?>
                  <input type="text" class="form-control" id="contactNo" placeholder="Enter Age" name="txtAge">
                  <?php }?>
                </div>
                <div class="form-group">
                  <label for="contactNo">Educational Qualification</label>
                  <?php if(isset($teacher_details['education'])){?>
                  <input type="text" class="form-control" id="contactNo" value="<?php echo $teacher_details['education'];?>" name="txtEducation">
                  <?php }else{?>
                  <input type="text" class="form-control" id="contactNo" placeholder="Enter Educational Qualification" name="txtEducation">
                  <?php }?>
                </div>
                <div class="form-group">
                  <label for="contactNo">Subject(s) Tought (Use Comma Separator for Multiple Subjects)</label>
                  <?php if(isset($teacher_details['subject'])){?>
                  <input type="text" class="form-control" id="contactNo" value="<?php echo $teacher_details['subject'];?>" name="txtSubject">
                  <?php }else{?>
                  <input type="text" class="form-control" id="contactNo" placeholder="Enter Subject tought" name="txtSubject">
                  <?php }?>
                </div>
                <div class="form-group">
                  <label for="contactNo">Teaching Experience (Optional)</label>
                  <?php if(isset($teacher_details['experience'])){?>
                  <input type="text" class="form-control" id="contactNo" value="<?php echo $teacher_details['experience'];?>" name="txtExperience">
                  <?php }else{?>
                  <input type="text" class="form-control" id="contactNo" placeholder="Enter Total Teaching Experience" name="txtExperience">
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
        

  