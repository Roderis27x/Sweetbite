<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Incluye los archivos de PHPMailer
require 'PHPMailer-6.8.1/src/Exception.php';
require 'PHPMailer-6.8.1/src/PHPMailer.php';
require 'PHPMailer-6.8.1/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar datos del formulario
    $name = $_POST["name"];
    $email = $_POST["email"];
    $subject = $_POST["subject"];
    $message = $_POST["message"];

    // Configurar PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Configuración del servidor SMTP de Gmail
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = getenv('GMAIL_USERNAME'); // Utiliza la variable de entorno para el correo electrónico
        $mail->Password = getenv('GMAIL_PASSWORD'); // Utiliza la variable de entorno para la contraseña
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Destinatario y remitente
        $mail->setFrom($email, $name);
        $mail->addAddress('correo_destino@example.com'); // Reemplaza con tu dirección de correo de destino

        // Contenido del correo
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = "Nombre: $name <br> Correo Electrónico: $email <br> Mensaje: $message";

        $mail->send();

        echo "success";
    } catch (Exception $e) {
        echo "error: " . $mail->ErrorInfo;
    }
} else {
    echo "error";
}
?>

