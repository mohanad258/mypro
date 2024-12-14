 
 <?php
include_once('DB.php');
$action = false;
if (isset($_POST['save'])) {

    $name1 = trim($_POST['Name']);
    $email = trim($_POST['Email']);
    $Validity2 = trim($_POST['Val']);
    $password = trim($_POST['password']);
    $password2 = trim($_POST['password2']);
    $phoneNumber = trim($_POST['phoneNumber']);
    $password_sha1 = sha1($password);

  if ($_POST['save'] == "Save") {

    $save_sql = "INSERT INTO `users` (`UserName`, `password`, `Validity`, `email`, `phonnumber`) VALUES
    ('$name1', '$password_sha1', '$Validity2', '$email', '$phoneNumber')";
  }
  else
  {
    
$id= $_POST['id'] ;
$save_sql = "UPDATE `users` SET `UserName`='$name1', `password`='$password_sha1', `Validity`='$Validity2', 
`email`='$email', `phonnumber`='$phoneNumber' WHERE ID = $id";
  }
  $res_save = mysqli_query($con, $save_sql);
  if (!$res_save) {
    die(mysqli_error($con));
   }
   else {
    if (isset($_POST['id'])){
      $action = "edit";
    }else{
      $action = "add";
    }

  }

}
if (isset($_GET['action']) && $_GET['action'] == 'del') {
  $id = $_GET['id'];
  $del_sql = "DELETE FROM users WHERE id = $id";
  $res_del = mysqli_query($con, $del_sql);
  if (!$res_del) {
    die(mysqli_error($con));

  } else {
    $action = "del";
  }
}
 
$users_sql = "SELECT * FROM users";
$all_user = mysqli_query($con, $users_sql);



?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/toster.css">
  <title>Users App</title>
</head>

<body>
  <div class="container">
    <div class="wrapper p-5 m-5">
      <div class="d-flex p-2 justify-content-between mb-2">
        <h2>All users</h2>
         <div><a href="InsertUser.php"><i data-feather="user-plus"></i></a></div>

      </div>
      <hr>
      <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">User Name</th>   
      <th scope="col">Validity</th>
      <th scope="col">email</th>
      <th scope="col">phon number</th>
      <th scope="col">Action</th>
    </tr>
   </thead>

   <tbody>
          <?php
           while ($user = $all_user->fetch_assoc()) { ?>
 
            <tr>
            <td>
                <?php echo $user['ID']; ?>
              </td>
              <td>
                <?php echo $user['UserName']; ?>
              </td>
              <td>
                <?php echo $user['Validity']; ?>
              </td>
              <td>
                <?php echo $user['email']; ?>
              </td>
            
              <td>
                <?php echo $user['phonnumber']; ?>
              </td>

              <td>
                <div class="d-flex p-2 justify-content-between mb-2">
                <i onclick="confirm_delete(<?php echo $user['ID']; ?>);" class="text-danger" data-feather="trash-2"></i>
                <i onclick="edit(<?php echo $user['ID']; ?>);" class="text-success" data-feather="edit"></i>
                </div>
              </td>
            </tr>
          <?php }

          ?>

        </tbody>

        </table>
    </div>

  </div>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/icon.js"></script>
    <script src="js/toastr.js"></script>
     <script src="js/main.js"></script>
     <script src="js/clear.js"></script>
     <script src="js/main2.js" defer type="module"></script>

    <?php
  if ($action != false) {
    if ($action == 'add') { ?>
      <script>
        show_add()
      </script>
      <?php
    }
    if ($action == 'del') { ?>
      <script>
        show_del()
      </script>


      <?php
    }
    if ($action == 'edit') { ?>
      <script>
        show_update()
      </script>


      <?php
    }
  }
  ?>
  <script>
    feather.replace();
  </script>
</body>

</html>
