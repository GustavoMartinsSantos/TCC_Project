  <?php if (PAGE_TITLE == 'Cadastrar') { ?>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
        <link rel="icon" type="imagem/png" href="../IMG/icon_header.png">
        <title>Cadastrar</title>
        <script src="../includes/JS/func_tela_cad.js"></script>
        <script src="../includes/JS/principal.js"></script>
        <link rel="stylesheet" href="../includes/CSS/style_cad.css"> 
        <link rel="stylesheet" href="../includes/CSS/principal.css"> 
    </head>
  <?php } ?>
  <body>
    <div id="area">
      <legend>
        <?php echo (PAGE_TITLE == 'Cadastrar') ? 'Cadastro' : 'Editar' ?>
      </legend><br><br>

      <form name="cadastro" method="POST" enctype="multipart/form-data">
        <fieldset>
          <div class="container">
            <div class="row">
              <div class="col-sm"><br>
                <div class="user_pos">
                  <img src="../IMG/<?php echo isset($User) ? $User->getImage()->getName() : 'user_pad.png' ?>" 
                  class="user_cad_img" name="image" onclick="troca_img()" accept="image/*"></div>
                  <div class="file_pos">
                    <input type="file" name="image" class="input_file" onchange="troca_img()" accept="image/*">
                  </div>
                </div>

              <div class="col-sm">
                <input type="text" name="name" class="text_box" size="60" placeholder="Digite seu nome de usuário" minlength="4" required
                value="<?php echo isset($User) ? $User->getFirstName() . ' ' . $User->getLastName() : '' ?>"><br><br>
                <input type="email" name="email" class="text_box" size="60" placeholder="Digite seu e-mail" required
                value="<?php echo isset($User) ? $User->getEmail() : '' ?>"><br><br>
                <input type="password" name="passwd" class="senha text_box" size="60" minlength="8" maxlength="16" required onchange="conf()" placeholder="Senha"
                value="<?php echo isset($User) ? $User->getPassword() : '' ?>"><br><br>
                <input type="password" class="senha1 text_box" size="60" minlength="8" maxlength="16" required onchange="conf()" placeholder="Confirme sua senha"><br><br>
              </div>
            </div>

            <input type="checkbox" class="text_box" onclick="troca()">
            <label class="lbl">Mostrar Senha</label><br><br>
            
            <button class="btn btn-warning" type="submit" onclick="conf()">
            <?php echo (PAGE_TITLE == 'Cadastrar') ? 'Cadastrar' : 'Editar' ?></button><br>
        </fieldset>
      </form>
    </div>
  </body>
</html>