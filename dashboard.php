<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="sthyles/dashboard.css">
    <title>Tico Rides</title>
</head>

<body>
    <!-- Container for the dashboard -->
    <div class="container">
        <!-- Row to center content -->
        <div class="row justify-content-center mt-5">
            <!-- Column for main content -->
            <div class="col-md-8">
                <!-- Logo -->
                <img src="images/logo.png" class="img" alt="Illustrative Purposes">
                <!-- Navigation links -->
                <div class="card">
                    <div class="row align-items-start ml-1">
                        <div class="col">
                            <a href="dashboard.html" class="buttonmain">Dashboard</a>
                        </div>
                        <div class="col">
                            <a href="rides.html" class="buttonmain">Rides</a>
                        </div>
                        <div class="col">
                            <a href="settings.html" class="buttonmain">Settings</a>
                        </div>
                    </div>
                </div>
                <!-- Welcome message -->
                <div class="welcome-user">
                    <span>Welcome</span>
                    <a class="username" href="#" id="userLink"><?php echo isset($_GET['username_login']) ? $_GET['username_login'] : ''; ?></a> <!-- Changed to update dynamically -->
                    <img src="images/user.png" class="img" alt="user-logo">
                    <h2 class="title">Dashboard</h2>
                </div>
                <!-- Dashboard links -->
                <div class="dashboard-link">
                    <a href="#">Dashboard</a>
                    <span class="arrow">&gt;</span>
                </div>
                <!-- Title for the rides section -->
                <p class="title">My Rides</p>
                <!-- Card to display ride information -->
                <div class="card">
                    <div class="card-body">
                        <p class="title">Your current list of Rides</p>
                        <!-- Button to add a new ride -->
                        <div class="buttonplus" onclick="location.href='add.html'">
                            <div class="plus horizontal"></div>
                            <div class="plus vertical"></div>
                        </div>
                        <!-- Table to display ride details -->
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Start</th>
                                        <th>End</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Sample ride entry -->
                                    <tr>
                                        <td>Brete</td>
                                        <td>Barrio Los Angeles</td>
                                        <td>Ciudad Quesada</td>
                                        <td>
                                            <a href="#" class="button">Edit -</a>
                                            <a href="#" class="button">Delete</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- Button to add a new ride -->
                        <div class="buttonplus2" onclick="location.href='add.html'">
                            <div class="plus horizontal"></div>
                            <div class="plus vertical"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript to get username from URL parameter and update the welcome message -->
    <script>
        // Function to get query parameters from URL
        function getUrlParameter(name) {
            name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
            var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
            var results = regex.exec(location.search);
            return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
        };

        // Get username from URL parameter
        var username = getUrlParameter('username_login');

        // Update the username link
        document.getElementById("userLink").innerText = username;
    </script>
</body>

</html>