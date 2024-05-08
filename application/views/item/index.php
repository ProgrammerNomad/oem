<!-- #region -->
script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">

<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Manage Category
      
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Category</li>
    </ol>
  </section>

<!DOCTYPE html>
<html>
<head>
    <title>Items List</title>
</head>
<body>
    <h2>Items List</h2>
    <table border="1">
        <thead>
            <tr>
                <th>Name</th>
                <th>description</th>
                <th>image_path</th>

                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($items as $item): ?>
                <tr>
                    <td><?php echo $item['name']; ?></td>
                    <td><?php echo $item['description']; ?></td>
                    <td><?php echo $item['image_path']; ?></td>

                    <td><a href="<?php echo base_url('items/delete/'.$item['id']); ?>">Delete</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <br>
    <a href="<?php echo base_url('admin/items/create'); ?>">Add Item</a>
</body>
</html>
