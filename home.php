<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Dashboard - Home</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- jQuery and Bootstrap JS -->
    <script src="bootstrap/js/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <!-- Additional Font Awesome Version (if needed) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Favicon -->
    <link rel="shortcut icon" href="images/icon.svg" type="image/x-icon">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/sidenav.css">
    <link rel="stylesheet" href="css/home.css">
    <!-- Custom JS -->
    <script src="js/restrict.js"></script>
  </head>
  <body>
    <!-- Sidebar Navigation -->
    <?php include "sections/sidenav.html"; ?>

    <div class="container-fluid">
      <div class="container">
        <!-- Header Section -->
        <?php
          require "php/header.php";
          createHeader('home', 'Dashboard', 'Home');
        ?>
        <!-- Header Section End -->

        <!-- Main Content -->
        <div class="row">
          <!-- Statistics Section -->
          <div class="col-12 col-md-8">
            <?php
              function createSection1($location, $title, $table) {
                require 'php/db_connection.php';

                // Initialize count
                $count = 0;

                // Base query
                $query = "SELECT * FROM `$table`";

                // Modify query for specific sections
                if($title == "Out of Stock") {
                  $query = "SELECT * FROM `$table` WHERE `QUANTITY` = 0";
                }

                // Execute query
                $result = mysqli_query($con, $query);
                if(!$result){
                  echo "<div class='alert alert-danger'>Error fetching data for $title.</div>";
                  return;
                }

                // Count rows based on title
                if($title == "Expired") {
                  while($row = mysqli_fetch_assoc($result)) {
                    $expiry_date = $row['EXPIRY_DATE']; // Expected format: MM/YY
                    $exp_month = intval(substr($expiry_date, 0, 2));
                    $exp_year = intval(substr($expiry_date, 3, 2));

                    $current_month = intval(date('m'));
                    $current_year = intval(date('y'));

                    if($exp_year < $current_year || ($exp_year == $current_year && $exp_month < $current_month)) {
                      $count++;
                    }
                  }
                } else {
                  $count = mysqli_num_rows($result);
                }

                echo '
                  <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
                    <div class="dashboard-stats card text-center h-100" onclick="location.href=\''.$location.'\'" style="cursor: pointer;">
                      <div class="card-body">
                        <h3 class="card-title">'.$count.'</h3>
                        <p class="card-text"><i class="fa fa-play fa-rotate-270 text-warning"></i></p>
                        <h5 class="card-subtitle text-muted">'.$title.'</h5>
                      </div>
                    </div>
                  </div>
                ';
              }

              // Create Statistics Sections
              createSection1('manage_customer.php', 'Total Customer', 'customers');
              createSection1('manage_supplier.php', 'Total Supplier', 'suppliers');
              createSection1('manage_medicine.php', 'Total Medicine', 'medicines');
              createSection1('manage_medicine_stock.php?out_of_stock=true', 'Out of Stock', 'medicines_stock');
              createSection1('manage_medicine_stock.php?expired=true', 'Expired', 'medicines_stock');
              createSection1('manage_invoice.php', 'Total Invoice', 'invoices');
            ?>
          </div>

          <!-- Today's Report Section -->
          <div class="col-12 col-md-4">
            <div class="todays-report card">
              <div class="card-header bg-primary text-white">
                <h5>Todays Report</h5>
              </div>
              <div class="card-body">
                <table class="table table-bordered table-striped table-hover mb-0">
                  <tbody>
                    <?php
                      require 'php/db_connection.php';
                      if($con) {
                        $date = date('Y-m-d');

                        // Total Sales
                        $total_sales = 0;
                        $sales_query = "SELECT `NET_TOTAL` FROM `invoices` WHERE `INVOICE_DATE` = '$date'";
                        $sales_result = mysqli_query($con, $sales_query);
                        if($sales_result){
                          while($row = mysqli_fetch_assoc($sales_result)) {
                            $total_sales += $row['NET_TOTAL'];
                          }
                        }

                        // Total Purchase
                        $total_purchase = 0;
                        $purchase_query = "SELECT `TOTAL_AMOUNT` FROM `purchases` WHERE `PURCHASE_DATE` = '$date'";
                        $purchase_result = mysqli_query($con, $purchase_query);
                        if($purchase_result){
                          while($row = mysqli_fetch_assoc($purchase_result)) {
                            $total_purchase += $row['TOTAL_AMOUNT'];
                          }
                        }
                      }
                    ?>
                    <tr>
                      <th>Total Sales</th>
                      <th class="text-success">BDT. <?php echo number_format($total_sales, 2); ?></th>
                    </tr>
                    <tr>
                      <th>Total Purchase</th>
                      <th class="text-danger">BDT. <?php echo number_format($total_purchase, 2); ?></th>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <!-- Main Content End -->

        <hr style="border-top: 2px solid #ff5252;">

        <!-- Additional Sections -->
        <div class="row">
          <?php
            function createSection2($icon, $location, $title) {
              echo '
                <div class="col-12 col-sm-6 col-md-3 col-lg-3 mb-3">
                  <div class="dashboard-stats card text-center h-100" onclick="location.href=\''.$location.'\'" style="cursor: pointer;">
                    <div class="card-body">
                      <span class="h1"><i class="fa fa-'.$icon.' p-2"></i></span>
                      <h5 class="card-title mt-2">'.$title.'</h5>
                    </div>
                  </div>
                </div>
              ';
            }

            // Create Additional Sections
            createSection2('address-card', 'new_invoice.php', 'Create New Invoice');
            createSection2('handshake', 'add_customer.php', 'Add New Customer');
            createSection2('shopping-bag', 'add_medicine.php', 'Add New Medicine');
            createSection2('group', 'add_supplier.php', 'Add New Supplier');
            createSection2('bar-chart', 'add_purchase.php', 'Add New Purchase');
            createSection2('book', 'sales_report.php', 'Sales Report');
            createSection2('book', 'purchase_report.php', 'Purchase Report');
          ?>
        </div>
        <!-- Additional Sections End -->

        <hr style="border-top: 2px solid #ff5252;">
      </div>
    </div>
  </body>
</html>
