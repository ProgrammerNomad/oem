<!DOCTYPE html>
<html>
<head>
    <title>Add Item</title>
</head>
<body>
    <h2>Add Item</h2>
    <?php echo validation_errors(); ?>
    <?php echo form_open_multipart('admin/items/create'); ?>
        <label>Name:</label><br>
        <input type="text" name="name"><br><br>
        <label>Description:</label><br>
        <textarea name="description"></textarea><br><br>
        <label>Image:</label><br>
        <input type="file" name="image_path"><br><br>
        <label>File:</label><br>
        <input type="file" name="userfile"><br><br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>
