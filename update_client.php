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

    // Prepare and execute the update query
    $stmt = $conn->prepare("UPDATE dbo.Clients SET FullName = ?, Email = ?, PhoneNumber = ?, Address = ? WHERE ClientID = ?");
    $stmt->execute([$_POST['fullName'], $_POST['email'], $_POST['phoneNumber'], $_POST['address'], $_POST['clientID']]);

    echo "Client updated successfully!";
} catch (PDOException $e) {
    echo "Error: " . htmlspecialchars($e->getMessage());
}
?>
