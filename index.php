<?php
include "db_conn.php";
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

  <!--Modal Script -->
  <script>
    //script for another phone number 
    function togglePhoneNumberField() {
      var checkbox = document.getElementById("addNumberCheckbox");
      var phoneNumberField = document.getElementById("phoneNumberField");
      
      phoneNumberField.style.display = checkbox.checked ? "block" : "none";
    }
    //script for another email 
    function toggleEmailField() {
      var checkbox = document.getElementById("addEmailCheckbox");
      var emailField = document.getElementById("emailField");
      
      emailField.style.display = checkbox.checked ? "block" : "none";
    }
    function openModal() {
      var modal = document.getElementById("myModal");
      var modalContent = modal.querySelector(".modal-content");

      // AJAX request to load PHP file content
      var xhr = new XMLHttpRequest();
      xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
          if (xhr.status === 200) {
            modalContent.innerHTML = xhr.responseText;
            modal.style.display = "block";
          } else {
            alert("Error loading PHP file.");
          }
        }
      };
      xhr.open("GET", "add_new.php", true);
      xhr.send();
    }

    function closeModal() {
      document.getElementById("myModal").style.display = "none";
    }

    
  </script>

  <title>Sports Club</title>
  <link rel="stylesheet" type="text/css" href="styles.css">
</head>

<body>

<header>
    <div class="logo">
      <img src="images/logo.png" alt="Logo">
    </div>
    <nav>
    <div class="sidebar" style = >
            <ul>
            <li><a href="index.php" class="active" style = "font-size: 23px; font-weight: bold;">Members details</a></li>
            <li><a href="membership.php" style = "font-size: 23px; font-weight: bold;">Membership</a></li>
            </ul>
        </div>
    </nav>
  </header>



  <div class="content">
    <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #00ff5573;">
     Sports Club
    </nav>

    <div class="container">
            <?php
                if (isset($_GET["msg"])) {
                $msg = $_GET["msg"];
                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                ' . $msg . '
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
                }
            ?>
        <button  class="btn btn-dark mb-3" onclick="openModal()">Add New</button>
        <div id="myModal" class="modal">
            <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <!-- PHP file content will be loaded here -->
            </div>
        </div>

        <table class="table table-hover text-center">
            <thead class="table-dark">
                <tr>
                <th scope="col">ID</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Birthdate</th>
                <th scope="col">Phone number</th>
                <th scope="col">Email</th>
                <th scope="col">Date Joined</th>
                <th scope="col">Membership Category</th>
                <th scope="col">Address</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM `member_details`";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                
            ?>
            <tr>
                <td><?php echo $row["id"] ?></td>
                <td><?php echo $row["first_name"] ?></td>
                <td><?php echo $row["last_name"] ?></td>
                <td><?php echo $row["birthdate"] ?></td>
                <td><?php if($row["phone_number2"] != 0){
                echo $row["phone_number"] . '<br>' .$row["phone_number2"];
                }else{
                    echo $row["phone_number"];
                }
                 ?></td>

                <td><?php echo $row["email"]. '<br>' .$row["email2"] ?></td>
                <td><?php echo $row["date_joined"] ?></td>
                <td><?php echo $row["membership_cat"] ?></td>

                <td><?php 
                    $address = $row["street"]  . ' ' . $row["province"]. ' ' . $row["country"] . ' ' . $row["zipcode"];
                     echo $address ?></td>
                <td>

                <a href="edit.php?id=<?php echo $row["id"] ?>" class="link-dark"><i class="fa-solid fa-pen-to-square fs-5 me-3"></i></a>
                <a href="delete.php?id=<?php echo $row["id"] ?>" class="link-dark"><i class="fa-solid fa-trash fs-5"></i></a>
                </td>
            </tr>
            <?php
            }
            ?>
            
        </tbody>
    </table>
             <form method="post" action="export.php">
            <input type="submit" name="export" value="Export to CSV">
            </form>
    </div>
    </div>

  <!-- Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>