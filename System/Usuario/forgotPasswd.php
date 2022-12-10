<?php
    session_start();

    require_once '../includes/autoloader.php';

    $db = new Database();

    if(!isset($_GET['email']) || $_GET['email'] == "null") {
        $message = "Digite seu email para lhe enviarmos um link!";
    } else {
        $email = filter_input(INPUT_GET, 'email', FILTER_VALIDATE_EMAIL);
        $WHERE = "WHERE Email = '$email'";
        $code = md5(time());

        $User = User::getUsers($db, $WHERE);
    
        if(count($User) == 0)
            $message = "Digite seu email para lhe enviarmos um link!";
        else {
            $User[0]->setRecSenha($code);
            $User[0]->UPDATE($db);

            $body = file_get_contents('../Email_Pages/forgotPasswd.html');
            $link = "http://localhost/TCC_Project/System/Usuario/nova_senha.php?code=" . $code;
            $footer = '" style="text-decoration: none">
                    <label style="font-size: 20px; cursor: pointer;">Acesse este link para alterar sua senha</label>
                </a>
            </div>
            </body>
            </html>';
            $altBody = "Recuperar senha\n\nEsqueceu a senha?\nAcesse este link para alterá-la: ".$link;
            $body = $body. $link. $footer;
            $image = ["../IMG/icon_header.png",'logo'];

            $mail = new Email($email, 'Redefinição de Senha', $body, $altBody, $image);
            
            if($mail->send()) {
                $_SESSION['alert'] = "<div class='alert alert-success' "
                . "style='width: 35%; margin: auto; margin-bottom: 1%; top: 5%'>Email enviado com sucesso!!</div>";
            
                header("location: login.php");
            } else
                $message = "Não foi possível enviar o email!";
        }
    }

    if(isset($message)) {
        $_SESSION['alert'] = "<div class='alert alert-danger' "
        . "style='width: 35%; margin: auto; margin-bottom: 1%; top: 5%'>{$message}</div>";

        header("location: login.php");
    }
?>