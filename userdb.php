<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "users_database"; // تأكد من الاسم

// إنشاء الاتصال
$conn = new mysqli($servername, $username, $password, $dbname);

// التحقق من الاتصال
if ($conn->connect_error) {
  die("فشل الاتصال: " . $conn->connect_error);
}

// استقبال البيانات من النموذج
$name = $_POST['name'];
$age = $_POST['age'];

// استعلام الإدخال
$sql = "INSERT INTO user_table (name, age) VALUES ('$name', '$age')";

if ($conn->query($sql) === TRUE) {
  echo "✅ تم حفظ البيانات بنجاح!";
} else {
  echo "❌ خطأ: " . $conn->error;
}

$conn->close();
?>
