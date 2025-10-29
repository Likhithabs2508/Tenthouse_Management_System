<?php
$host="localhost"; $user="root"; $pass="";
$conn = new mysqli($host, $user, $pass);
$conn->query("CREATE DATABASE IF NOT EXISTS tent_house_db");
$conn->select_db("tent_house_db");

$conn->query("CREATE TABLE IF NOT EXISTS bookings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100),
    phone VARCHAR(20),
    event_date DATE,
    service VARCHAR(50),
    message TEXT,
    status VARCHAR(20) DEFAULT 'Pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");

$conn->query("CREATE TABLE IF NOT EXISTS admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50),
    password VARCHAR(255)
)");

$check = $conn->query("SELECT * FROM admins WHERE username='admin'");
if($check->num_rows==0){
    $hash = password_hash('admin123', PASSWORD_DEFAULT);
    $conn->query("INSERT INTO admins(username, password) VALUES('admin', '$hash')");
}
echo "✅ Database setup complete. Admin: admin / admin123";
?>
