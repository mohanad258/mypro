<?php 
include_once('DB.php');

$title="Add";
$Name="";
$Email="";
$phoneNumber="";
$password="";
$Validity2="";
$btn_title="Save";

if(isset($_GET['action']) && $_GET['action']=='edit'){
    $id=$_GET['id'];
    $sql="SELECT * FROM users WHERE ID = ".$id;
    $user = mysqli_query($con, $sql);

    if($user){
        $title="Update";
        $current_user = $user->fetch_assoc();

        $Name = $current_user['UserName'];
        $Email = $current_user['email'];
        $phoneNumber = $current_user['phonnumber'];
        $password = $current_user['password'];
        $Validity2 = $current_user['Validity'];
        $btn_title = "Update";
    }
}
 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Users App</title>
</head>

<body>

    <div class="container">
        <div class="wrapper p-5 m-5">
            <div class="d-flex p-2 justify-content-between">
                <h2><?php echo $title; ?> user</h2>
                <div><a href="AddUser2.php"><i data-feather="corner-left-down"></i></a></div>
                <button type="button" class="btn btn-outline-primary"onclick="confirmRedirect2()">Back</button>
                <script>
                function confirmRedirect2() {
                    
                        $Name="";
                        $Email="";
                        $phoneNumber="";
                        $password="";
                        $Validity2="";
                        window.location.href = 'AddUser2.php';    
                    
                }
                </script>

            </div>
            <form action="AddUser2.php" method="post" onsubmit="return validateForm();">
               
                <div class="mb-3">
                     <input type="text" class="form-control" name="Name" value="<?php echo $Name; ?>" placeholder="Enter your name" required>
                </div>

                <div class="mb-3">
                     <input type="email" class="form-control" name="Email" value="<?php echo $Email; ?>" placeholder="Enter your email" required>
                </div>

                <div class="mb-3">
                     <select class="form-select" name="Val" required>
                        <option value="">Select User Permission</option>
                        <option value="admin" <?php echo ($Validity2 == 'admin') ? 'selected' : ''; ?>>admin</option>
                        <option value="user" <?php echo ($Validity2 == 'user') ? 'selected' : ''; ?>>user</option>
                        <option value="Employee" <?php echo ($Validity2 == 'Employee') ? 'selected' : ''; ?>>Employee</option>
                    </select>
                </div>

                <div class="mb-3">
                     <input type="password" class="form-control" id="password" name="password" value="<?php echo $password; ?>" placeholder="Enter your password" required onkeyup="checkPasswordMatch();">
                </div>
                
                <div class="mb-3">
                     <input type="password" class="form-control" id="confirm-password" name="password2" value="<?php echo $password; ?>" placeholder="Confirm your password" required onkeyup="checkPasswordMatch();">
                    <div id="password-message" style="color:red;"></div>
                </div>

                <div class="mb-3">
                     <input type="text" class="form-control" name="phoneNumber" value="<?php echo $phoneNumber; ?>" placeholder="Enter your phone number" required>
                </div>

                <?php if (isset($_GET['id'])) { ?>
                    <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
                <?php } ?>
                
                <input type="submit" class="btn btn-primary" value="<?php echo $btn_title; ?>" name="save">
                <button type="button" class="btn btn-danger" onclick="confirmRedirect()">Cancel</button>

                <script>
                function confirmRedirect() {
                    if (confirm("Are you sure you want to cancel?")) {
                        $Name="";
                        $Email="";
                        $phoneNumber="";
                        $password="";
                        $Validity2="";
                        window.location.href = 'AddUser2.php';    
                    }
                }
 
                function checkPasswordMatch() {
                    const password = document.getElementById('password').value;
                    const confirmPassword = document.getElementById('confirm-password').value;
                    const message = document.getElementById('password-message');

                    if (password !== confirmPassword) {
                        message.innerHTML = "Passwords do not match!";
                    } else {
                        message.innerHTML = "";
                    }
                }

                function validateForm() {
                    const password = document.getElementById('password').value;
                    const confirmPassword = document.getElementById('confirm-password').value;

                    if (password !== confirmPassword) {
                        alert("Passwords do not match!");
                        return false;
                    }
                    return true;
                }
                </script>
            </form>
        </div>
    </div>

    <script src="js/bootstrap.min.js"></script>
    <script src="js/icons.js"></script>
    <script>
        feather.replace();
    </script>
</body>

</html>