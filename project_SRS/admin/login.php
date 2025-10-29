<?php
session_start();
require_once '../includes/db.php';

if(isset($_POST['login'])){
    $stmt = $conn->prepare("SELECT id, password FROM admins WHERE username=?");
    $stmt->bind_param("s", $_POST['username']);
    $stmt->execute();
    $stmt->bind_result($id, $hash);
    if($stmt->fetch() && password_verify($_POST['password'], $hash)){
        $_SESSION['admin_id'] = $id;
        header("Location: dashboard.php");
    } else $msg = "Invalid credentials!";
}
?>
<form method="POST">
  <h2>Admin Login</h2>
  <?php if(isset($msg)) echo "<p>$msg</p>"; ?>
  <input type="text" name="username" placeholder="Username" required>
  <input type="password" name="password" placeholder="Password" required>
  <button type="submit" name="login">Login</button>
</form>
