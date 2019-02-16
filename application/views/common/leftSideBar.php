 <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url('assets/dist/img/userss.jpg');?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php if(isset($name)) echo $name;?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN MENU</li>
        <?php if($this->session->has_userdata('usertype') && $this->session->userdata('usertype') == 'superadmin'){?>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url('SuperAdminCon/dashboard');?>"><i class="fa fa-circle-o"></i> Admin Dashboard</a></li>
          </ul>
        </li>
        <li class="treeview">
        <a href="#">
          <i class="fa fa-dashboard"></i> <span>Manage Schools</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url('SchoolCon/Create_new_school');?>"><i class="fa fa-circle-o"></i> Add New School</a></li>
            <li><a href="<?php echo base_url('SchoolCon/index');?>"><i class="fa fa-circle-o"></i> Show Schools List</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Manage School Admins</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url('SchoolAdminCon/Create_new_schoolAdmin');?>"><i class="fa fa-circle-o"></i> Add New School Admin</a></li>
            <li><a href="<?php echo base_url('SchoolAdminCon/index');?>"><i class="fa fa-circle-o"></i> Show School Admin List</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Manage Teachers</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url('TeachersCon/Create_new_teacher');?>"><i class="fa fa-circle-o"></i> Add New Teacher</a></li>
            <li><a href="<?php echo base_url('TeachersCon/index');?>"><i class="fa fa-circle-o"></i> Show Teacher List</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Manage Affiliations</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url('AffiliationCon/Create_new_affiliation');?>"><i class="fa fa-circle-o"></i> Add New Affiliation</a></li>
            <li><a href="<?php echo base_url('AffiliationCon/index');?>"><i class="fa fa-circle-o"></i> Show Affiliation List</a></li>
          </ul>
        </li>
        <?php }else{?>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url('CommonDashboardCon/dashboard');?>"><i class="fa fa-circle-o"></i> School Admin Dashboard</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Manage Students</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url('StudentRegCon/Create_new_student');?>"><i class="fa fa-circle-o"></i> Add New Student</a></li>
            <li><a href="<?php echo base_url('StudentRegCon/index');?>"><i class="fa fa-circle-o"></i> Show Student List</a></li>
          </ul>
        </li>
        <?php }?>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->