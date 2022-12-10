<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nova senha</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../includes/CSS/new_password.css">
    <script src="../includes/JS/new_password.js"></script>
    <link rel="icon" type="imagem/png" href="../IMG/icon_header.png">
</head>
<body>
    <div class="tela_email">
        <form method="POST">
            <div class="title">
                <h2 style="top: 10px; position: relative;">Nova Senha</h2>
            </div><br>

            <img src="../IMG/icon_header.png" alt="logo do site">
            <br><br>

            <label style="font-size: 25px;">Escolha uma senha forte!</label></i><br><p></p>

            <i class="bi bi-eye-fill icon" onclick="verSenha()"></i>
            <input name="senha" type="password" class="border form-control w-75 txt_box" style="margin: auto" placeholder="Digite uma nova senha" onkeyup="nivelSenha(this.value)">
            <p></p><input type="password" class="border form-control w-75 txt_box1" style="margin: auto" placeholder="Confirme a senha">
            
            <div class="disp_nivel"><label for="">Nível:</label><div class="div_nivel border w-50"><div class="internal_div"></div></div></div>
            <br><button class="btn btn-warning w-50" onclick="conf()">Editar Senha</button>
        </form>
    </div>
</body>
</html>