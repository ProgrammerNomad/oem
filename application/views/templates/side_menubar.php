<aside class="main-sidebar">
  <section class="sidebar">

    <ul class="sidebar-menu" data-widget="tree">

      <li id="dashboardMainMenu">
        <a href="<?php echo base_url('admin/dashboard') ?>">
          <i class="fa fa-dashboard"></i> <span>Dashboard</span>
        </a>
      </li>

      <?php if (in_array('createBrand', $user_permission) || in_array('updateBrand', $user_permission) || in_array('viewBrand', $user_permission) || in_array('deleteBrand', $user_permission)): ?>
        <!-- <li id="brandNav">
              <a href="<?php echo base_url('admin/Controller_Items/') ?>">
                <i class="fa fa-cubes"></i> <span>Items</span>
              </a>
            </li> -->
      <?php endif; ?>

      <?php if (in_array('viewCategory', $user_permission)): ?>
        <li id="categoryNav">
          <a href="<?php echo base_url('/admin/Controller_Category/') ?>">
            <i class="fa fa-th"></i> <span>OEM Madule</span>
          </a>
        </li>
      <?php endif; ?>



      <?php if (in_array('createCategory', $user_permission) || in_array('updateCategory', $user_permission) || in_array('deleteCategory', $user_permission)): ?>
        <li id="categoryNav">
          <a href="<?php echo base_url('/admin/Controller_Salesdoc/') ?>">
            <i class="fa fa-th"></i> <span>Upload</span>
          </a>
        </li>
      <?php endif; ?>


      <?php if (in_array('createStore', $user_permission) || in_array('updateStore', $user_permission) || in_array('viewStore', $user_permission) || in_array('deleteStore', $user_permission)): ?>
        <!--  <li id="storeNav">
              <a href="<?php echo base_url('admin/Controller_Warehouse/') ?>">
                <i class="fa fa-institution"></i> <span>Warehouse</span>
              </a>
            </li> -->
      <?php endif; ?>

      <!-- <?php if (in_array('createAttribute', $user_permission) || in_array('updateAttribute', $user_permission) || in_array('viewAttribute', $user_permission) || in_array('deleteAttribute', $user_permission)): ?>
          <li id="attributeNav">
            <a href="<?php echo base_url('admin/Controller_Element/') ?>">
              <i class="fa fa-files-o"></i> <span>Elements</span>
            </a>
          </li>
          <?php endif; ?> -->

      <!-- <?php if (in_array('createProduct', $user_permission) || in_array('updateProduct', $user_permission) || in_array('viewProduct', $user_permission) || in_array('deleteProduct', $user_permission)): ?>
            <li class="treeview" id="mainProductNav">
              <a href="#">
                <i class="fa fa-cube"></i>
                <span>Information Module</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a> -->
        <!-- <ul class="treeview-menu"> -->
        <!-- <?php if (in_array('createProduct', $user_permission)): ?>
                  <li id="addProductNav"><a href="<?php echo base_url('/admin/Controller_Products/create') ?>"><i class="fa fa-circle-o"></i> Add Information Module</a></li>
                <?php endif; ?>
                <?php if (in_array('updateProduct', $user_permission) || in_array('viewProduct', $user_permission) || in_array('deleteProduct', $user_permission)): ?>
                <li id="manageProductNav"><a href="<?php echo base_url('admin/Controller_Products') ?>"><i class="fa fa-circle-o"></i> Manage  Information Module</a></li>
                <?php endif; ?>
              </ul>
            </li>
          <?php endif; ?> -->

      <?php if ($user_permission): ?>
        <?php if (in_array('createUser', $user_permission) || in_array('updateUser', $user_permission) || in_array('viewUser', $user_permission) || in_array('deleteUser', $user_permission)): ?>
          <li class="treeview" id="mainUserNav">
            <a href="#">
              <i class="fa fa-users"></i>
              <span>Members</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <?php if (in_array('createUser', $user_permission)): ?>
                <li id="createUserNav"><a href="<?php echo base_url('admin/Controller_Members/create') ?>"><i
                      class="fa fa-circle-o"></i> Add Members</a></li>
              <?php endif; ?>

              <?php if (in_array('updateUser', $user_permission) || in_array('viewUser', $user_permission) || in_array('deleteUser', $user_permission)): ?>
                <li id="manageUserNav"><a href="<?php echo base_url('admin/Controller_Members') ?>"><i
                      class="fa fa-circle-o"></i> Manage Members</a></li>
              <?php endif; ?>
            </ul>
          </li>
        <?php endif; ?>

        <?php if (in_array('createGroup', $user_permission) || in_array('updateGroup', $user_permission) || in_array('viewGroup', $user_permission) || in_array('deleteGroup', $user_permission)): ?>
          <li class="treeview" id="mainGroupNav">
            <a href="#">
              <i class="fa fa-recycle"></i>
              <span>Permission</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <?php if (in_array('createGroup', $user_permission)): ?>
                <li id="addGroupNav"><a href="<?php echo base_url('admin/Controller_Permission/create') ?>"><i
                      class="fa fa-circle-o"></i> Add Permission</a></li>
              <?php endif; ?>
              <?php if (in_array('updateGroup', $user_permission) || in_array('viewGroup', $user_permission) || in_array('deleteGroup', $user_permission)): ?>
                <li id="manageGroupNav"><a href="<?php echo base_url('admin/Controller_Permission') ?>"><i
                      class="fa fa-circle-o"></i> Manage Permission</a></li>
              <?php endif; ?>
            </ul>
          </li>
        <?php endif; ?>

        <!--  <?php if (in_array('viewReports', $user_permission)): ?>
            <li id="reportNav">
              <a href="<?php echo base_url('reports/') ?>">
                <i class="glyphicon glyphicon-stats"></i> <span>Reports</span>
              </a>
            </li>
          <?php endif; ?> -->
        <?php if (in_array('updateCompany', $user_permission)): ?>
          <li id="companyNav"><a href="<?php echo base_url('/admin/Controller_Company/') ?>"><i class="fa fa-bank"></i>
              <span>Company</span></a></li>
        <?php endif; ?>



      <?php endif; ?>
      <!-- user permission info -->
      <li><a href="<?php echo base_url('auth/logout') ?>"><i class="fa fa-power-off"></i> <span>Logout</span></a></li>

    </ul>
  </section>
  <!-- /.sidebar -->
</aside>