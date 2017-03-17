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
echo $this->fetch('css');

echo $this->Html->script('backButtonjs') . "\n";
echo $this->fetch('script');
?>

<?php

echo $this->Html->script('Acao') . "\n";
echo $this->fetch('script');

?>

<?php echo $this->Element('header_menu'); ?>

<style>

    .acoes-incompletas{
        padding-top: 10px;
    }

    .acoes-incompletas .breadcrumb{
        padding: 5px 15px;
    }

    .acoes-incompletas .breadcrumb li{
        width: 100%;
    }

    .acoes-incompletas .breadcrumb li span.label-default{
        background: #333;
    }

    .acoes-completas{
        padding-top: 10px;
    }

    .painel-acao{
        padding: 3px;
    }

    .estrela-acao{
        color: orange;
    }
    .objetos-responder-acao{
        padding-top: 10px;
        padding-bottom: 10px;
        font-family: sans-serif;
    }
</style>

<div class="container ">

    <form method="post" action="../finalizarAcao">
        <div class="acoes-incompletas">
            <ol class="breadcrumb row">
                <li><strong><span class="glyphicon glyphicon-chevron-left volta-acao"></span></strong>  <small><?php echo '  '.$objetos[0]['acoes']['acoes']; ?></small> </li>
            </ol>
        </div>

        <input type="hidden" name="data[acao_id]" value="<?php echo $objetos[0]['acoes']['id']; ?>" />
     <?php 
     
     $contador = 0;
     foreach($objetos as $objeto){?>

        <input type="hidden" name="data[objetos][<?php echo $contador; ?>]" value="<?php echo $objeto['objetos']['id'];?>"/>
        <div class="jumbotron objetos-responder-acao">
            <p><small><small><small><strong><?php echo $objeto['objetos']['descricao'];?></strong></small></small></small></p>

            <p class="text-right"><small><small><small><small>válido até: <?php $date=date_create($objeto['acoes']['datatermino']); echo ' '.date_format($date,"Y/m/d"). ' - '. $objeto['acoes']['horatermino'];  ?></small></small></small></small></p>
         <?php if($objeto['objetos']['tipo_resposta'] == 'DESCRITIVA'){ ?>
            <textarea class="form-control" rows="4" name="data[respostas][<?php echo $contador; ?>]"></textarea>
         <?php }else if($objeto['objetos']['tipo_resposta'] == 'ALTERNATIVA'){ 
             foreach($objeto['respostas'] as $resposta){ ?>

            <div class="radio">
                <label><input type="radio" name="data[respostas][<?php echo $contador; ?>]" value="<?php echo $resposta['respostasobjeto']['ganha_perde']; ?>-<?php echo $resposta['respostasobjeto']['qtd_pontos']; ?>" class="acao-respostas"/><?php echo $resposta['respostasobjeto']['descricao']; ?></label>
            </div>

         <?php }
        }?>
        </div>
        <?php $contador++; }?>

        <!-- <input type="text" id="acaoPontos"/> -->
        <button class="btn btn-primary col-xs-12" type="submit">Enviar respostas</button>
    </form>
</div>

