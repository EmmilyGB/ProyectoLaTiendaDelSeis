<?php
require_once __DIR__ . '/controllers/Producontroller.php';

$Producontroller = new Producontroller();

// traer productos 
$productos = $Producontroller->listar();

// cargar vista del cliente
include __DIR__ . '/views_client/home.php';
