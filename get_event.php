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


header('Content-Type: application/json');

try {
    $conn = new PDO("sqlsrv:server=$serverName;Database=eventplan", $connectionOptions['UID'], $connectionOptions['pwd']);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_GET['id'])) {
        
        $stmt = $conn->prepare("SELECT * FROM dbo.Events WHERE EventID = ?");
        $stmt->execute([$_GET['id']]);
        $event = $stmt->fetch(PDO::FETCH_ASSOC);
        
        echo json_encode($event);
    } else {
       
        $stmt = $conn->query("SELECT EventID, EventType, EventDate FROM dbo.Events");
        $events = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $events[] = [
                'title' => $row['EventType'],
                'start' => $row['EventDate'],  // Assuming EventDate is in a compatible format
                'eventID' => $row['EventID']
            ];
        }

        echo json_encode($events);
    }
} catch (PDOException $e) {
    echo json_encode(['error' => 'Error fetching event data: ' . htmlspecialchars($e->getMessage())]);
}

