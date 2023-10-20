<?php 
 function obtenerIdTipoUsuario()
 {
   // Verificar si la variable de sesión 'usuario' existe
   if (isset($_SESSION['usuario'])) {
     // Obtener 'id_tipo_usuario' del arreglo de sesión 'usuario'
     return $_SESSION['usuario']['id_tipo_usuario'];
   } else {
     // La variable de sesión 'usuario' no existe
     return null;
   }


 }
