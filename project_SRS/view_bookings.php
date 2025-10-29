<?php
include 'includes/db.php';
include 'includes/header.php';
?>

<main class="container">
  <h2 style="text-align:center; margin:20px 0; font-size:28px; color:#2c3e50;">Booking Details</h2>

  <table border="1" cellpadding="10" cellspacing="0" 
         style="width:100%; border-collapse: collapse; text-align:center; font-family:'Poppins', sans-serif;">
    <thead style="background:#007BFF; color:white;">
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Event Type</th>
        <th>Address</th>
        <th>Event Date</th>
        <th>Service</th>
        <th>Message</th>
      </tr>
    </thead>
    <tbody>
      <?php
      // Fetch all booking records
      $query = "SELECT * FROM bookings ORDER BY id DESC";
      $result = mysqli_query($conn, $query);

      if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          // Safety check in case of missing keys
          $eventType = isset($row['event_type']) ? $row['event_type'] : 'N/A';
          $address = isset($row['address']) ? $row['address'] : 'N/A';

          echo "<tr>
                  <td>{$row['id']}</td>
                  <td>{$row['name']}</td>
                  <td>{$row['email']}</td>
                  <td>{$row['phone']}</td>
                  <td>{$eventType}</td>
                  <td>{$address}</td>
                  <td>{$row['event_date']}</td>
                  <td>{$row['service']}</td>
                  <td>{$row['message']}</td>
                </tr>";
        }
      } else {
        echo "<tr><td colspan='9'>No bookings found</td></tr>";
      }
      ?>
    </tbody>
  </table>
</main>

<?php include 'includes/footer.php'; ?>
