<?php
    session_start();

    if(!isset($_SESSION['user']))
        header("location: ../Usuario/login.php");

    require_once '../includes/autoloader.php';

    $WHERE = "WHERE U.ID = '" . $_SESSION['user']['id'] . "'";

    $db = new Database();
    $User = User::getUsers(new Database(), $WHERE)[0];

    require_once '../includes/formExcluirConta.php';

    if(isset($_POST['passwd'])) {
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $senha = filter_input(INPUT_POST, 'passwd', FILTER_SANITIZE_STRING);

        $alert = "<div class='alert alert-danger' "
        . "style='width: 32%; margin: auto; margin-top: 2%'>";

        if($User->getPassword() != $senha) {
            $message = "Senha incorreta!!";
            
            $_SESSION['alert'] = $alert . "{$message}</div>";

            header("location: excluir_conta.php");
        } else { ?>
            <script>
                btn_ex(false, 'excluir sua conta','u',<?php echo $User->getID() ?>,'Usuario/login.php');            
            </script>
    <?php }
    }
?>