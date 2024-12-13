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

   
    $stmt = $conn->prepare("UPDATE dbo.Events SET EventType = ?, EventDate = ?, ClientID = ?, PlannerID = ? WHERE EventID = ?");
    $stmt->execute([$_POST['eventType'], $_POST['eventDate'], $_POST['clientID'], $_POST['plannerID'], $_POST['eventID']]);

    echo "Event updated successfully!";
} catch (PDOException $e) {
    echo "Error: " . htmlspecialchars($e->getMessage());
}
?>
