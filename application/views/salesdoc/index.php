<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">

<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Manage Sales Doc

    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    </ol>
  </section>

  <section class="content">                                                                                          
    <div class="row">
      <div class="col-md-12 col-xs-12">

        <div id="messages"></div>

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

        <?php if (in_array('createCategory', $user_permission)): ?>
          

          <a class="btn btn-primary" href="/admin/Controller_AddSalesDocs/">Add sales doc</a>
          <br /> <br />
        <?php endif; ?>
       <div class="box">

          <div class="box-body">
            <table id="manageTable" class="table table-bordered table-hover table-striped">
              <thead>
                <tr>
                  <th>Category</th>
                  <th>Title</th>
                  <th>Picture</th> 
                  <th>Pdf</th> 
                  <th>Drawing</th> 
                  <th>Doc File</th> 
                  <th>Power Point</th> 
                  <th>Status</th>

                  <?php if (in_array('updateCategory', $user_permission) || in_array('deleteCategory', $user_permission)): ?>
                    <th>Action</th>
                  <?php endif; ?>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
    </div>
</section>
</div>

<?php if (in_array('createCategory', $user_permission)): ?>
<div class="modal fade" tabindex="-1" role="dialog" id="addModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Add SalesDoc</h4>
      </div>
      <form action="<?php echo base_url('admin/Controller_Salesdoc/create') ?>" method="post" enctype="multipart/form-data" id="createForm">
        <div class="modal-body">
        <div class="modal-body">

          <div class="form-group">
            <label for="category_id">Category</label>
            <select class="form-control" id="category_id" name="category_id">
              <option value="">select category</option>
              <?php echo $category;?>
            </select>
          </div> 
          

          <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Enter title" autocomplete="off">
          </div>
         
          <div class="form-groups">
            <label for="picture">Picture</label>
            <input type="file"  class="form-control"  id="picture" name="picture"  placeholder="Enter title" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="active">Status</label>
            <select class="form-control" id="active" name="active">
              <option value="1">Active</option>
              <option value="2">Inactive</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary ">Save changes</button>
          </div>
        </form>
        <script>
          function redirectToIndex() {
            window.location.href = "<?php echo base_url('admin/Controller_Salesdoc/index') ?>";
          }
        </script>
      </div>
     </form>
    </div>
  </div>
  </div>
<?php endif; ?>



<?php if (in_array('updateCategory', $user_permission)): ?>
  <div class="modal fade" tabindex="-1" role="dialog" id="editModal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
              aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Edit Salesdoc</h4>
        </div>

        <form role="form" action="<?php echo base_url('admin/Controller_Salesdoc/update/' . $id) ?>" method="post"
          id="updateForm">

          <div class="modal-body">
            <div id="editMessages"></div>

            <div class="form-group">
                        <label for="edit_category_id">Parent Category</label>
                        <select class="form-control" id="edit_category_id" name="edit_category_id">
                            <?php foreach ($parent_categories as $parent_category): ?>
                                <option value="<?php echo $parent_category['id']; ?>" <?php echo isset($category['parent_category']) && $category['parent_category'] == $parent_category['id'] ? 'selected' : ''; ?>><?php echo $parent_category['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
            <div class="form-group">
              <label for="edit_title">Title</label>
              <input type="text" class="form-control" id="edit_title" name="edit_title" placeholder="Enter Title"
                autocomplete="off">
            </div> 
            <div class="form-group">
              <label for="edit_active">Status</label>
              <select class="form-control" id="edit_active" name="edit_active">
                <option value="1">Active</option>
                <option value="2">Inactive</option>
              </select>
            </div>
          </div>
          <input type="hidden" id="edit_id" name="edit_id" value="<?php echo $id; ?>">

          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" onclick="redirectToIndex()">Save changes</button>
          </div>
        </form>
        <script>
          function redirectToIndex() {
            window.location.href = "<?php echo base_url('admin/Controller_Salesdoc/index') ?>";
          }
        </script>
      </div>

      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
<?php endif; ?>


<div class="modal fade" tabindex="-1" role="dialog" id="removeModal">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
            aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Remove Category</h4>
      </div>
      <form role="form" action="<?php echo base_url('admin/Controller_Salesdoc/remove') ?>" method="post"
        id="removeForm">
        <div class="modal-body">
          <p>Do you really want to remove?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" onclick="redirectToIndex()">Save changes</button>
        </div>
      </form>
      <script>
        function redirectToIndex() {
          window.location.href = "<?php echo base_url('admin/Controller_Salesdoc/index') ?>";
        }
      </script>
      </form>
    </div>
  </div>
</div>

<script type="text/javascript">
  var manageTable;

  $(document).ready(function () {
    $("#categoryNav").addClass('active');

    manageTable = $('#manageTable').DataTable({
      dom: 'Bfrtip',
      scrollX: true,
      buttons: [
        'copy', 'csv', 'excel', 'print'
      ],
      'ajax': 'fetchCategoryData',
      'order': []
    });

    $("#createForm").unbind('submit').on('submit', function () {
      var form = $(this);

      $(".text-danger").remove();

      $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data: form.serialize(),
        dataType: 'json',
        success: function (response) {

          manageTable.ajax.reload(null, false);

          if (response.success === true) {
            $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">' +
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
              '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>' + response.messages +
              '</div>');

            $("#addModal").modal('hide');

            $("#createForm")[0].reset();
            $("#createForm .form-group").removeClass('has-error').removeClass('has-success');

          } else {

            if (response.messages instanceof Object) {
              $.each(response.messages, function (index, value) {
                var id = $("#" + index);

                id.closest('.form-group')
                  .removeClass('has-error')
                  .removeClass('has-success')
                  .addClass(value.length > 0 ? 'has-error' : 'has-success');

                id.after(value);

              });
            } else {
              $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">' +
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>' + response.messages +
                '</div>');
            }
          }
        }
      });

      return false;
    });

  });

  function editFunc(id) {
    $.ajax({
      url: 'fetchCategoryDataById/' + id,
      type: 'post',
      dataType: 'json',
      success: function (response) {

        // $("#edit_category_id").html(response.categories);s
        $("#edit_title").val(response.title);

        $("#edit_active").val(response.active);
         $("#edit_category_id").html(response.categories);

        $("#updateForm").unbind('submit').bind('submit', function () {
          var form = $(this);

          $(".text-danger").remove();

          $.ajax({
            url: form.attr('action') + '/' + id,
            type: form.attr('method'),
            data: form.serialize(), 
            dataType: 'json',
            success: function (response) {

              manageTable.ajax.reload(null, false);

              if (response.success === true) {
                $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">' +
                  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                  '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>' + response.messages +
                  '</div>');


                $("#editModal").modal('hide');
                $("#updateForm .form-group").removeClass('has-error').removeClass('has-success');

              } else {

                if (response.messages instanceof Object) {
                  $.each(response.messages, function (index, value) {
                    var id = $("#" + index);

                    id.closest('.form-group')
                      .removeClass('has-error')
                      .removeClass('has-success')
                      .addClass(value.length > 0 ? 'has-error' : 'has-success');

                    id.after(value);

                  });
                } else {
                  $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">' +
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                    '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>' + response.messages +
                    '</div>');
                }
              }
            }
          });

          return false;
        });

      }
    });
  }

  function removeFunc(id) {
    if (id) {
      $("#removeForm").on('submit', function (event) {
        event.preventDefault();
        var form = $(this);

       
        $(".text-danger").remove();

        $.ajax({
          url: form.attr('action'),
          type: form.attr('method'),
          data: { id: id }, // Pass the ID to the server
          dataType: 'json',
          success: function (response) {
            // Reload the data table
            manageTable.ajax.reload(null, false);

            if (response.success === true) {
              $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">' +
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                '<strong><span class="glyphicon glyphicon-ok-sign"></span></strong>' + response.message +
                '</div>');

              $("#removeModal").modal('hide');

            } else {
              $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">' +
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                '<strong><span class="glyphicon glyphicon-exclamation-sign"></span></strong>' + response.message +
                '</div>');
            }
          },
          error: function (xhr, status, error) {
            console.error(xhr.responseText);
          }
        });

        return false;
      });
    }
  }

</script>
<script type="text/javascript" src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>