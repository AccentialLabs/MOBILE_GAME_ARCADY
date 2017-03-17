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
echo $this->Html->css('home', null, array('media' => 'screen')) . "\n";
echo $this->Html->css('game-page-title', null, array('media' => 'screen')) . "\n";
echo $this->Html->css('atividades', null, array('media' => 'screen')) . "\n";
echo $this->Html->css('acao/Acao', null, array('media' => 'screen')) . "\n";
echo $this->fetch('css');

echo $this->Html->script('backButtonjs') . "\n";
echo $this->fetch('script');
?>

<?php

echo $this->Html->script('Acao') . "\n";
echo $this->fetch('script');

?>

<?php echo $this->Element('header_menu'); ?>


<div class="jumbotron text-center game-page-title">
   <h4 class="pull-left" id="page-back-btn"><span class="glyphicon glyphicon-menu-left"> </span></h4>  <h4>Açoes</h4>      
</div>   
<div class="container">

    <div class="col-md-12 text-center">
        <div class="col-md-12 btn-group text-center" role="group" aria-label="...">
            <button type="button" value="incompletas" class="btn btn-default especial-button btn-completo-incompleto active">Incompletas</button>
            <button type="button" value="completas" class="btn btn-default especial-button btn-completo-incompleto">Completas</button>
        </div>
    </div>

<?php 
/**
* Contamos quantidade de registros incompletos
*/ 
    $contadorIncompleto = 0;
 foreach($acoes as $acao){
if($acao['jogadoracao']['realizado'] == 0){
$contadorIncompleto++;
} }
?>

    <div class="acoes-incompletas lista-acoes-corpo">
        <ol class="breadcrumb row">
            <li><small>Ações incompletas</small> <span class="label label-default pull-right"><?php echo $contadorIncompleto;?></span></li>
        </ol>

        <?php 
$contadorDeAcoes = 0;
 foreach($acoes as $acao){

    if($acao['jogadoracao']['realizado'] == 0){
?>
        <div class="panel panel-default">
             <a href="../Acao/responderAcao/<?php echo $acao['acoes']['id'];?>"><div class="panel-body painel-acao">
                <small><span class="glyphicon glyphicon-star estrela-acao"></span> <small>90 Pontos</small></small>
                <p class="text-center"><small><strong><?php echo $acao['acoes']['acoes'];?></strong></small></p>
                <p><small><?php echo $acao['acoes']['dicatela'];?></small></p>
<br/>
<div class="text-center">
<small><small><span class="glyphicon glyphicon-info-sign"></span> <?php $date=date_create($acao['acoes']['datatermino']); echo 'Válido até '.date_format($date,"Y/m/d");  ?></small></small>
</div>
                 </div></a>
        </div>
        <?php $contadorDeAcoes++; } } 
        if($contadorDeAcoes == 0){?>
        <div class="col-xs-12 text-center"><small class="label label-default">Não existem Ações incompletas no momento.</small></div>
<?php } ?>
    </div>


    <div class="acoes-completas lista-acoes-corpo">
            <ol class="breadcrumb row">
            <li><small>Ações completas</small> </li>
        </ol>

<?php
 foreach($acoes as $acao){
    if($acao['jogadoracao']['realizado'] == 1){
?>
        <div class="panel panel-default">
             <div class="panel-body painel-acao painel-acao-realizada">
                <small><span class="glyphicon glyphicon-star estrela-acao"></span> <small>90 Pontos</small></small>
                <p class="text-center"><small><strong><?php echo $acao['acoes']['acoes'];?></strong></small></p>
<p><small><?php echo $acao['acoes']['dicatela'];?></small></p>
                 </div>
        </div>
        <?php } }?>

    </div>
</div>

