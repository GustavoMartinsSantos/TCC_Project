<body>
    <header>           
    <img class="logo_header" src="../icones/6quadradinhos/icon_header.png" alt="logo">             
    <div class="div_pesq"><input type="text" class="txt_pesq"  size="45" placeholder="Pesquisar..." required ><i class="bi bi-x" onclick="cl_txt()"></i></input><button class="btn btn-dark btn_pesq" onclick="btn_ver()"><i class="bi bi-search"></i></button></div>
    <img src="IMG/user_pad.png" alt="login" class="user_img" onclick="most_log()">    
    <i class="bi bi-list" onclick="config()"></i>
    </header>

    <a class="est_links add_eventos" href="../add_eventos/add_eventos.html" target="_blank"><i class="bi bi-plus-circle-fill"></i></a>
        
    </div>

    <div class="tela_login border border-2">
        <h6>Perfil</h6>
        <hr>
        <a class="links-log" href="../login/login.html" target="_blank">Fazer Login <i class="bi bi-person-check-fill"></i></a>
        <p><a  class="links-log" href="../cadastro/cadastro.html" target="_blank">Cadastrar-se <i class="bi bi-person-plus-fill"></i></a></p>   
    </div>
    <div class="container-fluid position-fixed inx">
        <div class="row">
            <div class="col-3 bg-light">
                <hr><div class="tags_main">&nbsp;<h3>Eventos:</h3><i class="bi bi-calendar-event ic_inx"></i></div><hr><br>
                <hr><div class="tags_main">&nbsp;<h3>Sarau:</h3><i class="bi bi-balloon ic_inx"></i></div><hr><br>
                <hr><div class="tags_main">&nbsp;<h3>Monitoria: </h3><i class="bi bi-book ic_inx"></i></div><hr><br>
                <hr><div class="tags_main">&nbsp;<h3>Data:</h3><select class="forms border w-75 bg-white" name="menu_seletor" id="select_main" required>
                    <option value="1">Este Trimestre</option>
                    <option value="2">Este Mês</option>
                    <option value="3">Esta Semana</option>
                </select></div><hr>
                <h4 class="resp"></h4>
                <div class="rod">
                    <i class="bi bi-star" onmouseover="most_star()" onmouseleave="clean_star()"></i>
                    <i class="bi bi-plus-circle" onmouseover="most_plus()" onmouseleave="clean_plus()"></i>
                    <i class="bi bi-chat-left-dots" onmouseover="most_chat()" onmouseleave="clean_chat()"></i>
                    <i class="bi bi-people" onmouseover="most_group()" onmouseleave="clean_group()"></i>
                </div>
            </div>
            <div class="col border">
                <p></p>
                <p><div class="events w-100">
                    <div class="dia"><h1>19</h1><h3>Out</h3></div>
                    <img src="../imagens/exemplo_event.jpg" class="img" alt="">
                </div></p>
                <p><div class="events w-100">
                    <div class="dia"><h1>24</h1><h3>Dez</h3></div>
                    <img src="../imagens/exemplo_event.jpg" class="img" alt="">
                </div></p>
                <p><div class="events w-100">
                    <div class="dia"><h1>24</h1><h3>Dez</h3></div>
                    <img src="../imagens/exemplo_event.jpg" class="img" alt="">
                </div></p>
                <p><div class="events w-100">
                    <div class="dia"><h1>24</h1><h3>Dez</h3></div>
                    <img src="../imagens/exemplo_event.jpg" class="img" alt="">
                </div></p>
                <p><div class="events w-100">
                    <div class="dia"><h1>24</h1><h3>Dez</h3></div>
                    <img src="../imagens/exemplo_event.jpg" class="img" alt="">
                </div></p>
                <p><div class="events w-100">
                    <div class="dia"><h1>24</h1><h3>Dez</h3></div>
                    <img src="../imagens/exemplo_event.jpg" class="img" alt="">
                </div></p>
                <p><div class="events w-100">
                    <div class="dia"><h1>24</h1><h3>Dez</h3></div>
                    <img src="../imagens/exemplo_event.jpg" class="img" alt="">
                </div></p>
                
            </div>
        </div>
    </div>
</html>