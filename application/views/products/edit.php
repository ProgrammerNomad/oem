

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
     Edit Products

    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Products</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Small boxes (Stat box) -->
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


        <div class="box">
         
          <!-- /.box-header -->
          <form role="form" action="<?php base_url('Controller_Products/update') ?>" method="post" enctype="multipart/form-data">
              <div class="box-body">

                <?php echo validation_errors(); ?>

                
      
            <div class="form-group">
                  <label for="brands">Items</label>
                  <?php $brand_data = json_decode($product_data['brand_id']); ?>
                  <select class="form-control select_group" id="brands" name="brands[]" >
                    <?php foreach ($brands as $k => $v): ?>
                      <option value="<?php echo $v['id'] ?>" <?php if(in_array($v['id'], $brand_data)) { echo 'selected="selected"'; } ?>><?php echo $v['name'] ?></option>
                    <?php endforeach ?>
                  </select>
                </div>

                <div class="form-group">
                  <label for="category">Category</label>
                  <?php $category_data = json_decode($product_data['category_id']); ?>
                  <select class="form-control select_group" id="category" name="category[]" >
                    <?php foreach ($category as $k => $v): ?>
                      <option value="<?php echo $v['id'] ?>" <?php if(in_array($v['id'], $category_data)) { echo 'selected="selected"'; } ?>><?php echo $v['name'] ?></option>
                    <?php endforeach ?>
                  </select>
                </div>
               <!-- <div class="form-group">
                  <label for="product_name">Product name</label>
                  <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Enter product name" value="<?php echo $product_data['name']; ?>"  autocomplete="off"/>
                </div>-->

                <!-- <div class="form-group"> -->
                  <!-- <label for="sku">SKU</label> -->
                  <!-- <input type="text" class="form-control" id="sku" name="sku" placeholder="Enter sku" value="<?php echo $product_data['sku']; ?>" autocomplete="off" /> -->
                <!-- </div> -->
                
                <div class="form-group">
                  <label for="price">WSP Price</label>
                  <input type="number" class="form-control" id="" name="stockprice" placeholder="Enter stock price" value="<?php echo $product_data['stockprice']; ?>" autocomplete="off" />
                </div>
                
                <div class="form-group">
                  <label for="price">Excise Duty</label>
                  <input type="hidden" class="form-control pricevalue" id="amontprice">
                  <input type="number" class="form-control" id="" name="ExciseDuty" placeholder="Enter Excise Duty price" value="<?php echo $product_data['ExciseDuty']; ?>" autocomplete="off" />
                </div>
                
            <div class="form-group">
                  <label for="price">Retail Margin </label>
                  <input type="number" class="form-control" id="" name="retail" placeholder="Enter Retail Margin price" value="<?php echo $product_data['retail']; ?>" autocomplete="off" />
                </div>

                <div class="form-group">
                  <label for="store">Size Value (ML)</label>
                    <input type="text" class="form-control" id="sizevalue" name="sizevalue" placeholder="Enter Size value (ML)" value="<?php echo $product_data['sizevalue']; ?>" autocomplete="off" />
                </div>

                <div class="form-group">
                  <label for="store">Pack Size </label>
                    <input type="text" class="form-control" id="packsize" name="packsize" placeholder="Enter Pack Size " value="<?php echo $product_data['packsize']; ?>" autocomplete="off" />
                </div>
                
                 <div class="form-group">
                  <label for="store">Size</label>
                    <input type="text" class="form-control" id="size" name="size" placeholder="Enter Size " value="<?php echo $product_data['size']; ?>" autocomplete="off" />
                </div>
                
                 <div class="form-group">
                  <label for="store">Liquor Type</label>
                  <select class="form-control" id="liquertype" name="liquertype">
                    <option value="">selcte Liquor Type</option>
                    <option value="Foreign Liquor" <?php if($product_data['liquertype'] == 'Foreign Liquor'){  echo 'selected'; } ?>>Foreign Liquor</option>
                    <option value="Indian Liquor" <?php if($product_data['liquertype'] == 'Indian Liquor'){  echo 'selected'; } ?>>Indian Liquor</option>
                    <option value="Country Liquor" <?php if($product_data['liquertype'] == 'Country Liquor'){  echo 'selected'; } ?>>Country Liquor</option>
                  </select>
                </div> 
          

                <div class="form-group">
                  <label for="store">Warehouse</label>
                  <select class="form-control select_group" id="store" name="store">
                    <?php foreach ($stores as $k => $v): ?>
                      <option value="<?php echo $v['id'] ?>" <?php if($product_data['store_id'] == $v['id']) { echo "selected='selected'"; } ?> ><?php echo $v['name'] ?></option>
                    <?php endforeach ?>
                  </select>
                </div>

                <div class="form-group">
                  <label for="store">Availability</label>
                  <select class="form-control" id="availability" name="availability">
                    <option value="1" <?php if($product_data['availability'] == 1) { echo "selected='selected'"; } ?>>Yes</option>
                    <option value="2" <?php if($product_data['availability'] != 1) { echo "selected='selected'"; } ?>>No</option>
                  </select>
                </div>



              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="<?php echo base_url('Controller_Products/') ?>" class="btn btn-danger">Back</a>
              </div>
            </form>
          <!-- /.box-body -->
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
  
  $(document).ready(function() {
    $(".select_group").select2();
    $("#description").wysihtml5();

    $("#mainProductNav").addClass('active');
    $("#manageProductNav").addClass('active');
    
    var btnCust = '<button type="button" class="btn btn-secondary" title="Add picture tags" ' + 
        'onclick="alert(\'Call your custom code here.\')">' +
        '<i class="glyphicon glyphicon-tag"></i>' +
        '</button>'; 
    $("#product_image").fileinput({
        overwriteInitial: true,
        maxFileSize: 1500,
        showClose: false,
        showCaption: false,
        browseLabel: '',
        removeLabel: '',
        browseIcon: '<i class="glyphicon glyphicon-folder-open"></i>',
        removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
        removeTitle: 'Cancel or reset changes',
        elErrorContainer: '#kv-avatar-errors-1',
        msgErrorClass: 'alert alert-block alert-danger',
        // defaultPreviewContent: '<img src="/uploads/default_avatar_male.jpg" alt="Your Avatar">',
        layoutTemplates: {main2: '{preview} ' +  btnCust + ' {remove} {browse}'},
        allowedFileExtensions: ["jpg", "png", "gif"]
    });

  });
</script>