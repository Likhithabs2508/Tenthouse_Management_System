<?php
session_start();
if(!isset($_SESSION['admin_id'])){ header("Location: login.php"); exit; }
require_once '../includes/db.php';

$stats_res = $conn->query("SELECT status, COUNT(*) as cnt FROM bookings GROUP BY status");
$stats = [];
while($r = $stats_res->fetch_assoc()){ $stats[$r['status']] = (int)$r['cnt']; }
$bookings = $conn->query("SELECT * FROM bookings ORDER BY created_at DESC");
?>
<h2>Admin Dashboard</h2>
<a href="logout.php">Logout</a> | <a href="change_password.php">Change Password</a>
<canvas id="statusChart" width="400" height="150"></canvas>
<table border="1">
<tr><th>Name</th><th>Service</th><th>Date</th><th>Status</th><th>Action</th></tr>
<?php while($row=$bookings->fetch_assoc()){ ?>
<tr>
<td><?=$row['name']?></td>
<td><?=$row['service']?></td>
<td><?=$row['event_date']?></td>
<td><?=$row['status']?></td>
<td><a href="actions.php?action=accept&id=<?=$row['id']?>">Accept</a> | <a href="actions.php?action=reject&id=<?=$row['id']?>">Reject</a></td>
</tr>
<?php } ?>
</table>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const labels = <?php echo json_encode(array_keys($stats)); ?>;
const dataVals = <?php echo json_encode(array_values($stats)); ?>;
new Chart(document.getElementById('statusChart'), {
  type: 'bar',
  data: { labels, datasets: [{ label: 'Bookings', data: dataVals }] }
});
</script>
