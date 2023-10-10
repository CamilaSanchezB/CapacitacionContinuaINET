<?php
$pagina = '';

if (isset($_GET['t'])) {
    $pagina = $_GET['t'] . '/'. $_GET['p'];
} elseif (isset($_GET['p'])) {
    $pagina = $_GET['p'];
} else {
    $pagina = 'inicio';
}

require_once './pages/'.$pagina.'.php';
require_once './template/footer.php';
?>