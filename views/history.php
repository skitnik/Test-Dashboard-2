<?php
$userId = $_SESSION['userId'];
$db = Database::getInstance();
$result = $db->selectQuery("SELECT user_id,time_logged,time_loggedout FROM logs ORDER BY time_loggedout DESC");
?>
<html>
    <head>
        <title>History</title>
    </head>
    <body>
        <section id="history">
            <center><h1>History</h1></center>
            <div class="container">
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2" id="">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>User ID</th>
                                    <th>Time logged in</th>
                                    <th>Time logged out</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                
                                foreach ($result as $row){
                                    echo '<tr>';
                                    
                                    foreach($row as $value){
                                        echo '<td>'. $value . '</td>';
                                    }
                                    
                                    echo '</tr>';
                                } 
                                
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
        
    </body>
</html>

