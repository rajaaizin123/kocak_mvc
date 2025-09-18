<?php 
    require_once('config.php');
    
    $controller = $_GET['controller'] ?? 'mahasiswa';
    $action     = $_GET['action'] ?? 'index';

    if ($controller === 'mahasiswa'){
        require_once('controllers/mahasiswa_controller.php');
        $mhs = new mahasiswaController($conn);

        switch ($action){
            case 'index': $mhs->index(); break;
            case 'create': $mhs->create(); break;
            case 'edit': $mhs->edit($_GET['id']); break;
            case 'delete': $mhs->delete($_GET['id']); break;
            default: echo "action error.";
        }
        
    }else {
        echo "controller error";
    }


?>