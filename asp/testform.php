<?php
include("config.php"); // Include the database connection file
?>



<!DOCTYPE html>
<html>
<head>
    <title>Shipping Information Form</title>
</head>
<body>
    <form method="post" action="testsubmit.php" enctype="multipart/form-data">
        <label for="sh_full_name">Full Name:</label>
        <input type="text" name="sh_full_name" required><br>

        <label for="sh_zip_code">Zip Code:</label>
        <input type="text" name="sh_zip_code"><br>

        <label for="sh_add1">Address Line 1:</label>
        <input type="text" name="sh_add1"><br>

        <label for="sh_add2">Address Line 2:</label>
        <input type="text" name="sh_add2"><br>

        <label for="sh_add3">Address Line 3:</label>
        <input type="text" name="sh_add3"><br>

        <label for="sh_city">City:</label>
        <input type="text" name="sh_city"><br>

        <label for="sh_state">State:</label>
        <input type="text" name="sh_state"><br>

        <label for="sh_country">Country:</label>
        <input type="text" name="sh_country"><br>

        <label for="sh_ph_no">Phone Number:</label>
        <input type="text" name="sh_ph_no"><br>

        <label for="sh_ph_no1">Phone Number 1:</label>
        <input type="text" name="sh_ph_no1"><br>

        <label for="sh_email">Email:</label>
        <input type="email" name="sh_email"><br>

        <label for="sh_attention">Attention:</label>
        <textarea name="sh_attention"></textarea><br>

        <label for="sh_referance">Reference:</label>
        <input type="text" name="sh_referance"><br>

        <label for="sh_document_type">Document Type:</label>
        <input type="text" name="sh_document_type"><br>

        <label for="sh_pan_no">PAN Number:</label>
        <input type="text" name="sh_pan_no"><br>

        <label for="sh_document_type1">Document Type 1:</label>
        <input type="text" name="sh_document_type1"><br>

        <label for="documentImage">Upload Aadhar Card Image:</label>
        <input type="file" name="documentImage"><br>

        <label for="documentImage_back">Upload Aadhar Card Back Image:</label>
        <input type="file" name="documentImage_back"><br>

        <label for="documentImage1">Upload PAN Card Image:</label>
        <input type="file" name="documentImage1"><br>
        
        
         <div id="product-details-container">
             
        <label for="product_details">Product Details:</label>
        <select name="nondg[]">
            <option value="DG">DG</option>
            <option value="Non-DG">Non-DG</option>
        </select><br>

        <label for="box_no">Box Number:</label>
        <input type="number" name="box_no[]"><br>

        <label for="product_name">Product Name:</label>
        <input type="text" name="product_name[]"><br>

        <label for="product_quantity">Product Quantity:</label>
        <input type="number" name="product_quantity[]"><br>

        <label for="price">Price:</label>
        <input type="number" name="price[]"><br>

        <label for="hsn_code">HSN Code:</label>
        <input type="text" name="hsn_code[]"><br>

 <button type="button" onclick="addProductDetails()">Add Product Details</button>
        </div>
       

        <input type="submit" value="Submit">
    </form>
    
     <script>
        // Function to add a new product details section
        function addProductDetails() {
            var container = document.getElementById('product-details-container');
            var newProduct = document.createElement('div');
            newProduct.innerHTML = `
                <hr>
                <label for="product_details">Product Details:</label>
                <select name="nondg[]">
                    <option value="DG">DG</option>
                    <option value="Non-DG">Non-DG</option>
                </select><br>

                <label for="box_no">Box Number:</label>
                <input type="number" name="box_no[]"><br>

                <label for="product_name">Product Name:</label>
                <input type="text" name="product_name[]"><br>

                <label for="product_quantity">Product Quantity:</label>
                <input type="number" name="product_quantity[]"><br>

                <label for="price">Price:</label>
                <input type="number" name="price[]"><br>

                <label for="hsn_code">HSN Code:</label>
                <input type="text" name="hsn_code[]"><br>
            `;
            container.appendChild(newProduct);
        }
    </script>
</body>
</html>
