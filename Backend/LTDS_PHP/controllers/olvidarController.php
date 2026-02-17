<?php
// controllers/olvidarController.php
require_once __DIR__ . '/../model/OlvidarModel.php';

class olvidarController {
    private $model;
    private $conn;
    
    public function __construct($db) {
        $this->conn = $db;
        $this->model = new OlvidarModel($db);
    }
    
    // Mostrar formulario de solicitud (olvido.php)
    public function mostrarFormulario() {
        require_once __DIR__ . '/../views_client/olvido.php';
    }
    
    // Procesar envío de correo de recuperación
    public function enviarEmail() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?action=olvido');
            exit;
        }
        
        $correo = filter_var($_POST['correo'], FILTER_SANITIZE_EMAIL);
        
        if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = 'Correo electrónico inválido.';
            header('Location: index.php?action=olvido');
            exit;
        }
        
        // Buscar usuario
        $usuario = $this->model->findByEmail($correo);
        
        if ($usuario) {
            // Crear token
            $token = $this->model->createToken($usuario['NumDoc']);
            
            // Construir enlace de recuperación
            $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
            $host = $_SERVER['HTTP_HOST'];
            $baseUrl = $protocol . "://" . $host . dirname($_SERVER['PHP_SELF']);
            $resetLink = $baseUrl . "/index.php?action=reset&token=" . $token;
            
            // Enviar email
            $this->enviarEmailRecuperacion($correo, $resetLink, $usuario['NombreCom']);
        }
        
        // Siempre mostrar el mismo mensaje (seguridad)
        $_SESSION['mensaje'] = 'Si el correo existe en nuestro sistema, recibirás un enlace de recuperación.';
        header('Location: index.php?action=olvido');
        exit;
    }
    
    // Mostrar formulario de nueva contraseña
    public function mostrarReset() {
        $token = $_GET['token'] ?? '';
        
        if (empty($token)) {
            header('Location: index.php?action=olvido');
            exit;
        }
        
        $reset = $this->model->validateToken($token);
        
        if (!$reset) {
            $_SESSION['error'] = 'El enlace es inválido o ha expirado.';
            header('Location: index.php?action=olvido');
            exit;
        }
        
        require_once __DIR__ . '/../views_client/reset.php';
    }
    
    // Procesar cambio de contraseña
    public function cambiarPassword() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?action=olvido');
            exit;
        }
        
        $token = $_POST['token'] ?? '';
        $password = $_POST['password'] ?? '';
        $passwordConfirm = $_POST['password_confirm'] ?? '';
        
        // Validaciones
        if (empty($password) || empty($passwordConfirm)) {
            $_SESSION['error'] = 'Todos los campos son obligatorios.';
            header('Location: index.php?action=reset&token=' . $token);
            exit;
        }
        
        if ($password !== $passwordConfirm) {
            $_SESSION['error'] = 'Las contraseñas no coinciden.';
            header('Location: index.php?action=reset&token=' . $token);
            exit;
        }
        
        if (strlen($password) < 8) {
            $_SESSION['error'] = 'La contraseña debe tener al menos 8 caracteres.';
            header('Location: index.php?action=reset&token=' . $token);
            exit;
        }
        
        // Validar token
        $reset = $this->model->validateToken($token);
        
        if (!$reset) {
            $_SESSION['error'] = 'El enlace es inválido o ha expirado.';
            header('Location: index.php?action=olvido');
            exit;
        }
        
        // Actualizar contraseña
        if ($this->model->updatePassword($reset['NumDoc'], $password)) {
            // Eliminar token usado
            $this->model->deleteToken($token);
            
            $_SESSION['success'] = 'Contraseña actualizada correctamente. Ya puedes iniciar sesión.';
            header('Location: index.php?action=login');
        } else {
            $_SESSION['error'] = 'Error al actualizar la contraseña. Intenta de nuevo.';
            header('Location: index.php?action=reset&token=' . $token);
        }
        exit;
    }
    
private function enviarEmailRecuperacion($destinatario, $resetLink, $nombreUsuario) {
    // Importar PHPMailer
    require_once __DIR__ . '/../vendor/phpmailer/src/PHPMailer.php';
    require_once __DIR__ . '/../vendor/phpmailer/src/SMTP.php';
    require_once __DIR__ . '/../vendor/phpmailer/src/Exception.php';
    
    $mail = new PHPMailer\PHPMailer\PHPMailer(true);
    
    try {
        // Configuración del servidor SMTP (Gmail)
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = MI_CORREO;        
        $mail->Password   = MI_PASSWORD;        
        $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;
        
        // Remitente y destinatario
        $mail->setFrom('noreply@latiendadelseis.com', 'La Tienda del Seis');
        $mail->addAddress($destinatario, $nombreUsuario);
        
        // Contenido del correo
        $mail->CharSet = 'UTF-8';
        $mail->isHTML(false); // Texto plano
        $mail->Subject = 'Recuperación de contraseña - La Tienda del Seis';
        
        $mensaje = "Hola " . $nombreUsuario . ",\n\n";
        $mensaje .= "Recibimos una solicitud para restablecer tu contraseña.\n\n";
        $mensaje .= "Haz clic en el siguiente enlace para crear una nueva contraseña:\n\n";
        $mensaje .= $resetLink . "\n\n";
        $mensaje .= "Este enlace expira en 1 hora.\n\n";
        $mensaje .= "Si no solicitaste este cambio, puedes ignorar este correo.\n\n";
        $mensaje .= "Saludos,\nLa Tienda del Seis";
        
        $mail->Body = $mensaje;
        
        $mail->send();
        return true;
        
    } catch (Exception $e) {
        // Registrar error
        error_log("Error al enviar email: {$mail->ErrorInfo}");
        return false;
    }
}
}
