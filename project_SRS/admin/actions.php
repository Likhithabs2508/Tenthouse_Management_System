<?php
session_start();
if(!isset($_SESSION['admin_id'])){ header("Location: login.php"); exit; }
require_once '../includes/db.php';
$id = $_GET['id']; $action = $_GET['action'];
if($action=='accept') $conn->query("UPDATE bookings SET status='Accepted' WHERE id=$id");
elseif($action=='reject') $conn->query("UPDATE bookings SET status='Rejected' WHERE id=$id");
elseif($action=='delete') $conn->query("DELETE FROM bookings WHERE id=$id");
header("Location: dashboard.php");
?>
