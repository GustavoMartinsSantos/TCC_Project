<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
        <link rel="icon" type="imagem/png" href="../IMG/icon_header.png">
        <title>Login</title>
        <script src="../includes/JS/script_log.js"></script>
        <link rel="stylesheet" href="../includes/CSS/style_log_resp.css">    
    </head>
    <body>
        <form method="POST">
            <div class="title">
                <h1>Login</h1><br>
                <div class="tela_login border border-1 con1">
                    <!-- Tela primaria -->
                    <br><br>
                    <h2>Faça login!</h2>
                    <h5>Digite seu e-mail</h5>
                    <h5>ou cadastre-se</h5><br><br>
                    <p><label for="email" class="lb_email">Email</label>
                    <input name="email" type="email" class="txt_boxes" onblur="boxblur(this.value)" onfocus="boxfocus()" required><br><br><br>
                    <label for="senha" class="lb_senha">Senha</label>
                    <input name="senha" type="password" class="txt_boxes pass" onblur="boxblur1(this.value)" onfocus="boxfocus1()" required></p>
                    <input type="checkbox" onclick="alt_pass()"><h7> Mostrar Senha</h7><br><br>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <p><a href="../Usuario/cadastrar.php"><input type="button" value="Cadastrar-se" class="btn btn-secondary w-75"></a><br></p>
                            </div>
                            <div class="col-md-6 col-12">
                                <input type="submit" value="Entrar" class="btn btn-dark w-75">
                            </div>
                        </div>
                    </div>
                </div>
            <!-- div legenda -->
            </div>
        </form>
    </body>
</html>