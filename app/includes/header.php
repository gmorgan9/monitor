<!-- WORKING -->

<?php
$uid = $_SESSION['uid'];
$select = " SELECT * FROM users WHERE user_id = '$uid' ";
$result = mysqli_query($conn, $select);
if (mysqli_num_rows($result) > 0) {
   while($row = mysqli_fetch_assoc($result)) {
    $fname = $row['firstname'];
}}
?>



<!--Main Navigation-->
<header>
<!-- Navbar -->
    <?php //if(isset($_SESSION['fname'])){ ?>
        <!-- <nav id="main-navbar" class="navbar navbar-expand-lg navbar-light bg-white fixed-top"> -->
    <?php //} else { ?>
        <nav id="main-navbar" class="navbar navbar-expand-lg navbar-dark bg-black">
    <?php //}?>
      <!-- Container wrapper -->
    <div class="container">

<!-- Brand -->
        <a class="navbar-brand" href="/">
            <h3><i class="bi bi-fingerprint"></i> LogDetect</h3>
        </a>

        <ul class="navbar-nav ms-auto d-flex flex-row">
            <?php if(isset($_SESSION['fname'])){ ?>
            <?php //if($row['acc_type'] == 1){ ?>
                <!-- <li class="nav-item"><a class="nav-link me-3 me-lg-0">Welcome, <span style="text-transform: capitalize;"><?php echo $fname; ?></span>!</a></li> -->
                <li class="nav-item"><a class="nav-link me-3 me-lg-0" href="/">Home</a></li>
                <li class="nav-item"><a class="nav-link me-3 me-lg-0" href="/alerts.php">Alerts</a></li>
                <!-- <li class="nav-item"><a class="nav-link me-3 me-lg-0" href="<?php //echo BASE_URL . '/admin/profile.php' ?>"><i class="bi bi-person"></i>  Profile</a></li> -->
                <li class="nav-item"><a class="nav-link me-3 me-lg-0" href="<?php echo BASE_URL . '/logout.php' ?>">Logout</a></li>
            <?php } else { ?>
                <li class="nav-item"><a class="nav-link me-3 me-lg-0" href="/">Home</a></li>
                <li class="nav-item"><a class="nav-link me-3 me-lg-0" href="/alerts.php">Alerts</a></li>
                <li class="nav-item"><a class="nav-link me-3 me-lg-0" href="<?php echo BASE_URL . '/core/entry/login.php' ?>">Login</a></li>
            <?php } ?>
        </ul>
    </div>
<!-- Container wrapper -->
</nav>
<!-- Navbar -->
</header>
<!--End Main Navigation-->
<!--Main layout-->
<!-- <main style="margin-top: 58px;">
  <div class="container pt-4"></div>
</main> -->
<!--Main layout-->
<?php  ?>