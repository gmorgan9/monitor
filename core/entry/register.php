<?php

require_once "../../app/database/connection.php";
require_once "../../app/database/functions.php";
require_once "../../path.php";

session_start();

if (isLoggedIn()) {
    header('Location: ' . BASE_URL . '/core/alerts/');
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>LogDetect | Register</title>

<!-- Custom Styles -->
<!-- <link rel="stylesheet" href="<?php //echo BASE_URL . '/assets/css/main-style.css?v='. time(); ?>"> -->

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

</head>
<body>

<?php include("../../app/includes/header.php"); ?>
   
<div class="container mt-5">
      <div class="row justify-content-center">
         <div class="col-md-6">
            <div class="card">
               <div class="card-body">
                  <h3 class="card-title">Login</h3>
                  <?php if (!empty($error)): ?>
                     <div class="alert alert-danger">
                        <?php foreach ($error as $errorMsg): ?>
                           <p><?php echo $errorMsg; ?></p>
                        <?php endforeach; ?>
                     </div>
                  <?php endif; ?>
                  <form action="" method="post">
                  <div class="mb-3">
                        <label for="firstname" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="firstname" name="firstname" required>
                     </div>
                     <div class="mb-3">
                        <label for="lastname" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="lastname" name="lastname" required>
                     </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                     </div>
                     <div class="mb-3">
                        <label for="uname" class="form-label">Username</label>
                        <input type="text" class="form-control" id="uname" name="uname" required>
                     </div>
                     <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                     </div>
                     <button name="register-btn" type="submit" class="btn btn-primary">Register</button>
                  </form>
                  <p class="mt-3">Have an account already? <a href="/core/entry/login.php">Login now</a></p>
               </div>
            </div>
         </div>
      </div>
   </div>

<?php //include("../../app/includes/footer.php"); ?>

</body>
</html>