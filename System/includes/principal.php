    <div class="excl_screen shadow-lg">
        <div class="bar_sup"></div><br>

        <h2>Você realmente</h2>
        <h2 class="titleWindow"></h2><br>
        <button class="btn btn-success w-25" style="color: white;" onclick="sair()" type="button">Cancelar</button> &nbsp; &nbsp; &nbsp;
        <button class="btn btn-danger w-25" id="btnExcluir">Excluir</button>
    </div>
    
    <div class="fundo">
    <body style="background-image:url(IMG/background_index.png);">
        <div class="container-fluid position-fixed inx">
            <div class="row">
                <div class="col-3 bg-light">
                        <hr><div class="tags_main">&nbsp;<h3>Grupos:</h3><select class="forms border w-75 bg-white" onchange="this.form.submit()" name="grupo" required>
                            <option>Todos</option>
                            <?php foreach($Grupos as $Grupo) { ?>
                                <option <?php echo ($groupFilter == $Grupo->getName()) ? 'selected' : null?>
                                ><?php echo $Grupo->getName() ?></option>
                            <?php } ?>
                        </select></div><hr>

                        <hr><div class="tags_main">&nbsp;<h3>Tipo:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h3><select class="forms border w-75 bg-white" name="tipo" onchange="this.form.submit()" id="select_main" required>
                                <option>Padrão</option>   
                        <?php foreach($Classificacoes as $Classificacao) { ?>
                                <option <?php echo ($typeFilter == $Classificacao->getName()) ? 'selected' : null?>
                                ><?php echo $Classificacao->getName() ?></option>
                            <?php } ?>
                        </select></div><hr>

                        <hr><div class="tags_main">&nbsp;<h3>Data:&nbsp;&nbsp;&nbsp;&nbsp;</h3><select name="data" class="forms border w-75 bg-white" name="menu_seletor" id="select_main" onchange="this.form.submit()" required>
                            <option value="0">Padrão</option>
                            <option value="1" <?php echo ($dataFilter == 1) ? 'selected' : null?>>Esta Semana</option>
                            <option value="2" <?php echo ($dataFilter == 2) ? 'selected' : null?>>Este Mês</option>
                            <option value="3" <?php echo ($dataFilter == 3) ? 'selected' : null?>>Este Trimestre</option>
                            <option value="4" <?php echo ($dataFilter == 4) ? 'selected' : null?>>Ocorrendo</option>
                            <option value="5" <?php echo ($dataFilter == 5) ? 'selected' : null?>>Fora de Prazo</option>
                        </select></div><hr>
                    </form>
                            
                    <h4 class="resp"></h4>
                    <div class="rod">
                        <a href="?fav=<?php echo $favFilter == 'true' ? 'false' : 'true' ?>">
                            <i class="bi <?php echo $favFilter == 'true' ? 'bi-star-fill' : 'bi-star' ?>" onmouseover="most_star()" onmouseleave="clean_star()"></i>
                        </a>

                        <?php 
                            if($_SESSION['user']['groupPermission']) { ?>
                                <a href="Eventos/cadastrar.php"><i class="bi bi-plus-circle" onmouseover="most_plus()" onmouseleave="clean_plus()"></i></a>
                        <?php } 

                            if($_SESSION['user']['ADM'] || $_SESSION['user']['groupPermission']) { ?>
                                <a href="Grupos/index.php"><i class="bi bi-people" onmouseover="most_group()" onmouseleave="clean_group()"></i></a>
                        <?php } ?>
                    </div>
                </div>
                <div class="col">
                <?php foreach($Events as $Event) {
                    $date = date('Y-m-d G:i');
                    
                    $dataInicio = ($Event->getDataHora_Inicio() != null) ? new DateTime($Event->getDataHora_Inicio()) : null;
                    $betweenDates = ($dataFilter != 4 && $Event->getDataHora_Inicio() <= $date && $Event->getDataHora_Venc() > $date) ? true : false;
                    $outOfDate = ($dataFilter != 5 && $Event->getDataHora_Venc() < date('Y-m-d h:i')) ? true : false; ?>
                    <!-- style="<?php //echo $outOfDate ? "color: white; background-color: rgba(255,0,0,0.5)" : null ?>"-->
                    <p><div class="events w-100" style="<?php echo $outOfDate ? "color: white; background-color: rgba(255,0,0,0.5)" : null;
                                                        echo $betweenDates ? "background-color: rgba(255,255,127)" : null ?>">
                        <?php 
                            if($_SESSION['user']['ADM'] || $Event->getPermission()) {
                                echo '<a href="Eventos/editar.php?cod=' . $Event->getCod() .
                                '"><button type="button" class="btn-success h-100" style="border-radius: 5px;"><i class="bi bi-pen" style="font-size: 1.8rem;"></i></button></a>';
                            } ?>

                        <?php if($dataInicio != null) { ?>
                            <div class="dia">
                                <h1><?php echo $dataInicio->format('d') ?></h1><h3><?php echo $months[$dataInicio->format('m') - 1] ?></h3>
                            </div>
                        <?php } ?>
                        
                        <img src="IMG/<?php echo $Event->getImage()->getName() ?>" class="img"
                        style="left: <?php echo ($_SESSION['user']['ADM'] || $Event->getPermission()) ? '72%' : '77%' ?>;<?php
                        echo $outOfDate ? " opacity: 0.5" : null ?>">
                        
                        <div class="txt_tit">
                            <h2 class="tit_pos mb-3"><?php echo $Event->getTitulo() ?></h2>
                            <h7 class="txt_event"><?php echo $Event->getDescricao() ?></h7>

                            <button class="btn_fav bg-transparent" onclick="fav(<?php echo $Event->getCod() ?>,<?php echo $_SESSION['user']['id'] ?>)">
                                <i class="fav_icon bi <?php echo $Event->getFavorito() ? 'bi-star-fill' : 'bi-star' ?>" 
                                style="color: <?php echo $Event->getFavorito() ? "#f3d500" : 'black' ?>"
                                id="<?php echo $Event->getCod() ?>"></i>
                            </button>

                            <?php /* if($outOfDate) { ?>
                                <div class="btn_atrasado bg-danger border-0 text-white px-2 align-middle">Atrasado</div>
                            <?php } */?>
                        <?php if($_SESSION['user']['ADM'] || $Event->getPermission()) { ?>
                            <button class="btn_x bg-danger border-0"
                            onclick="btn_ex(true, '<?php echo $Event->getTitulo() ?>','e',<?php echo $Event->getCod() ?>)">
                                <i class="bi bi-trash-fill ex2"></i>
                            </button>
                        <?php } ?>
                        </div>
                    </div></p>
                <?php } ?>
                <br><br>
                </div>
            </div>
        </div>
    </body>
    </div>
</html>