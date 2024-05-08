<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Update sales docs
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Sales docs</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-md-12 col-xs-12">

        <?php if ($this->session->flashdata('success')): ?>
          <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                aria-hidden="true">&times;</span></button>
            <?php echo $this->session->flashdata('success'); ?>
          </div>
        <?php elseif ($this->session->flashdata('error')): ?>
          <div class="alert alert-error alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                aria-hidden="true">&times;</span></button>
            <?php echo $this->session->flashdata('error'); ?>
          </div>
        <?php endif; ?>

        <div class="box">

          <form role="form" action="/admin/salesdoc/update" method="post" enctype="multipart/form-data">
            <div class="box-body">

              <?php echo validation_errors();

              //echo '<pre>';
              // print_r($company_data['SalesDoc'][0]);
              
              // echo '</pre>';
              //echo $company_data['categories']['id']; ?>

              <?php
              if ($_REQUEST['updated'] == 1) {
                echo '<p class="text-danger">Sales doc has been updated.</p>';
              }
              ?>
              <div class="form-group">
                <label for="category_id">category_id</label>
                <select class="form-control" id="category_id" name="category_id">
                  <?php
                  echo $company_data['categories'];
                  ?>
                </select>
              </div>

              <div class="form-group">
                <label for="title">title</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Enter company name"
                  value="<?php echo $company_data['SalesDoc'][0]->title; ?>" autocomplete="off">
              </div>
              <div class="form-group">
                <label for="description">description</label>
                <textarea type="text" class="form-control" id="description" name="description"
                  placeholder="Enter company name"
                  autocomplete="off"><?php echo $company_data['SalesDoc'][0]->description; ?></textarea>
              </div>

              <div class="form-group">
                <label for="picture">picture</label>
                <?php
                foreach (unserialize($company_data['SalesDoc'][0]->picture) as $file) {

                  echo '<br><a href="/uploads/salesdocs/' . $file['picture'] . '" target="_blank">' . $file['picture'] . '</a> <a class="btn btn-danger btn-sm" onclick="DeleteDocFile(\'picture\',' . $company_data['SalesDoc'][0]->id . ',\'' . $file['picture'] . '\')">Delete</a>';

                }
                ?>
                <input type="file" class="form-control" id="picture" name="picture[]" placeholder="Enter company name"
                  multiple>
              </div>

              <div class="form-group">
                <label for="pdf">pdf</label>
                <?php
                foreach (unserialize($company_data['SalesDoc'][0]->pdf) as $file) {

                  echo '<br><a href="/uploads/salesdocs/' . $file['pdf'] . '" target="_blank">' . $file['pdf'] . '</a> <a class="btn btn-danger btn-sm" onclick="DeleteDocFile(\'pdf\',' . $company_data['SalesDoc'][0]->id . ',\'' . $file['pdf'] . '\')">Delete</a>';

                }
                ?>
                <input type="file" class="form-control" id="pdf" name="pdf[]" placeholder="Upload PDF" multiple>
              </div>

              <div class="form-group">
                <label for="drawing">drawing</label>
                <?php
                foreach (unserialize($company_data['SalesDoc'][0]->drawing) as $file) {

                  echo '<br><a href="/uploads/salesdocs/' . $file['drawing'] . '" target="_blank">' . $file['drawing'] . '</a> <a class="btn btn-danger btn-sm" onclick="DeleteDocFile(\'drawing\',' . $company_data['SalesDoc'][0]->id . ',\'' . $file['drawing'] . '\')">Delete</a>';

                }
                ?>
                <input type="file" class="form-control" id="drawing" name="drawing[]" placeholder="Upload drawing"
                  multiple>
              </div>

              <div class="form-group">
                <label for="doc_file">doc_file</label>
                <?php
                foreach (unserialize($company_data['SalesDoc'][0]->doc_file) as $file) {

                  echo '<br><a href="/uploads/salesdocs/' . $file['doc_file'] . '" target="_blank">' . $file['doc_file'] . '</a> <a class="btn btn-danger btn-sm" onclick="DeleteDocFile(\'doc_file\',' . $company_data['SalesDoc'][0]->id . ',\'' . $file['doc_file'] . '\')">Delete</a>';

                }
                ?>
                <input type="file" class="form-control" id="doc_file" name="doc_file[]" placeholder="Upload doc_file"
                  multiple>
              </div>

              <div class="form-group">
                <label for="power_point">power_point</label>
                <?php
                foreach (unserialize($company_data['SalesDoc'][0]->power_point) as $file) {

                  echo '<br><a href="/uploads/salesdocs/' . $file['power_point'] . '" target="_blank">' . $file['power_point'] . '</a> <a class="btn btn-danger btn-sm" onclick="DeleteDocFile(\'power_point\',' . $company_data['SalesDoc'][0]->id . ',\'' . $file['power_point'] . '\')">Delete</a>';

                }
                ?>
                <input type="file" class="form-control" id="power_point" name="power_point[]"
                  placeholder="Upload power_point" multiple>
              </div>

              <div class="form-group">
                <label for="active">active</label>

                <select name="active" id="active" class="form-control">

                  <option value="1" <?php if ($company_data['SalesDoc'][0]->active == 1) {
                    echo 'selected';
                  } ?>>Active
                  </option>
                  <option value="2" <?php if ($company_data['SalesDoc'][0]->active == 2) {
                    echo 'selected';
                  } ?>>InActive
                  </option>

                </select>
              </div>
            </div>
            <!-- /.box-body -->

            <div class="box-footer">
              <input type="hidden" name="id" value="<?php echo $company_data['SalesDoc'][0]->id; ?>" />
              <button type="submit" class="btn btn-primary">Update</button>
            </div>
          </form>
        </div>
        <!-- /.box -->
      </div>
      <!-- col-md-12 -->
    </div>
    <!-- /.row -->


  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script type="text/javascript">

  function DeleteDocFile(type, id, filename) {
    console.log('Delete clicked');

    $.ajax({
      url: "/admin/salesdoc/delete",
      method: "POST", // First change type to method here    
      data: {
        type: type,
        id: id,
        filename: filename
      },
      success: function (response) {


        if (response == 1) {
          //location.reload(true)
        } else {
          console.log(response);
        }
      },
      error: function (error) {
        alert("error" + error);
      }
    });
  }
  $(document).ready(function () {
    $("#companyNav").addClass('active');
    $("#message").wysihtml5();



  });
</script>