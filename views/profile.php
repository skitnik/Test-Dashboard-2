<?php
$userId = $_SESSION['userId'];
$db = Database::getInstance();
$result = $db->selectQuery("SELECT * FROM users WHERE id ='$userId'");
$userFName = ucfirst($result[0]['first_name']);
$userLName = ucfirst($result[0]['last_name']);
$userEmail = $result[0]['email'];

//Edit Profile
if (isset($_POST['edit'])) {
    $editUser = new User();
    $editUser->editProfile();
}
?>
<section id="profile">

    <center><h1>Profile Page</h1></center>
    <div class="container">
        <div class="row">
            <div class="col-sm-6" id="profile-info">
                <ul>
                    <li>First name : <?php echo $userFName; ?></li>
                    <li>Last name : <?php echo $userLName; ?> </li>
                    <li>Email : <?php echo $userEmail; ?></li>
                    
                </ul>
            </div>
        </div>
    </div>

    <!--Edit form-->
    <div class="container">
        <button type="button" class="btn btn-default btn-lg" data-toggle="modal" data-target="#myModal"><i class="fa fa-pencil-square-o"></i>Edit</button>
        <!-- Modal -->
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <center><h4>Edit your Profile</h4></center>
                    <form method="POST" id="editForm">
                        <div class="form-group">
                            <label for="first_name">Enter your first name</label>
                            <input type="text" class="form-control" name="first_name" value="<?php echo $userFName; ?>">
                            <label for="last_name" value="">Enter your last name</label>
                            <input type="text" class="form-control" name="last_name" value="<?php echo $userLName; ?>">
                            <label for="password">Enter your password</label>
                            <input type="password" class="form-control" name="password">
                            <label for="editPassword">Enter your new password</label>
                            <input type="password" class="form-control" name="editPassword">
                            <button type="submit" class="btn btn-default" name="edit">Edit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    



</section>

