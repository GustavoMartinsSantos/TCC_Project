<div id="area">
  <legend>Cadastro</legend><br><br>

  <form name="cadastro" method="post" enctype="multipart/form-data">
    <fieldset>
      <div class="container">
        <div class="row">
          <div class="col-sm"><br>
            <div class="user_pos"><img src="../IMG/user_pad.png" class="user_img" name="image" onclick="troca_img()" accept="image/*"></div>
            <div class="file_pos"><input type="file" name="image" class="input_file" onchange="troca_img()" accept="image/*"></div>
          </div>

          <div class="col-sm">
            <input type="text" name="name" class="text_box" size="60" placeholder="Digite seu nome de usuário" minlength="4" required><br><br>
            <input type="email" name="email" class="text_box" size="60" placeholder="Digite seu e-mail" required><br><br>
            <input type="password" name="passwd" class="senha text_box" size="60" minlength="8" maxlength="16" required onchange="conf()" placeholder="Senha"><br><br>
            <input type="password" class="senha1 text_box" size="60" minlength="8" maxlength="16" required onchange="conf()" placeholder="Confirme sua senha"><br><br>
          </div>
        </div>

        <input type="checkbox" class="text_box" onclick="troca()">
        <label class="lbl">Mostrar Senha</label><br><br>
        
        <button class="btn btn-warning" type="submit" onclick="conf()">Cadastrar</button><br>
      </div>
    </fieldset>
  </form>