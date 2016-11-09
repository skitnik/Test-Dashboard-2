<!DOCTYPE html>
<html>
    <head>
        <title>CMS</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="includes/css/font-awesome.css"/>
        <link rel="stylesheet" type="text/css" href="includes/css/bootstrap.min.css"/>
        <link rel="stylesheet" type="text/css" href="includes/css/style.css"/>
        <script src="includes/js/jquery.js"></script>
        <script src="includes/js/bootstrap.min.js"></script>
    </head>
    <body>
        <section id="nav">
            <nav class="navbar navbar-fixed-top navbar-inverse">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>                        
                        </button>
                        <a class="navbar-brand" href="#">CMS</a>
                    </div>
                    <div class="collapse navbar-collapse" id="myNavbar">
                        <ul class="nav navbar-nav">
                            <?php
                            if (isset($_SESSION['loggedIn'])) {
                                echo '<li><a href="index.php?type=user&action=profile">Profile</a></li>';
                                echo '<li><a href="index.php?type=content&action=index">Content</a></li>';
                                echo '<li><a href="index.php?type=user&action=history">History</a></li>';
                            }
                            ?>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <?php
                            if (isset($_SESSION['loggedIn'])) {

                                // NEED TO CALL THAT SOME OTHER PLACE
                                $userId = $_SESSION['userId'];
                                $db = Database::getInstance();
                                $result = $db->selectQuery("SELECT * FROM users WHERE id ='$userId'");
                                $userFName = ucfirst($result[0]['first_name']);
                                echo '<li><a href="index.php?type=user&action=profile"><span>Hello ' . $userFName . ' </span></a></li>';
                                echo '<li><a href="index.php?type=user&action=logout"><i class="fa fa-sign-out"></i><span>Logout</span></a></li>';
                            } else {
                                echo '<li><a href="index.php?type=user&action=register"><i class="fa fa-user-plus"></i><span>Sign Up</span></a></li>';
                                echo '<li><a href="index.php?type=user&action=login"><i class="fa fa-sign-in"></i><span>Login</span></a></li>';
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </nav>
        </section>

    </body>
</html>
