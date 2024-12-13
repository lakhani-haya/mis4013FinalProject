<?php
// Database connection configuration
$serverName = "tcp:event-mgmt-server.database.windows.net,1433";
$connectionOptions = array(
    "UID" => "haya",
    "pwd" => "Database100",
    "Database" => "eventplan",
    "LoginTimeout" => 30,
    "Encrypt" => 1,
    "TrustServerCertificate" => 0
);

try {
    $conn = new PDO("sqlsrv:server=$serverName;Database=eventplan", $connectionOptions['UID'], $connectionOptions['pwd']);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepare and execute the select query
    $stmt = $conn->prepare("SELECT * FROM dbo.Events WHERE EventID = ?");
    $stmt->execute([$_GET['id']]);
    $event = $stmt->fetch(PDO::FETCH_ASSOC);

    echo json_encode($event);
} catch (PDOException $e) {
    echo "Error: " . htmlspecialchars($e->getMessage());
}
?>
