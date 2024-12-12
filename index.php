<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Planning Company</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
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
                    <a class="nav-link" href="index.html">Home</a>
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
        <h1>Welcome to The Event-uals!</h1>
        <p class="lead">Your trusted partner for unforgettable events.</p>
    </header>

    <main class="container mt-4">
        <!-- About Us Section -->
        <section class="mb-5 text-center">
            <h2>About Us</h2>
            <p class="mt-3">
                At [Event Planners Inc.], we specialize in creating memorable events tailored to your unique needs. 
                Whether it's a birthday, anniversary, or engagement party, our experienced team ensures your celebration is perfect.
            </p>
        </section>

        <!-- Event Types Carousel -->
        <section>
            <h2 class="text-center mb-4">Our Event Types</h2>
            <div id="eventCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="https://images.ctfassets.net/3dar4x4x74wk/5PHkzNDpBYPd4xBrxEHSd7/7cd51db72c48c791a4859b7052b3296d/Delux_Tablescape_130.jpg?w=808" class="d-block w-100" alt="Birthday Party">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Birthday Parties</h5>
                            <p>Celebrate with style and joy.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="https://blissfulplans.com/wp-content/uploads/2020/06/25th-wedding-anniversary.jpg.webp" class="d-block w-100" alt="Anniversary Party">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Anniversary Celebrations</h5>
                            <p>Honor your milestones with elegance.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="https://images.pexels.com/photos/29723872/pexels-photo-29723872/free-photo-of-black-and-white-engagement-ring-exchange.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" class="d-block w-100" alt="Engagement Party">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Engagement Parties</h5>
                            <p>Start your journey with a memorable celebration.</p>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#eventCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#eventCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </section>
    </main>

    <footer class="bg-dark text-white text-center py-3 mt-5">
        <p>&copy; 2024 [Event Planners Inc.] All rights reserved.</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
