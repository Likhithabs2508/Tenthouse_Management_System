<?php include 'includes/header.php'; ?>
<?php include 'includes/db.php'; ?>


<main class="container">
  <section id="book">
    <h2 style="text-align:center; margin:20px 0;">Book Your Tent / Event</h2>

    <form method="POST" style="max-width:600px; margin:auto; background:#fff; padding:20px; border-radius:10px; box-shadow:0 0 10px rgba(0,0,0,0.1);">
      <input type="text" name="name" placeholder="Full Name" required style="width:100%; margin:10px 0; padding:10px;">
      <input type="email" name="email" placeholder="Email" required style="width:100%; margin:10px 0; padding:10px;">
      <input type="text" name="phone" placeholder="Phone Number" required style="width:100%; margin:10px 0; padding:10px;">
      <input type="date" name="event_date" required style="width:100%; margin:10px 0; padding:10px;">

      <!-- New Field: Event Type -->
      <input type="text" name="event_type" placeholder="Event Type (e.g. Wedding, Birthday, Function)" required style="width:100%; margin:10px 0; padding:10px;">

      <select name="service" required style="width:100%; margin:10px 0; padding:10px;">
        <option value="">-- Select Service --</option>
        <option value="Tent">Tent</option>
        <option value="Lighting">Lighting</option>
        <option value="Decoration">Decoration</option>
        <option value="Catering">Catering</option>
        <option value="Full Event Setup">Full Event Setup</option>
      </select>

      <!-- New Field: Address -->
      <textarea name="address" placeholder="Event Address" rows="3" required style="width:100%; margin:10px 0; padding:10px;"></textarea>

      <textarea name="message" placeholder="Additional Message (optional)" rows="3" style="width:100%; margin:10px 0; padding:10px;"></textarea>

      <button type="submit" name="book" style="background:#007BFF; color:white; border:none; padding:10px 20px; border-radius:5px; cursor:pointer; width:100%;">Submit</button>
    </form>

    <?php
    if (isset($_POST['book'])) {
        require_once 'includes/config.php';

        $stmt = $conn->prepare("INSERT INTO bookings (name, email, phone, event_date, service, event_type, address, message)
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssss",
            $_POST['name'],
            $_POST['email'],
            $_POST['phone'],
            $_POST['event_date'],
            $_POST['service'],
            $_POST['event_type'],
            $_POST['address'],
            $_POST['message']
        );

        if ($stmt->execute()) {
            echo "<p style='color:green; text-align:center; margin-top:10px;'>🎉 Booking successful! We'll contact you soon.</p>";
        } else {
            echo "<p style='color:red; text-align:center; margin-top:10px;'>⚠️ Error! Please try again later.</p>";
        }
    }
    ?>
  </section>
</main>

<?php include 'includes/footer.php'; ?>
