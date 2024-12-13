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

    // Prepare and execute the delete query
    $stmt = $conn->prepare("DELETE FROM dbo.Clients WHERE ClientID = ?");
    $stmt->execute([$_GET['id']]);

    echo "Client deleted successfully!";
} catch (PDOException $e) {
    echo "Error: " . htmlspecialchars($e->getMessage());
}
?>
