<nav class="navbar navbar-default game-menu ">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand game-menu-brand" href="../../../officialgamingMobile/Home/index"> <?php  echo $this->Html->image('joystick.png', array('width' => '30')); ?> </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <div class="text-center">
                <br/>
                <img class="img-circle" src="<?php echo $logado['funcionario']['urlfoto']; ?>" width="60" height="60"/>
            </div>
            <ul class="nav navbar-nav">
                <li class="disabled"><a href="#"><strong>Meus Dados</strong></a></li>
                <li ><a href="../Configuracao/personalizar">Personalizar</a></li>
                <li ><a href="#">Minhas Redes Sociais</a></li>
            </ul>

            <ul class="nav navbar-form  navbar-nav navbar-left">
                <li class="disabled"><a href="#"><strong>Jogo</strong></a></li>
                <li><a href="#">Minhas equipes</a></li>
                <li><a href="#">Meus prêmios</a></li>
                <li><a href="#">Ver regras/instruções </a></li>
                <li><a href="#">Contato do Game Manager</a></li>
            </ul>

            <ul class="nav navbar-nav navbar-leftt">
                <li class="disabled"><a href="#"><strong>Empresa</strong></a></li>
                <li><a href="#">Redes Sociais Empresa</a></li>
            </ul>

            <ul class="nav navbar-form  navbar-nav navbar-left">
                <li><a href="../Login/logout"><strong>Sair</strong></a></li>

            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>