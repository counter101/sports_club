<?php
include "db_conn.php";

if (isset($_POST['export'])) {
  // Query to fetch data from the database
  $sql = "SELECT `id`, `first_name`, `last_name`, `birthdate`, `phone_number`, `phone_number2`, `email`, `email2`, `date_joined`,
   `membership_cat`, `street`, `province`, `country`, `zipcode` FROM `member_details`";
  $result = mysqli_query($conn, $sql);

  // Check if data is available
  if (mysqli_num_rows($result) > 0) {
    // Set the CSV file path and name
    $csvFilePath = 'C:/Users/queen/OneDrive/Desktop/export/file.csv';

    // Open the CSV file in write mode
    $csvFile = fopen($csvFilePath, 'w');

    // Write the column headers to the CSV file
    $columnHeaders = array('id', 'first_name', 'last_name', 'birthdate' ,'phone_number' ,'phone_number2' ,'email' ,
    'email2' ,'date_joined','membership_cat','street','province','country','zipcode');
    fputcsv($csvFile, $columnHeaders);

    // Loop through the database result and write each row to the CSV file
    while ($row = mysqli_fetch_assoc($result)) {
      // Extract the row data
      $rowData = array($row['id'], $row['first_name'], $row['last_name'], $row['birthdate'], $row['phone_number'], $row['phone_number2'], $row['email']
      , $row['email2'], $row['date_joined'], $row['membership_cat'], $row['street'], $row['province'], $row['country'], $row['zipcode']);

      // Write the row data to the CSV file
      fputcsv($csvFile, $rowData);
    }

    // Close the CSV file
    fclose($csvFile);

    echo "Data exported successfully to CSV file: " . $csvFilePath;
  } else {
    echo "No data found in the database.";
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <title>SPORTS CLUB</title>
</head>

<body>

<div>
 <a href = "index.php" class = "btn btn-danger">BACK</a>
</div>
</body>
</html>