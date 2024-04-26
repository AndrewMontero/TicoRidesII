<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '../shared/header.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '../actions/dashboard_action.php');

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    $username = "no carga";
}
?>

<body>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
                <img src="../images/logo.png" class="img" alt="Fines Ilustrativos">
                <div class="card">
                    <div class="row align-items-start ml-1">
                        <div class="col">
                            <a href="dashboard.php" class="buttonmain">Dashboard</a>
                        </div>
                        <div class="col">
                            <a href="add.php" class="buttonmain">Rides</a>
                        </div>
                        <div class="col">
                            <a href="settings.php" class="buttonmain">Settings</a>
                        </div>
                    </div>
                </div>
                <div class="welcome-user">
                    <span>Welcome</span>
                    <a class="username"><?php echo $username; ?></a>
                    <img src="../images/user.png" alt="User Icon" class="user-icon">
                    <h2 class="title">Dashboard</h2>
                </div>
                <div class="dashboard-link">
                    <a href="#">Dashboard</a>
                    <span class="arrow">></span>
                </div>
                <p class="title">My Rides</p>
                <div class="card">
                    <div class="card-body">
                        <p class="title">Your current list of Rides</p>
                        <div class="buttonplus" onclick="location.href='../pages/add.php'">
                            <div class="plus horizontal"></div>
                            <div class="plus vertical"></div>
                        </div>
                        <?php if (isset($message)) : ?>
                            <div class="alert <?php echo isset($success) ? 'alert-success' : 'alert-danger'; ?>" role="alert">
                                <?php echo $message; ?>
                            </div>
                        <?php endif; ?>
                        <div class="table">
                            <div class="row align-items-start ml-3">
                                <div class="col">
                                    Name
                                </div>
                                <div class="col">
                                    Start
                                </div>
                                <div class="col">
                                    End
                                </div>
                                <div class="col">
                                    Actions
                                </div>
                            </div>
                            <?php
                            foreach ($rides as $ride) {
                                echo "<div class='row align-items-start ml-3'>";
                                echo "<div class='col'>" . $ride['ride_name'] . "</div>";
                                echo "<div class='col'>" . $ride['start_from'] . "</div>";
                                echo "<div class='col'>" . $ride['end_to'] . "</div>";
                                echo "<div class='col'>";
                                echo "<a href='edit.php?id=" . $ride['id'] . "' class='button'>Edit -</a>";
                                echo "<a href='?delete_id=" . $ride['id'] . "' class='button'>Delete</a>";
                                echo "</div>";
                                echo "</div>";
                            }
                            ?>
                        </div>
                    </div>
                    <div class="buttonplus2" onclick="location.href='../pages/add.php'">
                        <div class="plus horizontal"></div>
                        <div class="plus vertical"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
