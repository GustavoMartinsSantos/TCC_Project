    <body style="margin-top: 100px;">
        <form method="POST" style="position: static;">
            <div class="mt-4 col-md-5 col-5" style="margin-left: auto; margin-right: auto;">
                <label class="form-label">Nome do Grupo</label><br>
                
                <input class="input_pesquisa form-control" name="title" type="text" autocomplete="off" required
                value="<?php echo isset($Grupo) ? $Grupo->getName() : null ?>">
            </div>
            
            <div class="mt-4 col-md-5 col- mb-2" style="margin-left: auto; margin-right: auto;">
                <input class="input_pesquisa mt-3 col-md-5 col-5 form-control" type="search" id="search" placeholder="Digite o nome do aluno" autocomplete="off">
            </div>

            <!-- Resultados da busca -->
            <div class="results col-md-5 col-5" style="background-color: #fffffff0;">

            </div>
            <!-- Div de Adicionados -->
            <div class="dentro_grupo mt-5 col-md-5 col-5" style="background-color: #e7e7e7;">
            <?php
                if(isset($Grupo)) {
                    foreach($Grupo->getGroupXUsers() as $GrupoXUser) {
                        $User = $GrupoXUser->getUser();
                        $image = $User->getImage()->getName();

                   echo '<div id="line' . $User->getID() . '" style="margin-bottom: 10px;">'.
                        '<div class="user_includes">' .
                            '<input type="hidden" name="ids[]" value="' . $User->getID() . '">'.
                            '<div class="imagem"><img src="../IMG/'; echo ($image != '') ? $image : 'user_pad.png';
                       echo '" width="30" height="30" style="border-radius: 50%;"></div>'.
                            '<div class="nome"><h5>' . $User->getName() . '</h5></div></div>'.
                            '<div><h7>'.$User->getEmail().'</h7></div>'.
                            '<div class="btnExcluir"><select class="forms permissao" name="permissao[]"><option value="0">Padrão</option><option value="1" ';
                            echo ($GrupoXUser->getPermissao() == '1') ? 'selected': null;
                            echo '>Administrador</option></select>'.
                            '<button type="button" onclick="removeListItem(' . $User->getID() . ')" class="btn-danger" style="border-radius: 5px;">Excluir</button></div></div>';

                        ?> <script>IDs.push(<?php echo $User->getID() ?>);</script>
            <?php   }
                }
            ?>
            </div>

            <div class="form-inline">
                <button type="submit" class="btn btn-primary col-md-5 col-5 mt-4">
                <?php echo isset($Grupo) ? 'Editar' : 'Cadastrar' ?></button>
            </div>
        </form>
    </body>
</html>