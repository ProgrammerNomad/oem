<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

</head>
<body>
<title>OEM - Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<!-- Vendors Style-->
	<link rel="stylesheet" href="src/css/vendors_css.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
	<!-- Style-->  
	<link rel="stylesheet" href="html/src/css/style.css">
	<link rel="stylesheet" href="html/src/css/skin_color.css">
	<style>
	.as_bb{
	text-align:center;
	    margin-bottom: 10px;}
	
.as_bb .waves-effect {
    width: 100%;
    font-size: 17px!important;
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
		<a href="index.html" class="logo">
		  <!-- logo-->
		  <div class="logo-mini w-30">
			  <span class="light-logo"><img src="images/logo-letter.png" alt="logo"></span>
			  <span class="dark-logo"><img src="images/logo-letter-white.png" alt="logo"></span>
		  </div>
		  <div class="logo-lg">
			  <span class="light-logo"><img src="images/logo-dark-text.png" alt="logo"></span>
			  <span class="dark-logo"><img src="images/logo-light-text.png" alt="logo"></span>
		  </div>
		</a>	
	</div>   
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
	  <div class="app-menu">
		<ul class="header-megamenu nav">
			<li class="btn-group nav-item">
				<a href="#" class="waves-effect waves-light nav-link push-btn btn-primary-light" data-toggle="push-menu" role="button">
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
								<button class="btn" type="submit" id="button-addon3"><i class="icon-Search"><span class="path1"></span><span class="path2"></span></i></button>
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
			<a href="index.html" class="logo">
			  <div class="logo-mini">
				  <span class="light-logo"><img src="images/logo-letter.png" alt="logo"></span>
			  </div>
			  
			</a>	
		</div> 
		<div class="user-profile my-15 px-20 py-10 b-1 rounded10 mx-15">
			<div class="d-flex align-items-center justify-content-between">			
				<div class="image d-flex align-items-center">
				    <img src="images/avatar/avatar-13.png" class="rounded-0 me-10" alt="User Image">
					<div>
						<h4 class="mb-0 fw-600">Nil Yeager</h4>
						<p class="mb-0">Admin</p>
					</div>
				</div>
				</div>
	    </div>
	  	<div class="multinav">
		  <div class="multinav-scroll" style="height: 97%;">	
			  <ul class="sidebar-menu" data-widget="tree">	
				<li class="header">Main Menu</li>
				<li>
				  <a href="dashboard">
					<i class="fa fa-server"></i>
					<span>Dashboard</span>
				  </a>
				</li>
        <!-- <?php echo base_url('Login/authenticate') ?>"><i class="fa fa-power-off"></i> <span>Logout</span></a></li>  -->
                <li> 
          <a href="auth/logout_front">
              <i class="fa fa-sign-out"></i>
              <span>Logout</span>
          </a>
       </li>
      <div class="sidebar-widgets">
			
				<div class="copyright m-15">
					<p><strong class="d-block">OEM Dashboard</strong> © <script>document.write(new Date().getFullYear())</script> All Rights Reserved</p>
				</div>
			  </div>
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
    font-weight: 600;">Welcome to CSS Project Tracker Please Choose Your Module </h3>
						</div>
						</div>
						
						<div class="row" style="    margin-top: 20px;
    margin-bottom: 30px;">
<div class="col-md-4">
						
                        <div class="col-md-12 as_bb">
				<a href="category" class="waves-effect waves-light nav-link bg-primary btn-primary  fs-14" title="Full Screen">
					OEM Information
			    </a>
			</div>		
 <div class="col-md-12 as_bb">
				<a href="category" class="waves-effect waves-light nav-link bg-primary btn-primary  fs-14" title="Full Screen">
					CRM
			    </a>
			</div>		
 <!-- <div class="col-md-12 as_bb">
				<a href="category" class="waves-effect waves-light nav-link bg-primary btn-primary  fs-14" title="Full Screen">
					 Installation Service Warranty
			    </a>
			</div>					 -->
			</div>


<div class="col-md-8">
<p>Copy information to be placed here. Copy information to be placed here. Copy information
to be placed here. Copy information to be placed here. Copy information to be placed here.
Copy information to be placed here. Copy information to be placed here. Copy information
to be placed here. Copy information to be placed here. Copy information to be placed here.
Copy information to be placed here. Copy information to be placed here. Copy information
to be placed here. Copy information to be placed here. Copy information to be placed here.
Copy information to be placed here.</p>
<p>Copy information to be placed here. Copy information to be placed here. Copy information
to be placed here. Copy information to be placed here. Copy information to be placed here.
Copy information to be placed here. Copy information to be placed here.
 </p>				
			</div>			

							
						</div>	
						</div>
					</div>
				</div>
				
				
							
			</div>				
		</section>
	  </div>
  </div>
	
  <footer class="main-footer">

	  &copy; <script>document.write(new Date().getFullYear())</script> <a href="#">OEM CRM</a>. All Rights Reserved.
  </footer>
  <!-- Side panel --> 
  <!-- quick_panel_toggle -->
  <div class="modal modal-right fade" id="quick_panel_toggle" tabindex="-1">
	  <div class="modal-dialog">
		<div class="modal-content slim-scroll2">
		  <div class="modal-body bg-white py-20 px-0">
			<div class="d-flex align-items-center justify-content-between pb-30">
				<ul class="nav nav-tabs customtab3 px-30" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" data-bs-toggle="tab" href="#quick_panel_notifications">Notifications</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-bs-toggle="tab" href="#quick_panel_logs">Logs</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-bs-toggle="tab" href="#quick_panel_settings">Settings</a>
					</li>
				</ul>
                <div class="offcanvas-close">
                    <a href="#" class="btn btn-icon btn-danger-light btn-sm no-shadow" data-bs-dismiss="modal">
						<span class="fa fa-close"></span>
					</a>
                </div>
			</div>
              <div class="px-30">
                <div class="tab-content">
                    <div class="tab-pane active" id="quick_panel_notifications" role="tabpanel">
                        <div>
                            <div class="media-list">
                                <div class="media media-single px-0">
                                  <h4 class="w-50 text-gray fw-500">10:10</h4>
                                  <div class="media-body ps-15 bs-5 rounded border-primary">
                                    <p>Morbi quis ex eu arcu auctor sagittis.</p>
                                    <span class="text-fade">by Johne</span>
                                  </div>
                                </div>

                                <div class="media media-single px-0" href="#">
                                  <h4 class="w-50 text-gray fw-500">08:40</h4>
                                  <div class="media-body ps-15 bs-5 rounded border-success">
                                    <p>Proin iaculis eros non odio ornare efficitur.</p>
                                    <span class="text-fade">by Amla</span>
                                  </div>
                                </div>

                                <div class="media media-single px-0" href="#">
                                  <h4 class="w-50 text-gray fw-500">07:10</h4>
                                  <div class="media-body ps-15 bs-5 rounded border-info">
                                    <p>In mattis mi ut posuere consectetur.</p>
                                    <span class="text-fade">by Josef</span>
                                  </div>
                                </div>

                                <div class="media media-single px-0" href="#">
                                  <h4 class="w-50 text-gray fw-500">01:15</h4>
                                  <div class="media-body ps-15 bs-5 rounded border-danger">
                                    <p>Morbi quis ex eu arcu auctor sagittis.</p>
                                    <span class="text-fade">by Rima</span>
                                  </div>
                                </div>

                                <div class="media media-single px-0" href="#">
                                  <h4 class="w-50 text-gray fw-500">23:12</h4>
                                  <div class="media-body ps-15 bs-5 rounded border-warning">
                                    <p>Morbi quis ex eu arcu auctor sagittis.</p>
                                    <span class="text-fade">by Alaxa</span>
                                  </div>
                                </div>
                                <div class="media media-single px-0" href="#">
                                  <h4 class="w-50 text-gray fw-500">10:10</h4>
                                  <div class="media-body ps-15 bs-5 rounded border-primary">
                                    <p>Morbi quis ex eu arcu auctor sagittis.</p>
                                    <span class="text-fade">by Johne</span>
                                  </div>
                                </div>

                                <div class="media media-single px-0" href="#">
                                  <h4 class="w-50 text-gray fw-500">08:40</h4>
                                  <div class="media-body ps-15 bs-5 rounded border-success">
                                    <p>Proin iaculis eros non odio ornare efficitur.</p>
                                    <span class="text-fade">by Amla</span>
                                  </div>
                                </div>

                                <div class="media media-single px-0" href="#">
                                  <h4 class="w-50 text-gray fw-500">07:10</h4>
                                  <div class="media-body ps-15 bs-5 rounded border-info">
                                    <p>In mattis mi ut posuere consectetur.</p>
                                    <span class="text-fade">by Josef</span>
                                  </div>
                                </div>

                                <div class="media media-single px-0" href="#">
                                  <h4 class="w-50 text-gray fw-500">01:15</h4>
                                  <div class="media-body ps-15 bs-5 rounded border-danger">
                                    <p>Morbi quis ex eu arcu auctor sagittis.</p>
                                    <span class="text-fade">by Rima</span>
                                  </div>
                                </div>

                                <div class="media media-single px-0" href="#">
                                  <h4 class="w-50 text-gray fw-500">23:12</h4>
                                  <div class="media-body ps-15 bs-5 rounded border-warning">
                                    <p>Morbi quis ex eu arcu auctor sagittis.</p>
                                    <span class="text-fade">by Alaxa</span>
                                  </div>
                                </div>
                              </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="quick_panel_logs" role="tabpanel">
						<div class="mb-30">
                            <h5 class="fw-500 mb-15">Tasks Overview</h5>
                            <div class="d-flex align-items-center mb-30">
                                <div class="me-15 bg-primary-light h-50 w-50 l-h-60 rounded text-center">
                                      <span class="icon-Library fs-24"><span class="path1"></span><span class="path2"></span></span>
                                </div>
                                <div class="d-flex flex-column fw-500">
                                    <a href="projects.html" class="text-dark hover-primary mb-1 fs-16">Project Briefing</a>
                                    <span class="text-fade">Project Manager</span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center mb-30">
                                <div class="me-15 bg-danger-light h-50 w-50 l-h-60 rounded text-center">
                                    <span class="icon-Write fs-24"><span class="path1"></span><span class="path2"></span></span>
                                </div>
                                <div class="d-flex flex-column fw-500">
                                    <a href="projects.html" class="text-dark hover-danger mb-1 fs-16">Concept Design</a>
                                    <span class="text-fade">Art Director</span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center mb-30">
                                <div class="me-15 bg-success-light h-50 w-50 l-h-60 rounded text-center">
                                    <span class="icon-Group-chat fs-24"><span class="path1"></span><span class="path2"></span></span>
                                </div>
                                <div class="d-flex flex-column fw-500">
                                    <a href="projects.html" class="text-dark hover-success mb-1 fs-16">Functional Logics</a>
                                    <span class="text-fade">Lead Developer</span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center mb-30">
                                <div class="me-15 bg-info-light h-50 w-50 l-h-60 rounded text-center">
                                    <span class="icon-Attachment1 fs-24"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></span>
                                </div>
                                <div class="d-flex flex-column fw-500">
                                    <a href="projects.html" class="text-dark hover-info mb-1 fs-16">Development</a>
                                    <span class="text-fade">DevOps</span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="me-15 bg-warning-light h-50 w-50 l-h-60 rounded text-center">
                                    <span class="icon-Shield-user fs-24"></span>
                                </div>
                                <div class="d-flex flex-column fw-500">
                                    <a href="projects.html" class="text-dark hover-warning mb-1 fs-16">Testing</a>
                                    <span class="text-fade">QA Managers</span>
                                </div>
                            </div>
                        </div>
                        <div class="mb-30">
                            <h5 class="fw-500 mb-15">Messages</h5>
                            <div class="d-flex align-items-center mb-30">
                                <div class="me-15 bg-lightest h-50 w-50 l-h-50 rounded text-center">
                                      <img src="https://crm-admin-dashboard-template.multipurposethemes.com/images/svg-icon/color-svg/001-glass.svg" class="h-30" alt="">
                                </div>
                                <div class="d-flex flex-column flex-grow-1 me-2 fw-500">
                                    <a href="mailbox-read.html" class="text-dark hover-primary mb-1 fs-16">Duis faucibus lorem</a>
                                    <span class="text-fade">Pharetra, Nulla</span>
                                </div>
                                <span class="badge badge-xl badge-light"><span class="fw-600">+125$</span></span>
                            </div>
                            <div class="d-flex align-items-center mb-30">
                                <div class="me-15 bg-lightest h-50 w-50 l-h-50 rounded text-center">
                                      <img src="https://crm-admin-dashboard-template.multipurposethemes.com/images/svg-icon/color-svg/002-google.svg" class="h-30" alt="">
                                </div>
                                <div class="d-flex flex-column flex-grow-1 me-2 fw-500">
                                    <a href="mailbox-read.html" class="text-dark hover-danger mb-1 fs-16">Mauris varius augue</a>
                                    <span class="text-fade">Pharetra, Nulla</span>
                                </div>
                                <span class="badge badge-xl badge-light"><span class="fw-600">+125$</span></span>
                            </div>
                            <div class="d-flex align-items-center mb-30">
                                <div class="me-15 bg-lightest h-50 w-50 l-h-50 rounded text-center">
                                      <img src="https://crm-admin-dashboard-template.multipurposethemes.com/images/svg-icon/color-svg/003-settings.svg" class="h-30" alt="">
                                </div>
                                <div class="d-flex flex-column flex-grow-1 me-2 fw-500">
                                    <a href="mailbox-read.html" class="text-dark hover-success mb-1 fs-16">Aliquam in magna</a>
                                    <span class="text-fade">Pharetra, Nulla</span>
                                </div>
                                <span class="badge badge-xl badge-light"><span class="fw-600">+125$</span></span>
                            </div>
                            <div class="d-flex align-items-center mb-30">
                                <div class="me-15 bg-lightest h-50 w-50 l-h-50 rounded text-center">
                                      <img src="https://crm-admin-dashboard-template.multipurposethemes.com/images/svg-icon/color-svg/004-dad.svg" class="h-30" alt="">
                                </div>
                                <div class="d-flex flex-column flex-grow-1 me-2 fw-500">
                                    <a href="mailbox-read.html" class="text-dark hover-info mb-1 fs-16">Phasellus venenatis nisi</a>
                                    <span class="text-fade">Pharetra, Nulla</span>
                                </div>
                                <span class="badge badge-xl badge-light"><span class="fw-600">+125$</span></span>
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="me-15 bg-lightest h-50 w-50 l-h-50 rounded text-center">
                                      <img src="https://crm-admin-dashboard-template.multipurposethemes.com/images/svg-icon/color-svg/005-paint-palette.svg" class="h-30" alt="">
                                </div>
                                <div class="d-flex flex-column flex-grow-1 me-2 fw-500">
                                    <a href="mailbox-read.html" class="text-dark hover-warning mb-1 fs-16">Vivamus consectetur</a>
                                    <span class="text-fade">Pharetra, Nulla</span>
                                </div>
                                <span class="badge badge-xl badge-light"><span class="fw-600">+125$</span></span>
                            </div>
                        </div>                        
                    </div>
                    <div class="tab-pane" id="quick_panel_settings" role="tabpanel">
                        <div>
                            <form class="form">
							<!--begin::Section-->
							<div>
								<h5 class="fw-500 mb-15">Support</h5>
								<div class="form-group mb-0 row align-items-center">
									<label class="col-8 col-form-label">Enable Notifications:</label>
									<div class="col-4 d-flex justify-content-end">
                                        <button type="button" class="btn btn-sm btn-toggle btn-primary active" data-bs-toggle="button" >
                                            <span class="handle"></span>
                                        </button>
									</div>
								</div>
								<div class="form-group mb-0 row align-items-center">
									<label class="col-8 col-form-label">Enable Case Tracking:</label>
									<div class="col-4 d-flex justify-content-end">
                                        <button type="button" class="btn btn-sm btn-toggle btn-primary" data-bs-toggle="button" >
                                            <span class="handle"></span>
                                        </button>
									</div>
								</div>
								<div class="form-group mb-0 row align-items-center">
									<label class="col-8 col-form-label">Support Portal:</label>
									<div class="col-4 d-flex justify-content-end">
                                        <button type="button" class="btn btn-sm btn-toggle btn-primary active" data-bs-toggle="button" >
                                            <span class="handle"></span>
                                        </button>
									</div>
								</div>
							</div>
							<!--end::Section-->
							<div class="dropdown-divider"></div>
							<!--begin::Section-->
							<div class="pt-2">
								<h5 class="fw-500 mb-15">Overview </h5>
								<div class="form-group mb-0 row align-items-center">
									<label class="col-8 col-form-label">Generate Overview:</label>
									<div class="col-4 d-flex justify-content-end">
                                        <button type="button" class="btn btn-sm btn-toggle btn-danger active" data-bs-toggle="button" >
                                            <span class="handle"></span>
                                        </button>
									</div>
								</div>
								<div class="form-group mb-0 row align-items-center">
									<label class="col-8 col-form-label">Enable Overview Export:</label>
									<div class="col-4 d-flex justify-content-end">
                                        <button type="button" class="btn btn-sm btn-toggle btn-danger active" data-bs-toggle="button" >
                                            <span class="handle"></span>
                                        </button>
									</div>
								</div>
								<div class="form-group mb-0 row align-items-center">
									<label class="col-8 col-form-label">Allow Data Collection:</label>
									<div class="col-4 d-flex justify-content-end">
                                        <button type="button" class="btn btn-sm btn-toggle btn-danger active" data-bs-toggle="button" >
                                            <span class="handle"></span>
                                        </button>
									</div>
								</div>
							</div>
							<!--end::Section-->
							<div class="dropdown-divider"></div>
							<!--begin::Section-->
							<div class="pt-2">
								<h5 class="fw-500 mb-15">Users</h5>
								<div class="form-group mb-0 row align-items-center">
									<label class="col-8 col-form-label">Enable Users singup:</label>
									<div class="col-4 d-flex justify-content-end">
                                        <button type="button" class="btn btn-sm btn-toggle btn-warning active" data-bs-toggle="button" >
                                            <span class="handle"></span>
                                        </button>
									</div>
								</div>
								<div class="form-group mb-0 row align-items-center">
									<label class="col-8 col-form-label">Allow User Feedbacks:</label>
									<div class="col-4 d-flex justify-content-end">
                                        <button type="button" class="btn btn-sm btn-toggle btn-warning active" data-bs-toggle="button" >
                                            <span class="handle"></span>
                                        </button>
									</div>
								</div>
								<div class="form-group mb-0 row align-items-center">
									<label class="col-8 col-form-label">Enable Users Portal:</label>
									<div class="col-4 d-flex justify-content-end">
                                        <button type="button" class="btn btn-sm btn-toggle btn-warning active" data-bs-toggle="button" >
                                            <span class="handle"></span>
                                        </button>
									</div>
								</div>
							</div>
							<!--end::Section-->
						</form>
                        </div>
                    </div>
                </div>
              </div>
		  </div>
		</div>
	  </div>
  </div>
  <!-- /quick_panel_toggle -->
  
</div>
<!-- ./wrapper -->
														

	<!-- Page Content overlay -->
	
	
	<!-- Vendor JS -->
	<script src="src/js/vendors.min.js"></script>
	<script src="src/js/pages/chat-popup.js"></script>
    <script src="assets/icons/feather-icons/feather.min.js"></script>
	
	

	
	<!-- CRMi App -->
	<script src="src/js/template.js"></script>
	<script src="src/js/pages/dashboard.js"></script>
	
</body>
</html>

</body>
</html>
