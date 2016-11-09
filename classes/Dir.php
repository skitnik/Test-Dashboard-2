<?php

class Dir {

    //Create Dir not working
    public $validate;
    public $hrefDir = '&name=';
    public $dir = 'storage';
    public $files = [
        'dirs' => [],
        'files' => []
    ];
    
    public function __construct() {
        $this->validate = new Validate();
        if ($_GET['action'] == 'open') {
            $this->dir .= '/' . $_GET['name'];
        }
    }

    public function display() {

        if (is_dir($this->dir)) {
            if ($resource = opendir($this->dir)) {
                while ($file = readdir($resource)) {
                    if ($file != '.' && $file != '..') {
                        if (is_dir($this->dir . '/' . $file)) {
                            $this->files['dirs'][] = $file;
                        } else {
                            $this->files['files'][] = $file;
                        }
                    }
                }
                closedir($resource);
            }
        }
    }

    //Create folder only in the main dir
    public function dirCreate() {

        if (!file_exists($this->dir . '/' . $_POST['folder_name'])) {
            mkdir($this->dir . '/' . $_POST['folder_name']);
            header('Location:index.php?type=content&action=index');
        } else {
            echo "file already exist";
        }
    }

    // Does not redirect properly
    public function delete() {

        if ($_GET['type'] == 'dir' && $_GET['action'] == 'delete') {
            rmdir('storage' . '/' . $_GET['name']);
            header("Location:index.php?type=content&action=index");
        } elseif ($_GET['type'] == 'file' && $_GET['action'] == 'delete') {
            unlink($this->dir . '/' . $_GET['name']);
            header("Location:index.php?type=content&action=index");
        }
    }

    public function rename($newName) {

        if ($_GET['type'] == 'dir' && $_GET['action'] == 'rename') {
            rename('storage/' . $_GET['name'], 'storage/' . $newName);
            header("Location:index.php?type=content&action=index");
        } elseif ($_GET['type'] == 'file' && $_GET['action'] == 'rename') {
            $fileExtension = substr($_GET['name'], -4);
            rename('storage/' . $_GET['name'], 'storage/' . $newName . $fileExtension);
            header("Location:index.php?type=content&action=index");
        }
    }

    public function setPath($path) {
        $this->path = $path;
    }

}
