<?php

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

    
    $stmt = $conn->prepare("INSERT INTO dbo.Events (EventType, EventDate, ClientID, PlannerID) VALUES (?, ?, ?, ?)");
    $stmt->execute([$_POST['eventType'], $_POST['eventDate'], $_POST['clientID'], $_POST['plannerID']]);

    echo "Event added successfully!";
} catch (PDOException $e) {
    echo "Error: " . htmlspecialchars($e->getMessage());
}
?>
