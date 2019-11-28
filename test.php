<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'autoload.php';
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "phpfile";
$flag=1;

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT * from info";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
     while($row = $result->fetch_assoc()) {
       
    if($row["email"]==$_POST['testemail'])
    {
        $flag=0;
            $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Server settings
    // $mail->SMTPDebug = 1;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'pavan.beis.15@acharya.ac.in';                 // SMTP username
    $mail->Password = 'sonupavan';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('pavan.beis.15@acharya.ac.in', 'Developers@GroupMessage');
    $mail->addAddress($_POST['testemail']);     // Add a recipient
    // $mail->addAddress('ellen@example.com');               // Name is optional
    // $mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Group message account password recovery';
    $mail->Body    = '<img src="https://www.logolynx.com/images/logolynx/54/54708a2e97fe28a75351f2bd8079e38d.jpeg" width:50px height:50px /><br><h2>Your account password is <b>"'.$row["pass"].'"</b> against your username <b>"'.$row["name"].'"</b>.</h2><br><h3>This is a confidential email.Please do not share your password with anyone!.</h3>';
    $mail->AltBody = 'Your password is "'.$row["pass"].'"This is a confidential email.Please do not share your password with anyone!. ';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}
    break;
    }
    }
    if(flag)
    {
        echo "<script type='text/javascript'>alert('Mail Id not found');</script>";
    }
}
$conn->close();
?>