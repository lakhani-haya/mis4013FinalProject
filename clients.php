<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clients</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
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
                        <a class="nav-link" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Planners</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Clients</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Events</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <header class="bg-dark text-white text-center py-4">
        <h1>Our Clients</h1>
        <p class="lead">A complete list of our valued clients.</p>
    </header>

    <main class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Clients List</h2>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#clientModal">Add New Client</button>
        </div>

        <!-- Clients Table -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Client ID</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Address</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
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

                    $query = "SELECT * FROM dbo.Clients";
                    $stmt = $conn->query($query);

                    while ($client = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>
                                <td>{$client['ClientID']}</td>
                                <td>{$client['FullName']}</td>
                                <td>{$client['Email']}</td>
                                <td>{$client['PhoneNumber']}</td>
                                <td>{$client['Address']}</td>
                                <td>
                                    <button class='btn btn-warning btn-sm edit-btn' data-id='{$client['ClientID']}' data-bs-toggle='modal' data-bs-target='#clientModal'>Edit</button>
                                    <button class='btn btn-danger btn-sm delete-btn' data-id='{$client['ClientID']}'>Delete</button>
                                </td>
                            </tr>";
                    }
                } catch (PDOException $e) {
                    echo "<tr><td colspan='6'>Error fetching clients: " . htmlspecialchars($e->getMessage()) . "</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </main>

    <!-- Modal -->
    <div class="modal fade" id="clientModal" tabindex="-1" aria-labelledby="clientModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="clientModalLabel">Add / Edit Client</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="clientForm">
                        <input type="hidden" id="clientID" name="clientID">
                        <div class="mb-3">
                            <label for="fullName" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="fullName" name="fullName" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="phoneNumber" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" required>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" name="address" required>
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

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const clientForm = document.getElementById('clientForm');
            const clientModal = new bootstrap.Modal(document.getElementById('clientModal'));

            document.querySelectorAll('.edit-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const clientID = this.dataset.id;
                    fetch(`get_client.php?id=${clientID}`)
                        .then(response => response.json())
                        .then(data => {
                            document.getElementById('clientID').value = data.ClientID;
                            document.getElementById('fullName').value = data.FullName;
                            document.getElementById('email').value = data.Email;
                            document.getElementById('phoneNumber').value = data.PhoneNumber;
                            document.getElementById('address').value = data.Address;

                            clientModal.show();
                        });
                });
            });

            document.querySelectorAll('.delete-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const clientID = this.dataset.id;

                    if (confirm('Are you sure you want to delete this client?')) {
                        fetch(`delete_client.php?id=${clientID}`)
                            .then(response => response.text())
                            .then(data => {
                                alert(data);
                                location.reload();
                            });
                    }
                });
            });

            clientForm.addEventListener('submit', function(event) {
                event.preventDefault();

                const formData = new FormData(clientForm);
                fetch(document.getElementById('clientID').value ? 'update_client.php' : 'add_client.php', {
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
