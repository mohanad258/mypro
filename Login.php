<?php
include_once('DB.php'); // تضمين ملف الاتصال بقاعدة البيانات

if (isset($_POST['save'])) {
    // استلام المدخلات من النموذج
    $name1 = $_POST['Name'];
    $password = $_POST['password'];
    $password_sha1 = sha1($password); // تشفير كلمة المرور باستخدام SHA1

   echo $name1.''. $password ;
    // استعلام للتحقق من وجود المستخدم بناءً على كلمة المرور
    $q1 = "SELECT * FROM users WHERE password='$password_sha1'";
    $r1 = $con->query($q1); // تنفيذ الاستعلام
    $no = $r1->num_rows; // عدد النتائج الناتجة

    if ($no > 0) {
        // إذا كان هناك مستخدمين موجودين
      //  echo "<select>"; // بدء قائمة الخيارات
        for ($i = 0; $i < $no; $i++) {
            $rec = $r1->fetch_assoc(); // جلب السجل
            // طباعة خيار في القائمة
            $Valid=$rec['Validity'];
             if($Valid=='admin')
             {
              header('Location: AddUser2.php');
             exit(); // تأكد من إنهاء السكربت بعد إعادة التوجيه
             }
             elseif($Valid=='Employee')
             {
                header('Location: Staff.php');
                exit(); // تأكد من إنهاء السكربت بعد إعادة التوجيه
             }
             else
             {
                header('Location: user.php');
                exit(); // تأكد من إنهاء السكربت بعد إعادة التوجيه
             }
            //echo "<option value=\"" . htmlspecialchars($rec['Validity']) . "\">" . htmlspecialchars($rec['Validity']) . "</option>";
        }
       // echo "</select>"; // إنهاء قائمة الخيارات
    } else {
        // إذا لم يكن هناك مستخدمون
        echo "غير موجود";
    }
}

?>
 