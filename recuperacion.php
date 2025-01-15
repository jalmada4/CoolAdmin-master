<?php
// recuperacion.php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];

    // Conectar a la base de datos
    include 'config/database.php';

    // Verificar si el correo existe en la base de datos
    $query = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $new_password = generateRandomPassword();
        
        // Actualizar la contraseña en la base de datos
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT); // Mejor seguridad

        $update_query = "UPDATE usuarios SET password = ? WHERE email = ?";
        $update_stmt = $mysqli->prepare($update_query);
        $update_stmt->bind_param('ss', $hashed_password, $email);
        $update_stmt->execute();

        // Enviar el correo con la nueva contraseña
        if (sendPasswordEmail($email, $new_password)) {
            echo "Te hemos enviado un correo con tu nueva contraseña.";
        } else {
            echo "Hubo un error al enviar el correo. Inténtalo de nuevo.";
        }
    } else {
        echo "No encontramos un usuario con ese correo electrónico.";
    }
}
?>

<form method="POST">
    <label for="email">Correo electrónico:</label>
    <input type="email" name="email" required>
    <button type="submit">Recuperar contraseña</button>
</form>

<?php
// Función para generar una nueva contraseña MD5 de 4 dígitos
function generateRandomPassword() {
    // Genera un número aleatorio de 4 dígitos
    $randomNumber = mt_rand(1000, 9999);

    // Convierte el número a MD5
    $md5Password = md5($randomNumber);

    // Devuelve los primeros 4 caracteres del hash MD5
    return substr($md5Password, 0, 4);
}

require 'vendor/autoload.php'; // Asegúrate de tener PHPMailer instalado

// Función para enviar el correo con PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function sendPasswordEmail($email, $new_password) {
    $mail = new PHPMailer(true);
    
    try {
        // Configuración del servidor de correo
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Puedes cambiar esto si usas otro servidor
        $mail->SMTPAuth = true;
        $mail->Username = 'jorgearielbrizuela290@gmail.com'; // Tu correo electrónico
        $mail->Password = 'brbz bfwi xesy ehbo'; // Tu contraseña (Recomendación: usa contraseñas de aplicaciones de Google)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Remitente y destinatario
        $mail->setFrom('jorgearielbrizuela290@gmail.com', 'sysweb');
        $mail->addAddress($email);

        // Contenido del correo
        $mail->isHTML(true);
        $mail->Subject = 'Recuperación de contraseña';
        $mail->Body    = "<h1>Tu nueva contraseña</h1>
                          <p>Tu nueva contraseña es: <strong>$new_password</strong></p>";

        // Enviar el correo
        $mail->send();
        return true;
    } catch (Exception $e) {
        // En caso de error, devolver falso
        return false;
    }
}
?>
