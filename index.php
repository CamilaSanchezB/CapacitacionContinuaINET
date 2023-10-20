<?php
$pagina = '';

if (isset($_GET['t'])) {
    $pagina = $_GET['t'] . '/'. $_GET['p'];
    switch($_GET['t']){
        case 'administrador':
            require_once('./functions/validacion/validacion-administrador.php');
            break;
        case 'docente':
            require_once('./functions/validacion/validacion-docente.php');
            break;
        case 'institucion':
            require_once('./functions/validacion/validacion-institucion.php');
            break;
    }
} elseif (isset($_GET['p'])) {
    $pagina = $_GET['p'];
} else {
    $pagina = 'inicio';
}

require_once './pages/'.$pagina.'.php';
require_once './template/footer.php';
