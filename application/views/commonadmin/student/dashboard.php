
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
    	<?php if($this->session->flashdata('school_created')){?>
    	<div class="callout callout-success" id="divSuccess">
      	<h4>Status</h4>
      	<?php echo $this->session->flashdata('school_created'); unset($_SESSION['school_created']);?>
    	</div>

    	<?php }if($this->session->flashdata('validationErr')){ ?>
    	<div class="callout callout-danger" id="divFailed">
      	<h4>Status</h4>
      	<?php echo $this->session->flashdata('validationErr'); ?>
    	</div>

    	<?php }if($this->session->flashdata('school_exists')){?>
      <div class="callout callout-danger" id="divFailed">
        <h4>Status</h4>
        <?php echo $this->session->flashdata('school_exists'); ?>
      </div>

      <?php }if($this->session->flashdata('edit_success')){?>
      <div class="callout callout-success" id="divSuccess">
        <h4>Status</h4>
        <?php echo $this->session->flashdata('edit_success'); ?>
      </div>

      <?php }if($this->session->flashdata('edit_failed')){?>
      <div class="callout callout-success" id="divFailed">
        <h4>Status</h4>
        <?php echo $this->session->flashdata('edit_failed'); ?>
      </div>
      <?php }if($this->session->flashdata('del_success')){ ?>
      <div class="callout callout-success" id="divSuccess">
        <h4>Status</h4>
        <?php echo $this->session->flashdata('del_success'); ?>
      </div>
      <?php }if($this->session->flashdata('del_failed')){ ?>
      <div class="callout callout-danger" id="divFailed">
        <h4>Status</h4>
        <?php echo $this->session->flashdata('del_failed'); ?>
      </div>
      <?php }?>
      
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">List of Students</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
           <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Sl No</th>
                  <th>Reg. No</th>
                  <th>Student Name</th>
                  <th>Age</th>
                  <th>Sex</th>
                  <th>Father Name</th>
                  <th>Mother Name</th>
                  <th>Father Occupation</th>
                  <th>Mother Occupation</th>
                  <th>Guardian Name</th>
                  <th>Contact No</th>
                  <th>Address</th>
                  <th>Class</th>
                  <th>Section</th>
                  <th>Registered On</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  if(isset($student_details) && count($student_details)>0)
                  {
                    $i = 1;
                    foreach ($student_details as $ikey => $ivalue)
                    {
                ?>
                <tr>
                  <td><?php echo $i?></td>
                  <td><?php echo $ivalue['student_id']?></td>
                  <td><?php echo $ivalue['student_name']?></td>
                  <td><?php echo $ivalue['age']?></td>
                  <td><?php echo $ivalue['sex']?></td>
                  <td><?php echo $ivalue['father_name']?></td>
                  <td><?php echo $ivalue['mother_name']?></td>
                  <td><?php echo $ivalue['father_occupation']?></td>
                  <td><?php echo $ivalue['mother_occupation']?></td>
                  <td><?php echo $ivalue['guardian_name']?></td>
                  <td><?php echo $ivalue['contact_no']?></td>
                  <td><?php echo $ivalue['student_address']?></td>
                  <td><?php echo $ivalue['class']?></td>
                  <td><?php echo $ivalue['section']?></td>
                  <td><?php echo $ivalue['registered_on']?></td>
                  <td><a href="<?php echo base_url('StudentRegCon/edit_student/'.$ivalue['student_id']);?>"><i class="fa fa-edit"></i></a>  <a href="<?php echo base_url('StudentRegCon/del_student/'.$ivalue['student_id']);?>" onClick="DelConfirm()"><i class="fa fa-remove pull-right"></i></a></td>
                </tr>
                <?php
                    $i+=1;
                  }
                }else{
                ?>
                <tr>
                  <td colspan="15" align="center"><p>No Students found..!!</p></td>
                </tr>
              <?php } ?>
                </tbody>
                <tfoot>
                <tr>
                 <th>Sl No</th>
                  <th>Reg. No</th>
                  <th>Student Name</th>
                  <th>Age</th>
                  <th>Sex</th>
                  <th>Father Name</th>
                  <th>Mother Name</th>
                  <th>Father Occupation</th>
                  <th>Mother Occupation</th>
                  <th>Guardian Name</th>
                  <th>Contact No</th>
                  <th>Address</th>
                  <th>Class</th>
                  <th>Section</th>
                  <th>Registered On</th>
                  <th>Action</th>
                </tr>
                </tfoot>
              </table>
        </div>
        <!-- /.box-body -->
        

  