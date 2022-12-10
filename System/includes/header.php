<?php
    if (PAGE_TITLE != 'SETEC'){
        ob_start();
        session_start();

        if(!isset($_SESSION['user']))
            header("location: ../Usuario/login.php");
    }
?>
<html lang="pt-BR">
    <head>
        <style>            
            .logo {
                position: fixed;
                cursor: pointer; 
                top: 7px;
                right: 4%;
                width: 53px;
                height: 50px;
                border-radius: 50%;
            }
        </style>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
        <link rel="icon" type="imagem/png" href="<?php echo (PAGE_TITLE != 'SETEC') ? '../' : null ?>IMG/icon_header.png">
        <title><?php echo PAGE_TITLE ?></title>
        <?php
            if(is_array(JS_INCLUDES)) {
                foreach(JS_INCLUDES as $js_include)
                    echo '<script src="' . $js_include  . '"></script>';
            } else
                echo '<script src="' .  JS_INCLUDES  . '"></script>';

            if(is_array(CSS_INCLUDES)) {
                foreach(CSS_INCLUDES as $css_include)
                    echo '<link rel="stylesheet" href="' .  $css_include  . '">';
            } else
                echo '<link rel="stylesheet" href="' .  CSS_INCLUDES  . '">';
        ?>
    </head>
    <header>
        <a href="<?php echo (PAGE_TITLE != 'SETEC') ? '../' : null ?>index.php">
            <img class="logo_header" src="<?php echo (PAGE_TITLE != 'SETEC') ? '../' : null ?>IMG/icon_header.png" alt="logo">
	<?php if(PAGE_TITLE == 'SETEC')
	    echo "<h1 class='mt-2 text-light' style='position: absolute; left: 10%'>SETEC</h1>"; ?>
        </a>

        <?php if (PAGE_TITLE == 'SETEC') { ?>
                <form method="GET" id="search">
                    <div class="div_pesq">
                        <input type="text" name="search" class="txt_pesq" value="<?php echo $search ?>" size="45" id="formSearch" placeholder="Pesquisar..."><i class="bi bi-x ex" onclick="cl_txt()"></i>
                    </input>
                    <button type="submit" class="btn btn-dark btn_pesq"><i class="bi bi-search"></i></button>
                </div>
        <?php }
        
            if (isset($hasTitle)) { 
                echo "<center><h2 class='mt-2'>$hasTitle</h2></center>";
            }
        ?>

        <img src="<?php echo (PAGE_TITLE != 'SETEC') ? '../' : null ?>IMG/<?php echo isset($_SESSION['user']['imagem']) ? $_SESSION['user']['imagem'] : 'user_pad.png' ?>"
        alt="login" class="logo" onclick="most_log()">
    </header>
    <div class="tela_login border border-2">
        <h6 style="height: 8px">&nbsp;Olá, <?php echo $_SESSION['user']['nome'] ?></h6>
        <hr>
        <?php if($_SESSION['user']['ADM']) { ?>
            <a class="links-log" href="<?php echo (PAGE_TITLE != 'SETEC') ? '../' : null ?>Usuario/cadastrar.php" target="_blank">&nbsp;Cadastrar ADM<i class="bi bi-person-add mx-2" style="float: right;"></i></a>
        <?php } ?>
        <a class="links-log" href="<?php echo (PAGE_TITLE != 'SETEC') ? '../' : null ?>Usuario/editar.php" target="_blank">&nbsp;Meus dados <i class="bi bi-person-check-fill mx-2" style="float: right;"></i></a>
        <a class="links-log" href="<?php echo (PAGE_TITLE != 'SETEC') ? '../' : null ?>Usuario/logout.php">&nbsp;Sair<i class="bi bi-box-arrow-left mx-2" style="float: right;"></i></a> 
    </div>
    <?php
        if(isset($_SESSION['message'])) {
            echo $_SESSION['message'];
            unset($_SESSION['message']);
        }
    ?>