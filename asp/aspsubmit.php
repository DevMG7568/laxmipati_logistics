<?php
// booking.php

@include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $latestId = $_POST['latestId'];

  $user_name = $_POST['user_name'];
  $order_id = $_POST['order_id'];
  $sh_full_name = $_POST['sh_full_name'];
  $sh_zip_code = $_POST['sh_zip_code'];
  $sh_add1 = $_POST['sh_add1'];
  $sh_add2 = $_POST['sh_add2'];
  $sh_add3 = isset($_POST['sh_add3']) ? $_POST['sh_add3'] : '';
  $sh_city = $_POST['sh_city'];
  $sh_state = $_POST['sh_state'];
  $sh_country = $_POST['sh_country'];
  $sh_ph_no = $_POST['sh_ph_no'];
  $sh_ph_no1 = $_POST['sh_ph_no1'];
  $sh_email = $_POST['sh_email'];
  $sh_gst = $_POST['sh_gst'];
  $sh_attention = $_POST['sh_attention'];
  $sh_referance = $_POST['sh_referance'];
  $sh_document_type = $_POST['sh_document_type'];
  $sh_pan_no = $_POST['sh_pan_no'];
  $sh_document_type1 = $_POST['sh_document_type1'];
  $sh_pan_no1 = $_POST['sh_pan_no1'];

  $co_full_name = $_POST['co_full_name'];
  $co_zip_code = $_POST['co_zip_code'];
  $co_add1 = $_POST['co_add1'];
  $co_add2 = $_POST['co_add2'];
  $sh_add3 = isset($_POST['co_add3']) ? $_POST['co_add3'] : '';
  $co_city = $_POST['co_city'];
  $co_state = $_POST['co_state'];
  $co_country = $_POST['co_country'];
  $co_ph_no = $_POST['co_ph_no'];
  $co_ph_no1 = $_POST['co_ph_no1'];
  $co_email = $_POST['co_email'];
  $co_attention = $_POST['co_attention'];
  $co_referance = isset($_POST['co_referance']) ? $_POST['co_referance'] : '';

  $note = $_POST['note'];
  $awb_show = $_POST['awb_show'];
  $gift_type = $_POST['gift_type'];
  $currency = $_POST['currency'];
  $status = $_POST['status'];
  $invoice_no_date = $_POST['invoice_no_date'];
  $adate = $_POST['adate'];
  $totalprice = $_POST['totalprice'];
  $totalquantity = $_POST['totalquantity'];
  $nondg = $_POST['nondg'];
  $box_no = $_POST['box_no'];
  $product_name = $_POST['product_name'];
  $product_quantity = $_POST['product_quantity'];
  $price = $_POST['price'];
  $hsn_code = $_POST['hsn_code'];
  $total_price = $_POST['total_price'];

  // Initialize default values for image paths and names
  $documentImage = '';
  $documentImageBack = '';
  $documentImage1 = '';

  $documentType = $_POST['document_type_id'];
  $nob = $_POST['nob'];
  $weight = $_POST['weight'];
  $orderDate = $_POST['order_currier_date'];

  // Insert data into the 'dj' table
  $sql_dj = "INSERT INTO get_start (user_name, country, document_type_id, nob, weight, order_currier_date, sh_referance, note)
          VALUES ('$user_name', '$co_country', '$documentType', '$nob', '$weight', '$orderDate', '$sh_referance', '$note')";

  if ($conn->query($sql_dj) === TRUE) {
    // Get the generated 'id' from the 'dj' table
    $book_id = $conn->insert_id;
  } else {
    echo "Error: " . $sql_dj . "<br>" . $conn->error;
  }

  // Extract arrays from the form (assuming these are arrays)
  $heightArray = $_POST['height'];
  $widthArray = $_POST['width'];
  $lengthArray = $_POST['length'];
  $weightvArray = $_POST['weightv'];
  $weightbArray = $_POST['weightb'];

  // Loop through the arrays and insert data into the 'dj_get_booking' table
  for ($i = 0; $i < count($heightArray); $i++) {
    $height = $heightArray[$i];
    $width = $widthArray[$i];
    $length = $lengthArray[$i];
    $weightv = $weightvArray[$i];
    $weightb = $weightbArray[$i];

    // Insert data into the 'dj_get_booking' table using the correct 'book_id'
    $sql_dj_get_booking = "INSERT INTO get_booking (book_id, height, width, length, weightv, weightb)
                      VALUES ('$book_id', '$height', '$width', '$length', '$weightv', '$weightb')";

    if ($conn->query($sql_dj_get_booking) === TRUE) {
      // Successfully inserted into 'dj_get_booking' table
    } else {
      echo "Error: " . $sql_dj_get_booking . "<br>" . $conn->error;
    }
  }




  // Handle file uploads for documentImage
  if (!empty($_FILES['documentImage']['name'])) {
    $documentImage = $_FILES['documentImage']['name'];
    $documentImageTmp = $_FILES['documentImage']['tmp_name'];
    $documentImagePath = 'upload/' . $documentImage;

    if (move_uploaded_file($documentImageTmp, $documentImagePath)) {
      // Image uploaded successfully
    } else {
      echo "Error uploading documentImage.";
    }
  }

  // Handle file uploads for documentImage_back
  if (!empty($_FILES['documentImage_back']['name'])) {
    $documentImageBack = $_FILES['documentImage_back']['name'];
    $documentImageBackTmp = $_FILES['documentImage_back']['tmp_name'];
    $documentImageBackPath = 'upload/' . $documentImageBack;
    if (move_uploaded_file($documentImageBackTmp, $documentImageBackPath)) {
      // Image uploaded successfully
    } else {
      echo "Error uploading documentImage_back.";
    }
  }

  // Handle file uploads for documentImage1
  if (!empty($_FILES['documentImage1']['name'])) {
    $documentImage1 = $_FILES['documentImage1']['name'];
    $documentImage1Tmp = $_FILES['documentImage1']['tmp_name'];
    $documentImage1Path = 'upload/' . $documentImage1;
    if (move_uploaded_file($documentImage1Tmp, $documentImage1Path)) {
      // Image uploaded successfully
    } else {
      echo "Error uploading documentImage1.";
    }
  }


  // File uploaded successfully, insert the file name into the database
  $sql = "INSERT INTO order_details (order_id, user_name, sh_full_name, sh_zip_code, sh_add1, sh_add2, sh_add3, sh_city, sh_state, sh_country, sh_ph_no, sh_ph_no1, sh_email, sh_gst, sh_attention, sh_referance, sh_document_type, sh_pan_no, documentImage, documentImage_back, sh_document_type1, sh_pan_no1, documentImage1, co_full_name, co_zip_code, co_add1, co_add2, co_add3, co_city, co_state, co_country, co_ph_no, co_ph_no1, co_email, co_attention, co_referance, note, awb_show, gift_type, currency, status, invoice_no_date, adate, totalprice, totalquantity)
VALUES ('$order_id', '$user_name', '$sh_full_name', '$sh_zip_code', '$sh_add1', '$sh_add2', '$sh_add3', '$sh_city', '$sh_state', '$sh_country', '$sh_ph_no', '$sh_ph_no1', '$sh_email', '$sh_gst', '$sh_attention', '$sh_referance', '$sh_document_type', '$sh_pan_no', '$documentImage', '$documentImageBack', '$sh_document_type1', '$sh_pan_no1', '$documentImage1', '$co_full_name', '$co_zip_code', '$co_add1', '$co_add2', '$co_add3', '$co_city', '$co_state', '$co_country', '$co_ph_no', '$co_ph_no1', '$co_email', '$co_attention', '$co_referance', '$note', '$awb_show', '$gift_type', '$currency', '$status', '$invoice_no_date', '$adate', '$totalprice', '$totalquantity')";

  if ($conn->query($sql) === TRUE) {
    $product_id = $conn->insert_id;

    // Loop through the submitted data and insert it into the database
    for ($i = 0; $i < count($nondg); $i++) {
      $sqlp = "INSERT INTO product_details (product_id, nondg, box_no, product_name, product_quantity, price, hsn_code, total_price)
                VALUES ('$product_id', '$nondg[$i]', '$box_no[$i]', '$product_name[$i]', '$product_quantity[$i]', '$price[$i]', '$hsn_code[$i]', '$total_price[$i]')";

      if (mysqli_query($conn, $sqlp)) {
        echo "Record inserted successfully.";
      } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      }
    }

    // Redirect to the "allorder.php" page
    header("Location: allorder.php");
    // exit();
  }

  // // Email addresses where notifications will be sent
  // $sh_notification_email = "info@laxmipatiinternational.com"; // For sh_email
  // $co_notification_email = "info@laxmipatiinternational.com"; // For co_email

  // // Send notifications to the email addresses
  // $subject = "Notification for sh_email";
  // $message = "Your Courier is Booked  $sh_full_name.";
  // $headers = "From: info@laxmipatiinternational.com";

  // if (mail($sh_notification_email, $subject, $message, $headers)) {
  //   echo "Notification email for sh_email sent successfully!";
  // } else {
  //   echo "Notification email for sh_email could not be sent.";
  // }

  // $subject = "Notification for co_email";
  // $message = "Your Courier is Booked $co_full_name.";

  // if (mail($co_notification_email, $subject, $message, $headers)) {
  //   echo "Notification email for co_email sent successfully!";
  // } else {
  //   echo "Notification email for co_email could not be sent.";
  // }
}


$conn->close();
