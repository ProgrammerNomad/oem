<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <!-- <link rel="icon" href="https://crm-admin-dashboard-template.multipurposethemes.com/images/favicon.ico"> -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <title>Sub Category - Dashboard</title>

  <!-- Vendors Style-->
  <link rel="stylesheet" href="/src/css/vendors_css.css">

  <!-- Style-->
  <link rel="stylesheet" href="/src/css/style.css">
  <link rel="stylesheet" href="/src/css/skin_color.css">
  <style>
    .as_bb {
      text-align: center;
      margin-bottom: 10px;
    }

    .as_bb .waves-effect {
      width: 100%;
      font-size: 17px !important;
      padding: 10px;
      border-radius: 5px;
    }
  </style>

</head>

<body class="hold-transition light-skin sidebar-mini theme-primary fixed">

  <div class="wrapper">
    <div id="loader"></div>

    <header class="main-header">
      <div class="d-flex align-items-center logo-box justify-content-start d-md-none d-block">
        <!-- Logo -->
        <a href="/" class="logo">
          <!-- logo-->
          <div class="logo-mini w-30">
            <span class="light-logo"><img src="/images/logo-letter.png" alt="logo"></span>
            <span class="dark-logo"><img src="/images/logo-letter-white.png" alt="logo"></span>
          </div>
          <div class="logo-lg">
            <span class="light-logo"><img src="/images/logo-dark-text.png" alt="logo"></span>
            <span class="dark-logo"><img src="/images/logo-light-text.png" alt="logo"></span>
          </div>
        </a>
      </div>
      <!-- Header Navbar -->
      <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <div class="app-menu">
          <ul class="header-megamenu nav">
            <li class="btn-group nav-item">
              <a href="#" class="waves-effect waves-light nav-link push-btn btn-primary-light" data-toggle="push-menu"
                role="button">
                <i class="icon-Menu"><span class="path1"></span><span class="path2"></span></i>
              </a>
            </li>
            <li class="btn-group d-lg-inline-flex d-none">
              <div class="app-menu">
                <div class="search-bx mx-5">
                  <form>
                    <div class="input-group">
                      <input type="search" class="form-control" placeholder="Search">
                      <div class="input-group-append">
                        <button class="btn" type="submit" id="button-addon3"><i class="icon-Search"><span
                              class="path1"></span><span class="path2"></span></i></button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </li>
          </ul>
        </div>
      </nav>
    </header>

    <aside class="main-sidebar">
      <section class="sidebar position-relative">
        <div class="d-flex align-items-center logo-box justify-content-start d-md-block d-none">
          <!-- Logo -->
          <a href="/" class="logo">
            <!-- logo-->
            <div class="logo-mini">
              <span class="light-logo"><img src="/images/logo-letter.png" alt="logo"></span>
            </div>

          </a>
        </div>
        <div class="user-profile my-15 px-20 py-10 b-1 rounded10 mx-15">
          <div class="d-flex align-items-center justify-content-between">
            <div class="image d-flex align-items-center">
              <img src="/images/avatar/avatar-13.png" class="rounded-0 me-10" alt="User Image">
              <div>
                  <?php

                  $LoggedUserInfo = $this->session->userdata();
                  ?>
                  <h4 class="mb-0 fw-600"><?php echo $LoggedUserInfo['firstname'] . ' ' . $LoggedUserInfo['lastname'] ?>
                  </h4>
                  <p class="mb-0"><?php echo $LoggedUserInfo['username'] ?></p>
                </div>
            </div>

          </div>
        </div>
        <div class="multinav">
          <div class="multinav-scroll" style="height: 97%;">
            <!-- sidebar menu-->
            <ul class="sidebar-menu" data-widget="tree">
              <li class="header">
                Menu</li>
              <li>
                <a href="/dashboard">
                  <i class="fa fa-server"></i>
                  <span>Dashboard</span>
                </a>
              </li>
              <li>
                <a href="/oem">
                  <i class="fa fa-server"></i>
                  <span>OEM Module</span>
                </a>
              </li>
              <li>
                <a href="/Auth/login_front">
                  <i class="fa fa-sign-out"></i>
                  <span>Logout</span>
                </a>
              </li>
            </ul>


          </div>
        </div>
      </section>
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <div class="container-full">
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xxxl-12 col-xl-12 col-12">



              <div class="box">
                <div class="box-body py-10">
                  <div class="row">
                    <div class="col-md-12">
                      <h3 style="text-align: center;
    margin-bottom: 40px;
    font-weight: 600;">Welcome to the Information Module for: <ul class="cat-breadcrumb"><?php echo ($BreadCrumb); ?></ul></h3>

                    </div>
                  </div>

                  <div class="row" style="    margin-top: 20px;
                    margin-bottom: 30px;">
                    <div class="col-md-4">

                      <div class="col-md-12 as_bb">
                        <a href="/subcategory/<?php echo $ParentID['parent_category']; ?>"
                          class="waves-effect waves-light nav-link bg-primary btn-primary  fs-14" title="Back">
                          << Back </a>
                      </div>

                      <?php
                      if (count(($ParentCategory))) {


                        foreach ($ParentCategory as $Category) {

                          ?>
                          <div class="col-md-12 as_bb">
                            <a href="/subcategorytwo/<?php echo $Category->id; ?>"
                              class="waves-effect waves-light nav-link bg-primary btn-primary  fs-14"
                              title="<?php echo $Category->name; ?>">
                              <?php echo $Category->name; ?>
                            </a>
                          </div>

                        <?php }
                      } else { ?>

                        <div class="col-md-12 as_bb">
                          <a class="waves-effect waves-light nav-link bg-danger btn-danger  fs-14" title="">
                            No Sub Module <?php //echo ($BreadCrumb); ?>
                          </a>
                        </div>
                      <?php } ?>


                    </div>
                    <div class="col-md-8">

                      <?php
                     // echo '<pre>';
                     // print_r($DocFiles);
                      ?>
                      <div class="row">
                        <?php if (count($DocFiles)) {

                          foreach ($DocFiles as $DocFile) {

                            $pictures = unserialize($DocFile->picture);
                            $pdfs = unserialize($DocFile->pdf);
                            $drawings = unserialize($DocFile->drawing);
                            $doc_files = unserialize($DocFile->doc_file);
                            $power_points = unserialize($DocFile->power_point);
                            ?>

                            <div class="col-md-12 single-doc">
                              <h3 class="doc-file-title"><?php echo $DocFile->title; ?></h3>

                              <?php if (count($pictures)) { ?>

                                <h3 class="file-type-title">Images</h3>

                                <?php foreach ($pictures as $picture) { ?>
                                  <p class="doc-file-list"><a
                                      href="/uploads/salesdocs/<?php echo $picture['picture']; ?>"><?php echo $picture['picture']; ?></a>
                                  </p>

                                <?php } ?>

                              <?php } ?>

                              <?php if (count($pdfs)) { ?>

                                <h3 class="file-type-title">Pdfs</h3>

                                <?php foreach ($pdfs as $pdf) { ?>
                                  <p class="doc-file-list"><a
                                      href="/uploads/salesdocs/<?php echo $pdf['pdf']; ?>"><?php echo $pdf['pdf']; ?></a>
                                  </p>

                                <?php } ?>

                              <?php } ?>

                              <?php if (count($drawings)) { ?>

                                <h3 class="file-type-title">Drawings</h3>

                                <?php foreach ($drawings as $drawing) { ?>
                                  <p class="doc-file-list"><a
                                      href="/uploads/salesdocs/<?php echo $drawing['drawing']; ?>"><?php echo $drawing['drawing']; ?></a>
                                  </p>

                                <?php } ?>

                              <?php } ?>

                              <?php if (count($doc_files)) { ?>

                                <h3 class="file-type-title">Documents Files</h3>

                                <?php foreach ($doc_files as $doc_file) { ?>
                                  <p class="doc-file-list"><a
                                      href="/uploads/salesdocs/<?php echo $doc_file['doc_file']; ?>"><?php echo $doc_file['doc_file']; ?></a>
                                  </p>

                                <?php } ?>

                              <?php } ?>

                              <?php if (count($power_points)) { ?>

                                <h3 class="file-type-title">Powerpoint Files</h3>

                                <?php foreach ($power_points as $power_point) { ?>
                                  <p class="doc-file-list"><a
                                      href="/uploads/salesdocs/<?php echo $power_point['power_point']; ?>"><?php echo $power_point['power_point']; ?></a>
                                  </p>

                                <?php } ?>

                              <?php } ?>

                            </div>

                          <?php }
                        } else { ?>

                          <div class="col-md-12">
                            <p>There is no files.</p>
                          </div>

                        <?php } ?>
                      </div>

                    </div>

                  </div>
                </div>
              </div>
            </div>



          </div>
        </section>
        <!-- /.content -->
      </div>
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">

      &copy;
      <script>document.write(new Date().getFullYear())</script> <a href="#">CRM</a>. All Rights Reserved.
    </footer>
    <!-- Side panel -->
    <!-- quick_panel_toggle -->

    <!-- /quick_panel_toggle -->

  </div>
  <!-- ./wrapper -->



  <!-- Vendor JS -->
  <script src="/src/js/vendors.min.js"></script>
  <script src="/src/js/pages/chat-popup.js"></script>
  <script src="/assets/icons/feather-icons/feather.min.js"></script>

  <script src="/assets/vendor_components/apexcharts-bundle/dist/apexcharts.js"></script>
  <script src="/cdn.amcharts.com/lib/4/core.js"></script>
  <script src="/cdn.amcharts.com/lib/4/charts.js"></script>
  <script src="/cdn.amcharts.com/lib/4/themes/animated.js"></script>

  <!-- CRMi App -->
  <script src="/src/js/template.js"></script>
  <script src="/src/js/pages/dashboard.js"></script>


</body>

</html>