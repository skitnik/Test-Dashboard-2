<?php

$content =  new Dir();
$content->display();

if (isset($_GET['name'])) {
    if ($_GET['name'] === $_GET['name']) {
        $content->hrefDir = '&name=' . $_GET['name'] . '/';
    }
}


?>
<section id="content">
    <center><h1>Content</h1></center>
    <div class="container col-sm-6 col-sm-offset-2">
        <a href="index.php?type=dir&action=create" class="btn btn-default">Create new folder</a>
        echo <table cellspacing="0" cellpadding="0">
            <?php
            
            

                foreach ($content->files['dirs'] as $dir) {
                    echo '<tr>';
                    echo '<td><a href="index.php?type=dir&action=open'.$content->hrefDir.$dir.'"><i class="fa fa-folder"> ' . $dir . '</i></a></td>'
                    . '<td>'
                    . '<a href="index.php?type=dir&action=rename&name=' .$content->hrefDir.$dir.'"><i class="fa fa-pencil-square-o"></i></a>'   
                    . ' <a href="index.php?type=dir&action=copy&name=' . $dir . '"><i class="fa fa-files-o"></i></a>'
                    . ' <a href="index.php?type=dir&action=cut&name=' . $dir . '"><i class="fa fa-scissors"></i></a>'
                    . ' <a href="index.php?type=dir&action=delete&name='.$content->hrefDir.$dir.'"><i class="fa fa-trash-o"></i></a>'
                    . '</td>';
                    echo '</tr>';
                }
                foreach ($content->files['files'] as $file) {
                    echo '<tr>';
                    echo '<td><a href="index.php?type=content&action=open&name=' . $file . '&open"><i class="fa fa-file"> ' . $file . '</i></a></td>'
                    . '<td>'
                    . '<a href="index.php?type=file&action=rename&name=' . $file . '"><i class="fa fa-pencil-square-o"></i></a>'
                    . ' <a href="index.php?type=file&action=copy&name=' . $file . '"><i class="fa fa-files-o"></i></a>'
                    . ' <a href="index.php?type=file&action=cut&name=' . $file . '"><i class="fa fa-scissors"></i></a>'
                    . ' <a href="index.php?type=file&action=delete&name='.$content->hrefDir.$file.'"><i class="fa fa-trash-o"></i></a>'
                    . '</td>';
                    echo '</tr>';
                }
                echo $_SERVER['REQUEST_URI'];
            ?>
        </table>
    </div>    
   
       
</section>
