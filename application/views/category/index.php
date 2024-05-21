 <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">

<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Manage OEM Madule
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">OEM Madule</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <div class="col-md-12 col-xs-12">

        <div id="messages"></div>

        <?php if($this->session->flashdata('success')): ?>
          <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo $this->session->flashdata('success'); ?>
          </div>
        <?php elseif($this->session->flashdata('error')): ?>
          <div class="alert alert-error alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo $this->session->flashdata('error'); ?>
          </div>
        <?php endif; ?>

        <?php if(in_array('createCategory', $user_permission)): ?>
          <button class="btn btn-primary" data-toggle="modal" data-target="#addModal">Add OEM Madule</button>
          <br /> <br />
        <?php endif; ?>

        <div class="box">
          
          <div class="box-body">
            <table id="manageTable" class="table table-bordered table-hover table-striped">
              <thead>
              <tr>
              <th>Parent Category</th>
                <th>Category</th>
                <th>Status</th>
                <?php if(in_array('updateCategory', $user_permission) || in_array('deleteCategory', $user_permission)): ?>
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
        <h4 class="modal-title">Add OEM Madule</h4>
      </div>
      <form role="form" action="<?php echo base_url('admin/Controller_Category/create') ?>" method="post" id="createForm">
        <div class="modal-body">
          <div class="form-group">
            <label for="category_name">Category</label>
            <input type="text" class="form-control" id="category_name" name="category_name" placeholder="Enter category name" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="parent_category">Parent Category</label>
            <select class="form-control" id="parent_category" name="parent_category" placeholder="Enter Parent category " autocomplete="off"> >
              <?php echo $category;?>
            </select>
            
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
          <button type="submit" class="btn btn-primary" onclick="redirectToIndex()">Save </button>
    </div>

</form>

<script>
    function redirectToIndex() {
        window.location.href = "<?php echo base_url('admin/Controller_Category/index') ?>";
    }
</script>
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
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit OEM Module</h4>
            </div>

            <form role="form" action="<?php echo base_url('admin/Controller_Category/update/' . (isset($category['id']) ? $category['id'] : '')) ?>" method="post" id="updateForm">

                <div class="modal-body">
                    <div id="messages"></div>

                    <div class="form-group">
                        <label for="edit_category_name">OEM Module Name</label>
                        <input type="text" class="form-control" id="edit_category_name" name="edit_category_name" placeholder="Enter category name" autocomplete="off" value="<?php echo isset($category['name']) ? $category['name'] : ''; ?>">
                    </div>

                    <div class="form-group">
                        <label for="edit_parent_category">OEM Module Category</label>
                        <select class="form-control" id="edit_parent_category" name="edit_parent_category">
                            
                        </select>
                    </div>
                    <!-- edit_parent_category -->
                    <div class="form-group">
                        <label for="edit_active">Status</label>
                        <select class="form-control" id="edit_active" name="edit_active">
                            <option value="1" <?php echo isset($category['active']) && $category['active'] == 1 ? 'selected' : ''; ?>>Active</option>
                            <option value="2" <?php echo isset($category['active']) && $category['active'] == 2 ? 'selected' : ''; ?>>Inactive</option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary"onclick="redirectToIndex()" >Update </button>
    </div>

</form>

<script>
    function redirectToIndex() {
        window.location.href = "<?php echo base_url('admin/Controller_Category/index') ?>";
    }
</script>

      </form>


    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php endif; ?>


<?php if(in_array('deleteCategory', $user_permission)): ?>
<!-- remove brand modal -->
<div class="modal fade " tabindex="-1" role="dialog" id="removeModal">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Remove OEM Madule</h4>
      </div>

      <form role="form" action="<?php echo base_url('admin/Controller_Category/remove') ?>" method="post" id="removeForm">
        <div class="modal-body">
          <p>Do you really want to remove?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" onclick="redirectToIndex()">Delete </button>
    </div>

</form>

<script>
    function redirectToIndex() {
        window.location.href = "<?php echo base_url('admin/Controller_Category/index') ?>";
    }
</script>

      </form>


    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php endif; ?>


<script type="text/javascript">
var manageTable;

$(document).ready(function() {
  $("#categoryNav").addClass('active');
  
  manageTable = $('#manageTable').DataTable({
    dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'print'
        ], 
    'ajax': 'fetchCategoryData',
    'order': []
  });

  $("#createForm").unbind('submit').on('submit', function() {
    var form = $(this);

    $(".text-danger").remove();

    $.ajax({
      url: form.attr('action'),
      type: form.attr('method'),
      data: form.serialize(), 
      dataType: 'json',
      success:function(response) {

        manageTable.ajax.reload(null, false); 

        if(response.success === true) {
          $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
            '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
          '</div>');


          $("#addModal").modal('hide');

          $("#createForm")[0].reset();
          $("#createForm .form-group").removeClass('has-error').removeClass('has-success');

        } else {

          if(response.messages instanceof Object) {
            $.each(response.messages, function(index, value) {
              var id = $("#"+index);

              id.closest('.form-group')
              .removeClass('has-error')
              .removeClass('has-success')
              .addClass(value.length > 0 ? 'has-error' : 'has-success');
              
              id.after(value);

            });
          } else {
            $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
            '</div>');
          }
        }
      }
    }); 

    return false;
  });

});

function editFunc(id)
{ 
  $.ajax({
    url: 'fetchCategoryDataById/'+id,
    type: 'post',
    dataType: 'json',
    success:function(response) {

      $("#edit_category_name").val(response.name);
      $("#edit_active").val(response.active);
      $("#edit_parent_category").html(response.categories);

      $("#updateForm").unbind('submit').bind('submit', function() {
        var form = $(this);

        $(".text-danger").remove();

        $.ajax({
          url: form.attr('action') + '/' + id,
          type: form.attr('method'),
          data: form.serialize(), 
          dataType: 'json',
          success:function(response) {

            manageTable.ajax.reload(null, false); 

            if(response.success === true) {
              $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
              '</div>');


              // hide the modal
              $("#editModal").modal('hide');
              // reset the form 
              $("#updateForm .form-group").removeClass('has-error').removeClass('has-success');

            } else {

              if(response.messages instanceof Object) {
                $.each(response.messages, function(index, value) {
                  var id = $("#"+index);

                  id.closest('.form-group')
                  .removeClass('has-error')
                  .removeClass('has-success')
                  .addClass(value.length > 0 ? 'has-error' : 'has-success');
                  
                  id.after(value);

                });
              } else {
                $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
                  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                  '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
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

function removeFunc(id)
{
  if(id) {
    $("#removeForm").on('submit', function() {

      var form = $(this);

      $(".text-danger").remove();

      $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data: { category_id:id }, 
        dataType: 'json',
        success:function(response) {

          manageTable.ajax.reload(null, false); 

          if(response.success === true) {
            $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
            '</div>');

            // hide the modal
            $("#removeModal").modal('hide');

          } else {

            $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
            '</div>'); 
          }
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
