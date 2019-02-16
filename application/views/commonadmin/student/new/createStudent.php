
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Welcome to Student Panel
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
          <h3 class="box-title">Edit Student</h3>
        <?php } else { ?>
          <h3 class="box-title">Register New Student</h3>
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
           <form role="form" method="post" action="<?php echo base_url('StudentRegCon/editStudent');?>">
          <?php }else{?>
            <form role="form" method="post" action="<?php echo base_url('StudentRegCon/createStudent');?>">
          <?php }?>
              <div class="box-body">
                <div class="form-group">
                  <label for="studentId">Student Reg. No</label>
                  <?php if(isset($reg_no)){?>
                  <input type="text" class="form-control" id="studentId" value="<?php echo $reg_no;?>" name="txtStudentId" readonly>
                  <?php }?>
                </div>
                <div class="form-group">
                  <label for="studentName">Student Name</label>
                  <?php if(isset($student_details['student_name'])){?>
                  <input type="text" class="form-control" id="studentName" value="<?php echo $student_details['student_name'];?>" name="txtStudentName" readonly>
                  <?php }else {?>
                  <input type="text" class="form-control" id="studentName" placeholder="Enter Student Name" name="txtStudentName">
                  <?php }?>
                </div>
                <div class="form-group">
                  <label for="studentAge">Age</label>
                  <?php if(isset($student_details['age'])){?>
                  <input type="text" class="form-control" id="studentAge" value="<?php echo $student_details['age'];?>" name="txtAge" readonly>
                  <?php }else {?>
                  <input type="text" class="form-control" id="studentAge" placeholder="Enter Student Age" name="txtAge">
                  <?php }?>
                </div>
                 <div class="form-group">
                  <label for="studentSex">Sex</label>
                  <?php if(isset($student_details['sex'])){?>
                  <select class="form-control" id="studentSex" name="cmbSex" class="form-control">
                    <?php if($student_details['sex'] == 'MALE')?>   <option value="MALE" selected>MALE</option>
                    <?php if($student_details['sex'] == 'FEMALE')?> <option value="FEMALE" selected>FEMALE</option>
                  </select>
                  <?php }else {?>
                  <select class="form-control" id="studentSex" name="cmbSex">
                    <option value="none">Select</option>
                    <option value="MALE">MALE</option>
                    <option value="FEMALE">FEMALE</option>
                  </select>
                  <?php }?>
                </div>
                <div class="form-group">
                  <label for="fatherName">Father's Name</label>
                  <?php if(isset($student_details['father_name'])){?>
                  <input type="text" class="form-control" id="fatherName" value="<?php echo $student_details['father_name'];?>" name="txtFatherName" readonly>
                  <?php }else {?>
                  <input type="text" class="form-control" id="fatherName" placeholder="Enter Father's Name" name="txtFatherName">
                  <?php }?>
                </div>
                <div class="form-group">
                  <label for="motherName">Mother's Name</label>
                  <?php if(isset($student_details['mother_name'])){?>
                  <input type="text" class="form-control" id="motherName" value="<?php echo $student_details['mother_name'];?>" name="txtMotherName" readonly>
                  <?php }else {?>
                  <input type="text" class="form-control" id="motherName" placeholder="Enter Mother's Name" name="txtMotherName">
                  <?php }?>
                </div>
                <div class="form-group">
                  <label for="fatherOccupation">Father's Occupation</label>
                  <?php if(isset($student_details['father_occupation'])){?>
                  <input type="text" class="form-control" id="fatherOccupation" value="<?php echo $student_details['father_occupation'];?>" name="txtFatherOccupation" readonly>
                  <?php }else {?>
                  <input type="text" class="form-control" id="fatherOccupation" placeholder="Enter Father's Occcupation" name="txtFatherOccupation">
                  <?php }?>
                </div>
                <div class="form-group">
                  <label for="motherOccupation">Mother's Name</label>
                  <?php if(isset($student_details['mother_occupation'])){?>
                  <input type="text" class="form-control" id="motherOccupation" value="<?php echo $student_details['mother_occupation'];?>" name="txtMotherOccupation" readonly>
                  <?php }else {?>
                  <input type="text" class="form-control" id="motherOccupation" placeholder="Enter Mother's Occupation" name="txtMotherOccupation">
                  <?php }?>
                </div>
                <div class="form-group">
                  <label for="GuardianName">Guardian's Name</label>
                  <?php if(isset($student_details['guardian_name'])){?>
                  <input type="text" class="form-control" id="GurdianName" value="<?php echo $student_details['guardian_name'];?>" name="txtGuardianName" readonly>
                  <?php }else {?>
                  <input type="text" class="form-control" id="GuardianName" placeholder="Enter Guardian Name" name="txtGuardianName">
                  <?php }?>
                </div>
                <div class="form-group">
                  <label for="contactNo">Contact No.</label>
                  <?php if(isset($student_details['contact_no'])){?>
                  <input type="text" class="form-control" id="contactNo" value="<?php echo $student_details['contact_no'];?>" name="txtContactNo" maxlength="10">
                  <?php }else{?>
                  <input type="text" class="form-control" id="contactNo" placeholder="Enter Contact Number" name="txtContactNo" maxlength="10">
                  <?php }?>
                </div>
                <div class="form-group">
                  <label>Address</label>
                  <?php if(isset($student_details['student_address'])){?>
                  <textarea class="form-control" rows="3" placeholder="Enter Full Address" name="txtAddress"><?php echo $student_details['student_address'];?></textarea>
                  <?php }else{?>
                  <textarea class="form-control" rows="3" placeholder="Enter Full Address" name="txtAddress"></textarea> 
                  <?php }?> 
                </div>
                <div class="form-group">
                  <label for="cmbClass">Class</label>
                  <?php if(isset($student_details['class'])){?>
                  <select id="cmbClass" name="cmbClass" class="form-control">
                    <?php if($student_details['class'] == 'I')?>    <option value="I" selected>I</option>
                    <?php if($student_details['class'] == 'II')?>   <option value="II" selected>II</option>
                    <?php if($student_details['class'] == 'III')?>  <option value="III" selected>III</option>
                    <?php if($student_details['class'] == 'IV')?>   <option value="IV" selected>IV</option>
                    <?php if($student_details['class'] == 'V')?>    <option value="V" selected>V</option>
                    <?php if($student_details['class'] == 'VI')?>   <option value="VI" selected>VI</option>
                    <?php if($student_details['class'] == 'VII')?>  <option value="VII" selected>VII</option>
                    <?php if($student_details['class'] == 'VIII')?> <option value="VIII" selected>VIII</option>
                    <?php if($student_details['class'] == 'IX')?>   <option value="IX" selected>IX</option>
                    <?php if($student_details['class'] == 'X')?>    <option value="X" selected>X</option> 
                    <?php if($student_details['class'] == 'XI')?>   <option value="XI" selected>XI</option>
                    <?php if($student_details['class'] == 'XII')?>  <option value="XII" selected>XII</option>
                  </select>
                  <?php }else{?>
                  <select id="cmbClass" name="cmbClass" class="form-control">
                    <option value="none">Select</option>
                    <option value="I">I</option>
                    <option value="II">II</option>
                    <option value="III">III</option>
                    <option value="IV">IV</option>
                    <option value="V">V</option>
                    <option value="VI">VI</option>
                    <option value="VII">VII</option>
                    <option value="VIII">VIII</option>
                    <option value="IX">IX</option>
                    <option value="X">X</option>
                    <option value="XI">XI</option>
                    <option value="XII">XII</option>
                  </select>
                  <?php }?>
                </div>
                 <div class="form-group">
                  <label for="cmbSection">Section</label>
                  <?php if(isset($student_details['section'])){?>
                  <select id="cmbSection" name="cmbSection" class="form-control">
                    <?php if($student_details['section'] == 'A')?>  <option value="A" selected>A</option>
                    <?php if($student_details['section'] == 'B')?>  <option value="B" selected>B</option>
                    <?php if($student_details['section'] == 'C')?>  <option value="C" selected>C</option>
                    <?php if($student_details['section'] == 'D')?>  <option value="D" selected>D</option>
                  </select>
                  <?php }else{?>
                  <select id="cmbSection" name="cmbSection" class="form-control">
                    <option value="none">Select</option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                    <option value="D">D</option>
                  </select>
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
        

  