<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Planners</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.html">Event Planners Inc.</a>
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
                        <a class="nav-link" href="events.php">Events</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <header class="bg-dark text-white text-center py-4">
        <h1>Meet Our Planners</h1>
        <p class="lead">Experienced professionals to bring your vision to life.</p>
    </header>

    <main class="container mt-4">
        <div class="row">
            <?php
            include 'db_connection.php';

            $query = "SELECT * FROM Planners";
            $stmt = $conn->query($query);

            while ($planner = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<div class='col-md-4 mb-4'>
                        <div class='card'>
                             <img src='{$planner['image_url']}' class='card-img-top' alt='Planner Image'>
                            <div class='card-body'>
                                <h5 class='card-title'>{$planner['FullName']}</h5>
                                <p class='card-text'>Specialization: {$planner['Specialization']}</p>
                                <p class='card-text'>Email: {$planner['Email']}</p>
                                <p class='card-text'>Phone: {$planner['PhoneNumber']}</p>
                            </div>
                        </div>
                    </div>";
            }
            ?>
        </div>
    </main>

    <footer class="bg-dark text-white text-center py-3 mt-5">
        <p>&copy; 2024 [Event Planners] All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

