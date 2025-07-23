<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <style>
    body {
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
      height: 100vh;
      font-size: 20px;
      font-family: Arial, sans-serif;
      background-color: #f5f5f5;
    }

    form {
      background-color: white;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      width: 300px;
      margin-bottom: 20px;
    }

    input[type="text"],
    input[type="number"] {
      width: 100%;
      padding: 10px;
      margin: 10px 0;
      font-size: 18px;
    }

    input[type="submit"] {
      padding: 10px 20px;
      font-size: 18px;
      background-color: #4CAF50;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    .message {
      background-color: #e1f5e1;
      padding: 15px;
      border-radius: 10px;
      color: green;
    }

    .error {
      background-color: #fce4e4;
      padding: 15px;
      border-radius: 10px;
      color: red;
    }
  </style>
</head>
<body>

  <form action="" method="POST">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required placeholder="ادخل اسمك">

    <label for="age">Age:</label>
    <input type="number" id="age" name="age" required placeholder="ادخل عمرك">

    <input type="submit" value="Submit">
  </form>

  <?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // استقبال البيانات
    $name = htmlspecialchars($_POST['name']);
    $age = htmlspecialchars($_POST['age']);

    // الاتصال بقاعدة البيانات
    $conn = new mysqli("localhost", "root", "", "users_database");

    if ($conn->connect_error) {
      echo "<div class='error'>❌ فشل الاتصال بقاعدة البيانات: " . $conn->connect_error . "</div>";
    } else {
      // تنفيذ الإدخال
      $stmt = $conn->prepare("INSERT INTO user_table (name, age) VALUES (?, ?)");
      $stmt->bind_param("si", $name, $age); // s = string, i = integer

      if ($stmt->execute()) {
        echo "<div class='message'>✅ مرحبًا <strong>$name</strong>، عمرك <strong>$age</strong> سنة .</div>";
      } else {
        echo "<div class='error'>❌ خطأ في الحفظ: " . $stmt->error . "</div>";
      }

      $stmt->close();
      $conn->close();
    }
  }
  ?>

</body>
</html>

