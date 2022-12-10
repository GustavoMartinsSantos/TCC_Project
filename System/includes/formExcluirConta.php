<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <link rel="icon" type="imagem/png" href="../IMG/icon_header.png">
    <link rel="stylesheet" href="../includes/CSS/excluirConta.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="../includes/JS/excluirConta.js"></script>
    <script src="../includes/JS/principal.js"></script>
    <title>Excluir conta</title>
</head>
<body>
    <?php
        if(isset($_SESSION['alert'])) {
            echo $_SESSION['alert'];
            unset($_SESSION['alert']);
        }
    ?>

    <div class="excl_screen shadow-lg">
        <div class="bar_sup"></div>
        <br>
        <h2>Você realmente</h2>
        <h2 class="titleWindow"></h2><br>
        <div class="layBtn">
        <button class="btn btn-warning w-25" style="color: white;" onclick="sair()">Cancelar</button>
        <button class="btn btn-danger w-25" id="btnExcluir">Excluir</button>
        </div>
    </div>

    <form method="POST">
        <div class="fundo">
        <h1>Excluir Conta</h1><br>
            <div class="telaExcluir">
                <img src="../IMG/<?php echo isset($User) ? $User->getImage()->getName() : 'user_pad.png' ?>">
                
                <label name="email" class="exibEmail border border-2">
                    <?php echo isset($User) ? $User->getEmail() : null ?>
                </label><br><br>
                
                <label for="senha" class="lbSenha">Senha</label>
                <i class="bi bi-eye-fill icon" onclick="verSenha()"></i>
                
                <input name="passwd" type="password" class="txt_boxes" onfocus="boxfocus()" onblur="boxblur(this.value)">
                
                <input type="submit" value="Excluir conta" class="btn btn-dark btnEx">
            </div>
        </div>
    </form>
</body>
</html>