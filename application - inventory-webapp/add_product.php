
<?php 
// Jonathan Blackwood 
// HND Software Development 
// Add product form page 
// 23/05/2023 
error_reporting(E_ALL); // PHP function to give feedback on any errors that happen
ini_set('display_errors', 1); // Sets display errors to display errors into the webpage, and display in the browser
include 'connect.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'header.php'; ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style/style.css">
</head>
<body>
<!-- Form used to add products -->
<div class="addstock-form"> 
                <form class = "stock-form" action="includes/add_product.inc.php" method="post" enctype="multipart/form-data">
                <input type="text" name="itemname" placeholder="Item name.." />
                <input type="text" name="quantity" placeholder="Quantity currently held.." />
                <input type="text" name="volume" placeholder="Volume.." />
                <input type="text" name="unit" placeholder="Unit size.." />
                <input type="text" name="price" placeholder="Price.." />
                <input type="text" name="suppliercode" placeholder="Supplier code.." />
                <input type="text" name="description" placeholder="Description.." />
                <button type="submit" name="submit">Add product</button>
                </form>
            </div>

            </form> 
            <?php include 'footer.php'; ?>  
</body>
</html>