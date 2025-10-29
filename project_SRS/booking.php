<?php
include 'includes/config.php';
include 'includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $service = $_POST['service'];
    $event_date = $_POST['event_date'];
    $message = $_POST['message'];

    $stmt = $conn->prepare("INSERT INTO bookings(name, email, phone, service, event_date, message, status) VALUES (?, ?, ?, ?, ?, ?, 'pending')");
    $stmt->bind_param("ssssss", $name, $email, $phone, $service, $event_date, $message);
    $stmt->execute();

    // Email notification
    $subject = "New Tent Booking from $name";
    $body = "Name: $name\nEmail: $email\nPhone: $phone\nService: $service\nEvent Date: $event_date\nMessage: $message";
    mail(ADMIN_EMAIL, $subject, $body);

    echo "<script>alert('Booking submitted successfully!'); window.location='index.php';</script>";
}
?>

<?php include 'includes/header.php'; ?>

<h2>Book Your Tent</h2>
<form method="POST" class="booking-form">
  <input type="text" name="name" placeholder="Your Name" required>
  <input type="email" name="email" placeholder="Your Email" required>
  <input type="text" name="phone" placeholder="Phone Number" required>
  <select name="service" required>
    <option value="">Select Service</option>
    <option value="Luxury Tent">Luxury Tent</option>
    <option value="Event Decoration">Event Decoration</option>
    <option value="Lighting & Sound">Lighting & Sound</option>
  </select>
  <input type="date" name="event_date" required>
  <textarea name="message" placeholder="Additional Details"></textarea>
  <button type="submit" class="btn">Submit Booking</button>
</form>

<?php include 'includes/footer.php'; ?>
