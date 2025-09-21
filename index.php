<?php 
    require_once('config.php');
    
    $controller = $_GET['controller'] ?? 'mahasiswa';
    $action     = $_GET['action'] ?? 'index';

    if ($controller === 'mahasiswa'){
        require_once('controllers/mahasiswa_controller.php');
        $mhs_controller = new mahasiswaController($conn);

        switch ($action){
            case 'index': $mhs_controller->index(); break;
            case 'create': $mhs_controller->create(); break;
            case 'edit': $mhs_controller->edit($_GET['id']); break;
            case 'delete': $mhs_controller->delete($_GET['id']); break;
            case 'getJurusanAjax': $mhs_controller->getJurusanAjax(); break;
            default: echo "action error.";
        }
        
    }else {
        echo "controller error";
    }

?>