<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Event Planners Inc.</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="planners.php">Planners</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="clients.php">Clients</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Events</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <header class="bg-dark text-white text-center py-4">
        <h1>Events Management</h1>
        <p class="lead">Manage all events in one place.</p>
    </header>

    <main class="container mt-4">
        <div id="calendar"></div>

        <div class="d-flex justify-content-between align-items-center mb-4 mt-5">
            <h2>Events List</h2>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#eventModal">Add New Event</button>
        </div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Event ID</th>
                    <th>Event Type</th>
                    <th>Event Date</th>
                    <th>Client ID</th>
                    <th>Planner ID</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
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

                    $query = "SELECT * FROM dbo.Events";
                    $stmt = $conn->query($query);

                    while ($event = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>
                                <td>{$event['EventID']}</td>
                                <td>{$event['EventType']}</td>
                                <td>{$event['EventDate']}</td>
                                <td>{$event['ClientID']}</td>
                                <td>{$event['PlannerID']}</td>
                                <td>
                                    <button class='btn btn-warning btn-sm edit-btn' data-id='{$event['EventID']}' data-bs-toggle='modal' data-bs-target='#eventModal'>Edit</button>
                                    <button class='btn btn-danger btn-sm delete-btn' data-id='{$event['EventID']}'>Delete</button>
                                </td>
                            </tr>";
                    }
                } catch (PDOException $e) {
                    echo "<tr><td colspan='6'>Error fetching events: " . htmlspecialchars($e->getMessage()) . "</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </main>

    <div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="eventModalLabel">Add / Edit Event</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="eventForm">
                        <input type="hidden" id="eventID" name="eventID">
                        <div class="mb-3">
                            <label for="eventType" class="form-label">Event Type</label>
                            <input type="text" class="form-control" id="eventType" name="eventType" required>
                        </div>
                        <div class="mb-3">
                            <label for="eventDate" class="form-label">Event Date</label>
                            <input type="date" class="form-control" id="eventDate" name="eventDate" required>
                        </div>
                        <div class="mb-3">
                            <label for="clientID" class="form-label">Client ID</label>
                            <input type="number" class="form-control" id="clientID" name="clientID" required>
                        </div>
                        <div class="mb-3">
                            <label for="plannerID" class="form-label">Planner ID</label>
                            <input type="number" class="form-control" id="plannerID" name="plannerID" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-dark text-white text-center py-3 mt-5">
        <p>&copy; 2024 Event Planners Inc. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendar = new FullCalendar.Calendar(document.getElementById('calendar'), {
                initialView: 'dayGridMonth',
                events: function(fetchInfo, successCallback, failureCallback) {
                    fetch('get_events.php')
                        .then(response => response.json())
                        .then(data => {
                            const events = data.map(event => ({
                                title: event.EventType,
                                start: event.EventDate,
                                description: event.Description
                            }));
                            successCallback(events);
                        })
                        .catch(failureCallback);
                },
                eventClick: function(info) {
                    alert('Event: ' + info.event.title + '\n' + info.event.start);
                }
            });

            calendar.render();

            const eventForm = document.getElementById('eventForm');
            const eventModal = new bootstrap.Modal(document.getElementById('eventModal'));

            document.querySelectorAll('.edit-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const eventID = this.dataset.id;
                    fetch('get_event.php?id=' + eventID)
                        .then(response => response.json())
                        .then(data => {
                            document.getElementById('eventID').value = data.EventID;
                            document.getElementById('eventType').value = data.EventType;
                            document.getElementById('eventDate').value = data.EventDate;
                            document.getElementById('clientID').value = data.ClientID;
                            document.getElementById('plannerID').value = data.PlannerID;

                            eventModal.show();
                        });
                });
            });

            document.querySelectorAll('.delete-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const eventID = this.dataset.id;

                    if (confirm('Are you sure you want to delete this event?')) {
                        fetch('delete_event.php?id=' + eventID)
                            .then(response => response.text())
                            .then(data => {
                                alert(data);
                                location.reload();
                            });
                    }
                });
            });

            eventForm.addEventListener('submit', function(event) {
                event.preventDefault();

                const formData = new FormData(eventForm);
                fetch(document.getElementById('eventID').value ? 'update_event.php' : 'add_event.php', {
                    method: 'POST',
                    body: formData
                })
                    .then(response => response.text())
                    .then(data => {
                        alert(data);
                        location.reload();
                    });
            });
        });
    </script>
</body>
</html>
