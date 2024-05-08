<header class="main-header">
    <!-- Logo -->
    <a href="" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>I</b>CI</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><i class="fa fa-cubes"></i><?php echo $itmdatarow->name; ?></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <?php if($this->session->userdata($logged_in_sess)['roll'] == 'A'){ ?>
      <form action="<?=base_url('Dashboard/itmmanagebrand')?>" method="post">
    <div class="krisu">
      <label>Choose Your Module</label>
        <select class="selectpicker" data-style="btn-info" name="brand_id" id="brand_id" onchange="javascript:this.form.submit()">
          <?php foreach($itmdata as $value){ ?>
          <option value="<?=$value->id?>" <?php if($this->session->userdata('itmid') == $value->id){ echo 'selected'; } ?>><?=$value->name?></option>
        <?php } ?>
        </select>
    </div>
    </form>
  <?php } ?>
    </nav>
  </header>

  <style>
    .krisu {
    position: absolute;
    right: 0;
    top: 10px;
    margin-right: 45px;
}
.krisu label {
    color: #fff;
    font-size: 20px;
    font-weight: 400;
}
.krisu select {
    padding: 5px 15px;
}
  </style>