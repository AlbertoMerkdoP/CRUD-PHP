<?php
    /**
     * Creación de una constante la cual nos guardará la ruta de nuestro proyecto
     */

    include_once('Funciones.php');

    if (!defined('ROOT')) {
        define("ROOT", 'http://'.$_SERVER['HTTP_HOST'].getFolderProject());
    }

    $roles = array(
        'administrador' => 1,
        'docente' => 2,
        'estudiante' => 3,
    );

    $dias = array(
        1 => 'Lunes',
        2 => 'Martes',
        3 => 'Miercoles',
        4 => 'Jueves',
        5 => 'Viernes',
        6 => 'Sabado',
        7 => 'Domingo'
    )

?>