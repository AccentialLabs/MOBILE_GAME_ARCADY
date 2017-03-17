<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Latest compiled and minified CSS -->
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/js/bootstrap.min.js" integrity="sha384-BLiI7JTZm+JWlgKa0M0kGRpJbF2J8q+qreVrKBC47e3K6BW78kGLrCkeRX6I9RoK" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/css/bootstrap.min.css" integrity="sha384-AysaV+vQoT3kOAXZkl02PThvDr8HYKPZhNT5h/CXfBThSRXQ6jW5DO2ekP5ViFdi" crossorigin="anonymous">

<?php
echo $this->Html->css('login', null, array('media' => 'screen')) . "\n";
echo $this->Html->css('game-menu', null, array('media' => 'screen')) . "\n";
echo $this->fetch('css');
?>


<nav class="navbar navbar-default game-menu ">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <a class="navbar-brand game-menu-brand" href="#"> <?php  echo $this->Html->image('joystick.png', array('width' => '30')); ?></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>

<div class="title-content col-md-12">
<div class="col-md-12 text-center">
 <h3>ARCADY <?php echo $this->Html->image('joystick.png', array('width' => '30')); ?></h3>
</div>
<br />
   <?php 
        $message = $this->Session->flash();
        if($message !== null && $message != ""){
            echo '<div class="alert alert-danger centerText" role="alert">'.$message.'</div>';
        }
    ?>
    <form method="post" action="../Login/logar">
        <input type="text" class="form-control" placeholder="e-mail" name="email"/><br/>
        <input type="password" class="form-control" placeholder="senha" name="senha"/><br/>
        <a href="../Login/esqueciSenha" class='pull-right'>Esqueci a senha</a><br/>
        <button type='submit' class='btn btn-default login-btn'>Entrar</button>
    </form>

</div>




