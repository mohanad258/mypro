<?php
$db = new mysqli('localhost', 'root', '', 'messageauthentication');
$action = false;

   $Name = "";
   $Email = "";
   $phoneNumber = "";
   $password = "";
   $Validity2 = "";

 if (isset($_POST['save'])) {

    $name1 = trim($_POST['Name']);
    $email = trim($_POST['Email']);
    $Validity2 = trim($_POST['Val']);
    $password = trim($_POST['password']);
    $password2 = trim($_POST['password2']);
    $phoneNumber = trim($_POST['phoneNumber']);
    $password_sha1 = sha1($password);
    
    if ($Validity2 == 'admin' || $Validity2 == 'Employee' || $Validity2 == 'user') {
        // تأكد من أن الاتصال ناجح
        if ($db->connect_error) {
            die("فشل الاتصال: " . $db->connect_error);
        }
        
        // تحقق مما إذا كان البريد الإلكتروني موجودًا
        $q1 = "SELECT * FROM users WHERE email='$email'";
        $r1 = $db->query($q1);
        $no = $r1->num_rows;

        if ($no > 0) {
            echo "هذا البريد الإلكتروني موجود بالفعل.";
        } else {
            // إذا لم يكن البريد الإلكتروني موجودًا، قم بإضافة المستخدم الجديد
            $q = "INSERT INTO `users` (`UserName`, `password`, `Validity`, `email`, `phonnumber`) VALUES ('$name1', '$password_sha1', '$Validity2', '$email', '$phoneNumber')";
            $r = $db->query($q);
            
            if ($r) {
                $action = true; // وضع علامة النجاح
                echo "تمت الإضافة بنجاح.";
            } else {
                echo "خطأ في الإدخال: " . $db->error;  
            }
        }
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
    <script>
        function show_message() {
            document.getElementsByName("Name")[0].value = "";
            document.getElementsByName("Email")[0].value = "";
            document.getElementsByName("Val")[0].selectedIndex = 0; // إعادة تعيين القائمة المنسدلة
            document.getElementsByName("phoneNumber")[0].value = "";
            window.location.href="signup-success.html";
         }
    </script>
</head>
<body>
    <div class="container">
        <div class="wrapper p-5 m-5">
            <div class="d-flex p-2 justify-content-between">
                <h2>Add User</h2>
            </div>
            <form action="" method="post" onsubmit="return validateForm();">
                <div class="mb-3">
                    <input type="text" class="form-control" name="Name" value="<?php echo $Name; ?>" placeholder="Enter your name" required>
                </div>
                <div class="mb-3">
                    <input type="email" class="form-control" name="Email" value="<?php echo $Email; ?>" placeholder="Enter your email" required>
                </div>
                <div class="mb-3">
                    <select class="form-select" name="Val" required>
                        <option value="">Select User Permission</option>
                        <option value="admin">admin</option>
                        <option value="user">user</option>
                        <option value="Employee">Employee</option>
                    </select>
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required onkeyup="checkPasswordMatch();">
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" id="confirm-password" name="password2" placeholder="Confirm your password" required onkeyup="checkPasswordMatch();">
                    <div id="password-message" style="color:red;"></div>
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control" name="phoneNumber" value="<?php echo $phoneNumber; ?>" placeholder="Enter your phone number" required>
                </div>
                
                <input type="submit" class="btn btn-primary" value="Save" name="save">
                <button type="button" class="btn btn-danger" onclick="confirmRedirect()">Cancel</button>

                <script>
                    function confirmRedirect() {
                        if (confirm("Are you sure you want to cancel?")) {
                            window.location.href = 'Home.php';    
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
    <script src="js/main.js"></script>

    <script>
    <?php
    // استدعاء الدالة JavaScript عند نجاح الإدخال
    if ($action) { ?>
        show_message(); // استدعاء دالة JavaScript
    <?php } ?>
    </script>
</body>
</html>