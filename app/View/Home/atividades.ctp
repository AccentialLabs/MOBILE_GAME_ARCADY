<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Latest compiled and minified CSS -->
<!-- Latest compiled and minified JavaScript 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/css/bootstrap.min.css" integrity="sha384-AysaV+vQoT3kOAXZkl02PThvDr8HYKPZhNT5h/CXfBThSRXQ6jW5DO2ekP5ViFdi" crossorigin="anonymous">

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/js/bootstrap.min.js" integrity="sha384-BLiI7JTZm+JWlgKa0M0kGRpJbF2J8q+qreVrKBC47e3K6BW78kGLrCkeRX6I9RoK" crossorigin="anonymous"></script>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script><link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">


<?php
echo $this->Html->css('game-menu', null, array('media' => 'screen')) . "\n";
echo $this->Html->css('game-page-title', null, array('media' => 'screen')) . "\n";
echo $this->Html->css('atividades', null, array('media' => 'screen')) . "\n";
echo $this->fetch('css');

echo $this->Html->script('atividades') . "\n";
echo $this->Html->script('backButtonjs') . "\n";
echo $this->fetch('script');
?>


<?php echo $this->Element('header_menu'); ?>


<div class="jumbotron text-center game-page-title">
    <h4>Atividades</h4>      
</div>   
<div class="container row">

    <div class="col-md-12 text-center">
        <div class="col-md-12 btn-group text-center" role="group" aria-label="...">
            <button type="button" class="btn btn-default especial-button" value="minhas">Minhas</button>
            <button type="button" class="btn btn-default especial-button active" value="geral">Geral</button>
        </div>
    </div>
<br/>

<!-- TODAS ATIVIDADES-->
<div id="atividades-geral" class="corpo-atividades">
  <ol class="breadcrumb row">
            <li class="col-xs-12"><small>Todas atividades</small> <span class="label label-default pull-right"></span></li>
        </ol>
<div>
<table class="table table-striped">
    <?php foreach($atividades as $atividade){ ?>
        <tr>
            <td><small><?php $date=date_create($atividade['log_atividades']['data']); echo date_format($date,"d/M"); ?></small></td>
            <td>
                <?php if($atividade['log_atividades']['tipo'] == 'acao'){ ?>
<span class="glyphicon glyphicon-flash"></span>
                <?php }else if($atividade['log_atividades']['tipo'] == 'missao'){?>
<span class="glyphicon glyphicon-briefcase"></span>
                <?php }else if($atividade['log_atividades']['tipo'] == 'programa'){?>
<span class="glyphicon glyphicon-folder-close"></span>
                <?php }else if($atividade['log_atividades']['tipo'] == 'desafio'){?>
<span class="glyphicon glyphicon-fire"></span>
                <?php } ?>
            </td>

            <td>
                <small><?php echo $atividade['log_atividades']['descricao_verbo']; ?></small>
            </td>
        </tr>
    <?php } ?>
</table>
</div>
</div>

<!-- MINHAS ATIVIDADES -->
<div id="atividades-minhas" style="display: none;" class="corpo-atividades">
  <ol class="breadcrumb row">
            <li class="col-xs-12"><small>Minhas atividades</small> <span class="label label-default pull-right"></span></li>
        </ol>
<div>
<table class="table table-striped">
    <?php foreach($minhasAtividades as $atividade){ ?>
        <tr>
            <td><small><?php $date=date_create($atividade['log_atividades']['data']); echo date_format($date,"d/M"); ?></small></td>
            <td>
                <?php if($atividade['log_atividades']['tipo'] == 'acao'){ ?>
<span class="glyphicon glyphicon-flash"></span>
                <?php }else if($atividade['log_atividades']['tipo'] == 'missao'){?>
<span class="glyphicon glyphicon-briefcase"></span>
                <?php }else if($atividade['log_atividades']['tipo'] == 'programa'){?>
<span class="glyphicon glyphicon-folder-close"></span>
                <?php }else if($atividade['log_atividades']['tipo'] == 'desafio'){?>
<span class="glyphicon glyphicon-fire"></span>
                <?php } ?>
            </td>

            <td>
                <small><?php echo $atividade['log_atividades']['descricao_verbo']; ?></small>
            </td>
        </tr>
    <?php } ?>
</table>
</div>


</div>

</div>
