<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Planners</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header class="bg-dark text-white text-center py-4">
        <h1>Meet Our Planners</h1>
        <p class="lead">Experienced professionals to bring your vision to life.</p>
    </header>

    <main class="container mt-4">
        <div class="row">
            <?php
            // Include the database connection file
            include 'db_connection.php';

            // Fetch data from the Planners table
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
        <p>&copy; 2024 [Event Planners Inc.] All rights reserved.</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
