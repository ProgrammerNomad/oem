<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Add sales docs

    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">sales docs</li>
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

          <form role="form" action="/admin/salesdoc/create" method="post" enctype="multipart/form-data">
            <div class="box-body">

              <?php echo validation_errors();

              // echo '<pre>';
              // print_r($company_data); ?>


              <div class="form-group">
                <label for="category_id">category_id</label>
                <select class="form-control" id="category_id" name="category_id">
                  <?php
                  foreach($company_data['categories'] as $cat)
                  {

                    echo '<option value="'.$cat->id.'">'.$cat->name.'</option>';

                  } 
                  ?>
                </select>
              </div>

              <div class="form-group">
                <label for="title">title</label>
                <input type="text" class="form-control" id="title" name="title"
                  placeholder="Enter company name" value="" autocomplete="off">
              </div>
              <div class="form-group">
                <label for="description">description</label>
                <textarea type="text" class="form-control" id="description" name="description"
                  placeholder="Enter company name" value="" autocomplete="off"></textarea>
              </div>

              <div class="form-group">
                <label for="picture">picture</label>
                <input type="file" class="form-control" id="picture" name="picture[]"
                  placeholder="Enter company name" multiple>
              </div>

              <div class="form-group">
                <label for="pdf">pdf</label>
                <input type="file" class="form-control" id="pdf" name="pdf[]"
                  placeholder="Upload PDF" multiple>
              </div>

              <div class="form-group">
                <label for="drawing">drawing</label>
                <input type="file" class="form-control" id="drawing" name="drawing[]"
                  placeholder="Upload drawing" multiple>
              </div>

              <div class="form-group">
                <label for="doc_file">doc_file</label>
                <input type="file" class="form-control" id="doc_file" name="doc_file[]"
                  placeholder="Upload doc_file" multiple>
              </div>

              <div class="form-group">
                <label for="power_point">power_point</label>
                <input type="file" class="form-control" id="power_point" name="power_point[]"
                  placeholder="Upload power_point" multiple>
              </div>

              <div class="form-group">
                <label for="active">active</label>

                  <select name="active" id="active" class="form-control">
                    <option value="1">Active</option>
                    <option value="2">InActive</option>
                  </select>
              </div>
            </div>
            <!-- /.box-body -->

            <div class="box-footer">
              <button type="submit" class="btn btn-primary">Save Changes</button>
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
  $(document).ready(function () {
    $("#companyNav").addClass('active');
    $("#message").wysihtml5();
  });
</script>