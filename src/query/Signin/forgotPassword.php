<?php
include '../../../config.php';
include '../../../email_config.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../../PHPMailer/src/Exception.php';
require '../../../PHPMailer/src/PHPMailer.php';
require '../../../PHPMailer/src/SMTP.php';

// Função para validar o email
function isValidEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

$email = $_POST['email'];

// Validação do email
if (!isValidEmail($email)) {
    header("Location: ../../pages/Login/forgotPassword.php?error=invalid email");
    exit();
}

// Preparar e executar a consulta de forma segura
$query = $conn->prepare("SELECT * FROM users WHERE email = ?");
$query->bind_param("s", $email);
$query->execute();
$result = $query->get_result();
$row = $result->fetch_assoc();

if ($result->num_rows > 0) {
    try{
        $mail = new PHPMailer(true); 

        //Server settings
        $mail->SMTPDebug = 0;                                 // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = $dreamhost;                  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = $host_username ;           // SMTP username
        $mail->Password = $host_password;                          // SMTP password
        $mail->SMTPSecure = 'ssl';                            // Enable SSL encryption, TLS also accepted with port 465
        $mail->Port = $host_port;                                    // TCP port to connect to   

        //Recipients
        $mail->setFrom($host_username, 'GoPE!');
        $mail->addAddress($email);     // Add a recipient

        //Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Reset Password - GoPE!';
        $mail->Body    = "
        <br>
        Did you forget your password?
        <br><br>
        Please click on the <strong>link below</strong> to reset your password.
        <a href='http://work.globalphysicaleducationobservatory.com/src/pages/Login/resetPassword.php?id=".$row['id']."'>Reset Password</a>
        If you have any questions, please contact us at <a href='mailto:gopecoordination@gmail.com'>gopecoordination@gmail.com</a> or <a href='mailto:prjccristao@gmail.com'>prjccristao@gmail.com</a>
        ";

        $mail->send();
        header("Location: ../../pages/Login/login.php");
    } catch (Exception $e) {
        header("Location: ../../pages/Login/forgotPassword.php?error=email sending failed");
    }
} else {
    header("Location: ../../pages/Login/forgotPassword.php?error=email not registered");
}

$query->close();
$conn->close();