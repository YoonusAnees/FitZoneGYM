<?php
include("db/dbconn.php");

// Check for database connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get search query from URL if it exists
$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';

// Query for bookings based on search
$sql_booking = "SELECT b.id, u.username, u.email, c.ClassName, c.Description, c.Schedule, c.Price
                FROM class_bookings b
                JOIN userregistration u ON b.user_id = u.id
                JOIN gym_classes c ON b.class_id = c.id
                WHERE u.username LIKE '%$search%' OR u.email LIKE '%$search%' OR c.ClassName LIKE '%$search%'";

$result_booking = mysqli_query($conn, $sql_booking);

// Query for staff based on search
$querystaff = $search ? "SELECT * FROM staff WHERE FirstName LIKE '%$search%' OR LastName LIKE '%$search%'" : "SELECT * FROM staff";
$resultstaff = mysqli_query($conn, $querystaff);

// Query for users based on search
$queryuser = $search ? "SELECT * FROM userregistration WHERE username LIKE '%$search%' OR email LIKE '%$search%'" : "SELECT * FROM userregistration";
$resultuser = mysqli_query($conn, $queryuser);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="css/style.css" />
    <title>Admin Dashboard</title>
  </head>
  <body>
    <!-- Top Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar" aria-controls="offcanvasExample">
          <span class="navbar-toggler-icon" data-bs-target="#sidebar"></span>
        </button>
        <a class="navbar-brand me-auto ms-lg-0 ms-3 text-uppercase fw-bold" href="#">FitZon Fitness Admin</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#topNavBar" aria-controls="topNavBar" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="topNavBar">
          <form class="d-flex ms-auto my-3 my-lg-0" method="GET" action="">
            <div class="input-group">
                <input class="form-control" type="search" name="search" placeholder="Search by name" aria-label="Search" 
                    value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
                <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i></button>
            </div>
        </form>
          <ul class="navbar-nav">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle ms-2" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-person-fill"></i>
              </a>
              <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="logout.php">Log out</a></li>
                <li><a class="dropdown-item" href="adminmain.php">Page</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Sidebar -->
    <div class="offcanvas offcanvas-start sidebar-nav bg-dark" tabindex="-1" id="sidebar">
      <div class="offcanvas-body p-0">
        <nav class="navbar-dark">
          <ul class="navbar-nav">
            <li><div class="text-muted small fw-bold text-uppercase px-3">CORE</div></li>
            <li><a href="#" class="nav-link px-3 active"><span class="me-2"><i class="bi bi-speedometer2"></i></span><span>Admin Dashboard</span></a></li>
            <li class="my-4"><hr class="dropdown-divider bg-light" /></li>
            <li><div class="text-muted small fw-bold text-uppercase px-3 mb-3">Interface</div></li>
            <li><a href="adminmain.php" class="nav-link px-3"><span class="me-2"><i class="bi bi-book-fill"></i></span><span>Go To Page</span></a></li>
            <li><a href="ADMINaddproduct.php" class="nav-link px-3"><span class="me-2"><i class="bi bi-book-fill"></i></span><span>Add items</span></a></li>
            <li><a href="ADMINshowproducts.php" class="nav-link px-3"><span class="me-2"><i class="bi bi-book-fill"></i></span><span>Show items</span></a></li>
            <li><a href="ADMINaddstaff.php" class="nav-link px-3"><span class="me-2"><i class="bi bi-book-fill"></i></span><span>Add Staff</span></a></li>
            <li><a href="ADMINshowstaff.php" class="nav-link px-3"><span class="me-2"><i class="bi bi-book-fill"></i></span><span>Show Staff</span></a></li>
            <li><a href="ADMINaddtrainer.php" class="nav-link px-3"><span class="me-2"><i class="bi bi-book-fill"></i></span><span>Add Trainer</span></a></li>
            <li><a href="ADMINshowtrainer.php" class="nav-link px-3"><span class="me-2"><i class="bi bi-book-fill"></i></span><span>Show Trainer</span></a></li>
            <li><a href="ADMINaddclasses.php" class="nav-link px-3"><span class="me-2"><i class="bi bi-book-fill"></i></span><span>Add Classes</span></a></li>
            <li><a href="ADMINshowclasses.php" class="nav-link px-3"><span class="me-2"><i class="bi bi-book-fill"></i></span><span>Show Classes</span></a></li>
            <li class="my-4"><hr class="dropdown-divider bg-light" /></li>
          </ul>
        </nav>
      </div>
    </div>

    <main class="mt-5 pt-3">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12"><h4>Dashboard</h4></div>
        </div>

        <!-- Staff Table -->
        <div class="row">
          <div class="col-md-12 mb-3">
            <div class="card">
              <div class="card-header">
                <span><i class="bi bi-table me-2"></i></span> Staff Data Table
                <a href="ADMINaddstaff.php" class="btn btn-success float-end">ADD STAFF</a>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table id="staffTable" class="table table-striped data-table" style="width: 100%">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Mobile Number</th>
                        <th>Address</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Edit</th>
                        <th>Delete</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    if ($resultstaff && mysqli_num_rows($resultstaff) > 0) {
                      while($row = mysqli_fetch_assoc($resultstaff)) {
                        echo "<tr>
                          <td>{$row['id']}</td>
                          <td>{$row['FirstName']}</td>
                          <td>{$row['LastName']}</td>
                          <td>{$row['Mobilenumber']}</td>
                          <td>{$row['UserAddress']}</td>
                          <td>{$row['Email']}</td>
                          <td>{$row['Password']}</td>
                          <td><a href='updatestaffGUI.php?id={$row['id']}' class='btn btn-primary'>Edit</a></td>
                          <td><a href='deletestaff.php?id={$row['id']}' class='btn btn-danger'>Delete</a></td>
                        </tr>";
                      }
                    } else {
                      echo "<tr><td colspan='9'>No staff found.</td></tr>";
                    }
                    ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- User Table -->
        <div class="row">
          <div class="col-md-12 mb-3">
            <div class="card">
              <div class="card-header">
                <span><i class="bi bi-table me-2"></i></span> User Data Table
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table id="userTable" class="table table-striped data-table" style="width: 100%">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Edit</th>
                        <th>Delete</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    if ($resultuser && mysqli_num_rows($resultuser) > 0) {
                      while($row = mysqli_fetch_assoc($resultuser)) {
                        echo "<tr>
                          <td>{$row['id']}</td>
                          <td>{$row['username']}</td>
                          <td>{$row['email']}</td>
                          <td><a href='updateuserGUI.php?id={$row['id']}'class='btn btn-primary'>Edit</a></td>
                          <td><a href='deleteuser.php?id={$row['id']}' class='btn btn-danger'>Delete</a></td>
                        </tr>";
                      }
                    } else {
                      echo "<tr><td colspan='5'>No users found.</td></tr>";
                    }
                    ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Booking Table -->
        <div class="row">
          <div class="col-md-12 mb-3">
            <div class="card">
              <div class="card-header">
                <span><i class="bi bi-table me-2"></i></span> Booking Confirmation Table
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table id="bookingTable" class="table table-striped data-table" style="width: 100%">
                    <thead>
                      <tr>
                        <th>Booking ID</th>
                        <th>User Name</th>
                        <th>Email</th>
                        <th>Class Name</th>
                        <th>Schedule</th>
                        <th>Price</th>
                        <th>Delete</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    if ($result_booking && mysqli_num_rows($result_booking) > 0) {
                      while($row_booking = mysqli_fetch_assoc($result_booking)) {
                        echo "<tr>
                          <td>{$row_booking['id']}</td>
                          <td>{$row_booking['username']}</td>
                          <td>{$row_booking['email']}</td>
                          <td>{$row_booking['ClassName']}</td>
                          <td>{$row_booking['Schedule']}</td>
                          <td>LKR " . number_format($row_booking['Price'], 2) . "</td>
                          <td><a href='deletebooking.php?id={$row_booking['id']}' class='btn btn-danger'>Delete</a></td>
                        </tr>";
                      }
                    } else {
                      echo "<tr><td colspan='7'>No bookings found.</td></tr>";
                    }
                    ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </main>

    <!-- Bootstrap JS and dependencies -->
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/datatables.min.js"></script>
   
  </body>
</html>
