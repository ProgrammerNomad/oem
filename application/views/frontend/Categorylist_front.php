<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category Records</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        h1 {
            text-align: center;
            margin-top: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border-bottom: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }
        th:last-child, td:last-child {
            border-right: none;
        }
        .category-name {
            font-weight: bold;
            cursor: pointer;
            color: blue;
            text-decoration: underline;
        }
        .parent-category {
            color: #666;
        }
    </style>
</head>
<body>
    <h1>Category Records</h1>
    <table>
        <thead>
            <tr>
                <th>Category</th>
                <th>Parent Category</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($records as $record): ?>
            <tr>
                <td>
                    <span class="category-name" onclick="<?php echo ($record['parent_category'] !== null) ? "openParentCategory('".$record['parent_category']."')" : ""; ?>">
                        <?php
                        $indentation = '';
                        if ($record['parent_category'] !== null) {
                            $indentation .= ''; 
                        } elseif ($record['parent_category'] == null) {
                            $indentation .= '-'; 
                        }
                        if (!empty($indentation)) {
                            echo $indentation . ' ';
                        }
                        echo $record['name'];
                        ?>
                    </span>
                </td>
                <td><span class="parent-category"><?php echo $record['parent_category']; ?></span></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <select id="subcategoryDropdown">
        <option value="0">Select Subcategory</option>
    </select>

    <a href="#" class="waves-effect waves-light nav-link bg-primary btn-primary fs-14" title="New Category" onclick="openNewCategoryForm()">New Category</a>

    <div id="newCategoryFormContainer"></div>

    <script>
        function openParentCategory(parentCategory) {
            updateSubcategories(parentCategory);
        }

        function updateSubcategories(parentCategory) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var subcategories = JSON.parse(this.responseText);
                    var dropdown = document.getElementById('subcategoryDropdown');
                    dropdown.innerHTML = ''; // Clear existing options
                    subcategories.forEach(function(subcategory) {
                        var option = document.createElement('option');
                        option.text = subcategory.name;
                        option.value = subcategory.id;
                        dropdown.appendChild(option);
                    });
                }
            };
            xhttp.open("GET", "fetchSubcategories.php?parentCategory=" + encodeURIComponent(parentCategory), true);
            xhttp.send();
        }

        function openNewCategoryForm() {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById('newCategoryFormContainer').innerHTML = this.responseText;
                }
            };
            xhttp.open("GET", "new_category_form.php", true);
            xhttp.send();
        }
    </script>
</body>
</html>
