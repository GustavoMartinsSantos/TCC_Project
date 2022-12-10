<body style="margin-top: 100px;">
        <?php
            if(isset($_SESSION['alert'])) {
                echo $_SESSION['alert'];
                unset($_SESSION['alert']);
            }
        ?>

        <form method="POST" enctype="multipart/form-data">
            <div class="display_icons"><label for="title">Adicione um título</label> &nbsp;<i class="bi bi-card-text"></i></div>
            <input type="text" name="title" class="forms sel" required
            value="<?php echo isset($Event) ? $Event->getTitulo() : null ?>"><br><br>

            <div class="display_icons"><label for="capa">Adicione a capa do evento</label> &nbsp;<i class="bi bi-image-fill"></i></div>

            <div class="posi"><img name="capa" class="img2 prewview" 
            src="../IMG/<?php echo isset($Event) ? $Event->getImage()->getName() : 'event_pad.png' ?>">
            <input type="file" name="imagem" class="file" onchange="troca_img()" accept="image/*"></div><br>

            <div class="display_icons"><label for="menu_seletor">Categorias</label> &nbsp;<i class="bi bi-check2-circle"></i></div>
            <select class="forms sel" style="height: 120px;" name="Classificacoes[]" multiple required>
            <?php foreach(Classification::getClassificacoes($db) as $Classificacao) { ?>
                    <option <?php 
                        if(isset($Event))
                            echo ($Event->SELECTED_Classifications($Classificacao->getID())) ? 'selected' : null;
                  ?> value="<?php echo $Classificacao->getID() ?>">
                    <?php echo $Classificacao->getName() ?></option>
            <?php } ?>
            </select><br><br>

            <div class="display_icons"><label for="menu_seletor">O evento faz parte de </label> &nbsp;<i class="bi bi-check2-circle"></i></div>
            <div class="forms sel" style="margin: auto; height: 120px; overflow-y: scroll" required>
                <div class="checkbox"><input type="checkbox" onclick="checkAll('grupo', this)"> Todos</div>
                <?php foreach(Group::getGroups($db, "WHERE ID_Usuario = " . $_SESSION['user']['id']) as $Group) { ?>
                        <div class="checkbox"><input type="checkbox" class="grupo" name="Grupos[]" require
                        <?php if(isset($Event))
                                echo ($Event->SELECTED_Groups($Group->getID())) ? 'checked' : null;
                    ?> value="<?php echo $Group->getID() ?>">
                        <?php echo $Group->getName() ?></div>
                <?php } ?>
            </div><br><br>

            <div class="esp">
                <label for="date" required>Data de Início: </label>
                <input name="dataHoraInicio" type="datetime-local" class="date_hour" style="width: 150px;" id="dataInicio"
                value="<?php echo isset($Event) ? $Event->getDataHora_Inicio() : null ?>" onblur="setMinMaxDate(true, this, 'dataVenc', this.value)">
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;

                <label for="hora" required>Vencimento:</label>
                <input name="dataHoraVenc" type="datetime-local" class="date_hour" style="width: 150px;" id="dataVenc"
                value="<?php echo isset($Event) ? $Event->getDataHora_Venc() : null ?>" onblur="setMinMaxDate(false, this, 'dataInicio', this.value)"><br><br>
            </div>

            <div class="display_icons"><label for="descricao">Insira uma descrição</label> &nbsp;<i class="bi bi-body-text"></i></div>
            <textarea name="descricao" class="descricao forms sel" rows="5" placeholder="Descrição do Evento..."  maxlength="200" onkeydown="contador(this.value)"><?php echo isset($Event) ? $Event->getDescricao() : null ?></textarea><br>
            <label for="descricao" class="desc bg-secundary"></label><br><br>

            <button type="submit" class="btn btn-warning sel">
                <?php echo isset($Event) ? 'Editar' : 'Criar' ?>
            </button><br><br>
        </form>
    </body>
</html>