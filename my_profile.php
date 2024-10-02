<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Admin Profile</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script src="bootstrap/js/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="shortcut icon" href="" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/sidenav.css">
    <link rel="stylesheet" href="css/home.css">
    <script src="js/my_profile.js"></script>
    <script src="js/validateForm.js"></script>
    <script src="js/restrict.js"></script>
  </head>
  <body>
    <!-- Including side navigations -->
    <?php include("sections/sidenav.html"); ?>
    <div class="container-fluid">
      <div class="container">
        <!-- Header Section -->
        <?php
          require "php/header.php";
          createHeader('user', 'Profile', 'Manage Admin Details');
          // Database Connection
          require "php/db_connection.php";

          // Initialize variables with default values
          $pharmacy_name = $address = $email = $contact_number = $username = '';

          if($con) {
            $query = "SELECT * FROM admin_credentials LIMIT 1"; // Assuming single admin
            $result = mysqli_query($con, $query);

            if($result && mysqli_num_rows($result) > 0) {
              $row = mysqli_fetch_assoc($result);

              // Safely access array keys
              $pharmacy_name = isset($row['PHARMACY_NAME']) ? htmlspecialchars($row['PHARMACY_NAME']) : '';
              $address = isset($row['ADDRESS']) ? htmlspecialchars($row['ADDRESS']) : '';
              $email = isset($row['EMAIL']) ? htmlspecialchars($row['EMAIL']) : '';
              $contact_number = isset($row['CONTACT_NUMBER']) ? htmlspecialchars($row['CONTACT_NUMBER']) : '';
              $username = isset($row['USERNAME']) ? htmlspecialchars($row['USERNAME']) : '';
            } else {
              echo '<div class="alert alert-warning">No admin details found. Please contact the system administrator.</div>';
            }
          } else {
            echo '<div class="alert alert-danger">Database connection failed. Please try again later.</div>';
          }
        ?>
        <div class="row">
          <div class="col-md-6">
            <form>
              <!-- Pharmacy Name -->
              <div class="form-group">
                <label class="font-weight-bold" for="pharmacy_name">Pharmacy Name :</label>
                <input id="pharmacy_name" type="text" class="form-control" value="<?php echo $pharmacy_name; ?>" placeholder="Pharmacy Name" onkeyup="validateName(this.value, 'pharmacy_name_error');" disabled>
                <code class="text-danger small font-weight-bold float-right mb-2" id="pharmacy_name_error" style="display: none;"></code>
              </div>

              <!-- Address -->
              <div class="form-group">
                <label class="font-weight-bold" for="address">Address :</label>
                <textarea id="address" class="form-control" placeholder="Address" onkeyup="validateAddress(this.value, 'address_error');" style="max-height: 100px;" disabled><?php echo $address; ?></textarea>
                <code class="text-danger small font-weight-bold float-right mb-2" id="address_error" style="display: none;"></code>
              </div>

              <!-- Email -->
              <div class="form-group">
                <label class="font-weight-bold" for="email">Email :</label>
                <input id="email" type="email" class="form-control" value="<?php echo $email; ?>" placeholder="Email" onkeyup="notNull(this.value, 'email_error');" disabled>
                <code class="text-danger small font-weight-bold float-right mb-2" id="email_error" style="display: none;"></code>
              </div>

              <!-- Contact Number -->
              <div class="form-group">
                <label class="font-weight-bold" for="contact_number">Contact Number :</label>
                <input id="contact_number" type="text" class="form-control" value="<?php echo $contact_number; ?>" placeholder="Contact Number" onkeyup="validateContactNumber(this.value, 'contact_number_error');" disabled>
                <code class="text-danger small font-weight-bold float-right mb-2" id="contact_number_error" style="display: none;"></code>
              </div>

              <!-- Username -->
              <div class="form-group">
                <label class="font-weight-bold" for="username">Username :</label>
                <input id="username" type="text" class="form-control" value="<?php echo $username; ?>" placeholder="Username" onkeyup="notNull(this.value, 'username_error');" disabled>
                <code class="text-danger small font-weight-bold float-right mb-2" id="username_error" style="display: none;"></code>
              </div>

              <!-- Horizontal Line -->
              <hr class="my-4" style="border-top: 2px solid #02b6ff;">

              <!-- Buttons -->
              <div class="form-group">
                <div id="edit_buttons">
                  <button type="button" class="btn btn-primary font-weight-bold" onclick="edit();">EDIT</button>
                  <a href="change_password.php" class="btn btn-warning font-weight-bold">Change Password</a>
                </div>
                <div id="update_cancel" style="display: none;">
                  <button type="button" class="btn btn-danger font-weight-bold" onclick="edit(true);">CANCEL</button>
                  <button type="button" class="btn btn-success font-weight-bold" onclick="updateAdminDetails();">UPDATE</button>
                </div>
              </div>

              <!-- Acknowledgement Message -->
              <div id="admin_acknowledgement" class="h5 text-success font-weight-bold text-center" style="font-family: sans-serif;"></div>
            </form>
          </div>
        </div>
        <hr style="border-top: 2px solid #ff5252;">
      </div>
    </div>
  </body>
</html>
