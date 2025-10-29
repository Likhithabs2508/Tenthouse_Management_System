<?php
session_start();
if(!isset($_SESSION['admin_id'])){ header("Location: login.php"); exit; }
require_once '../includes/db.php';
if($_SERVER['REQUEST_METHOD']=='POST'){
    $c=$_POST['current']; $n=$_POST['new'];
    $stmt=$conn->prepare("SELECT password FROM admins WHERE id=?");
    $stmt->bind_param("i",$_SESSION['admin_id']); $stmt->execute(); $stmt->bind_result($hash); $stmt->fetch();
    if(password_verify($c,$hash)){
        $newhash=password_hash($n,PASSWORD_DEFAULT);
        $conn->query("UPDATE admins SET password='$newhash' WHERE id=".$_SESSION['admin_id']);
        echo "<p>Password changed!</p>";
    } else echo "<p>Wrong current password!</p>";
}
?>
<form method="POST">
<input type="password" name="current" placeholder="Current" required>
<input type="password" name="new" placeholder="New" required>
<button type="submit">Change</button>
</form>
