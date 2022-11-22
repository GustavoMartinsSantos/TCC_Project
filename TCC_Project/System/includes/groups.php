
    <div class="excl_screen shadow-lg">
        <div class="bar_sup"></div><br>

        <h2>Você realmente</h2>
        <h2 class="titleWindow"></h2><br>
        <button class="btn btn-success w-25" style="color: white;" onclick="sair()" type="button">Cancelar</button> &nbsp; &nbsp; &nbsp;
        <button class="btn btn-danger w-25" id="btnExcluir">Excluir</button>
    </div>
    
    <div class="fundo">
        <div class="container cont-top">
        <div class="row">
            <div class="col pri bg-white"><p></p>
                <div class="disp_tit"><h1>Grupos: <?php echo count($Groups) ?></h1><i class="bi bi-people-fill"></i></div><hr>
                <div class="container">                
                    <div class="row">
                        <div class="col-3 border">
                            <h4>Nome do grupo</h4>
                        </div>
                        <div class="col border">
                            <h4>Número de Membros:</h4>
                        </div>
                        <div class="col-2 border">
                        <?php if($_SESSION['user']['ADM']) { ?>
                            <a href="cadastrar.php"><button class="btn btn-success bt"><i class="bi bi-plus"></i></button></a>
                        <?php } else { echo "<h4>Ações</h4>"; } ?>
                        </div>
                    </div>
                    <p></p>

                    <?php foreach($Groups as $Group) { ?>
                        <div class="row">
                            <div class="col-3 border">
                                <h4><?php echo $Group->getName() ?></h4>
                            </div>
                            <div class="col border">
                                <h4><?php echo $Group->getNumMembers() ?></h4>
                            </div>
                            <div class="col-2 border">
                                <div class="disp_btn">
                                    <a href="editar.php?id=<?php echo $Group->getID() ?>">
                                        <button class="btn btn-primary bt"><i class="bi bi-pencil-fill"></i></button>
                                    </a>

                                    <?php if($_SESSION['user']['ADM']) { ?>
                                        <button class="btn btn-danger bt" 
                                        onclick="btn_ex(false, '<?php echo $Group->getName() ?>','g', <?php echo $Group->getID() ?>)">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <br><br><br>
                </div>
            </div>
        </div>
        </div>
    </div>
</body>
</html>