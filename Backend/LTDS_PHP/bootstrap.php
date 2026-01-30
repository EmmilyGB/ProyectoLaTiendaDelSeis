<?php
/* =========================
   BOOTSTRAP
   - Inicia sesión
   - Carga la configuración de base de datos
   ========================= */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/config/database.php';
