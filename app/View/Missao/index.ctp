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
echo $this->Html->css('Missao/missao', null, array('media' => 'screen')) . "\n";

echo $this->fetch('css');

echo $this->Html->script('backButtonjs') . "\n";
echo $this->fetch('script');
?>

<?php echo $this->Element('header_menu'); ?>

<div class="jumbotron text-center game-page-title">
  <h4 class="pull-left" id="page-back-btn"><span class="glyphicon glyphicon-menu-left"> </span></h4>   <h4>Missões</h4>      
</div> 
<div class="container">

    <div class="col-md-12 text-center">
        <div class="col-md-12 btn-group text-center" role="group" aria-label="...">
            <button type="button" value="disponiveis" class="btn btn-default especial-button btn-completo-incompleto active">Disponíveis</button>
            <button type="button" value="finalizadas" class="btn btn-default especial-button btn-completo-incompleto">Finalizadas</button>
        </div>
    </div>

    <div class="missoes-disponiveis">
        <ol class="breadcrumb row">
            <li class="col-xs-12"><small>Missões Disponíveis</small> <span class="label label-default pull-right"><?php echo count($missoes);?></span></li>
        </ol>
        <?php foreach ($missoes as $missao) {?>
        <div class="panel panel-default">
          <a href="../Missao/missaoEtapas/<?php echo $missao['missoes']['id'];?>">  <div class="panel-body painel-missao">
                <p class=""><span class="glyphicon glyphicon-certificate"></span><small><strong> <?php echo $missao['missoes']['missao']; ?></strong></small></p>
                <p><small><?php echo $missao['missoes']['dicatela']; ?></small></p>

                 <?php
                 $etapasConcluidas = 0;
                 foreach($missao['etapas'] as $etapa){
                     if(!empty($etapa['misseosetapashistoricos']) && $etapa['misseosetapashistoricos']['status'] == 'CONCLUIDO'){
                         $etapasConcluidas++;
                     }
                 } ?>
               
                
                <div class="progress">
                    <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $etapasConcluidas; ?>" aria-valuemin="0" aria-valuemax="<?php echo count($missao['etapas']); ?>" style="width: 60%;">
                       <?php echo $etapasConcluidas; ?>/<?php echo count($missao['etapas']); ?>
                    </div>
                </div>

                        <?php
                        $contadorEtapa = 1;
                        foreach($missao['etapas'] as $etapa){ ?>
                <div <?php if(!empty($etapa['misseosetapashistoricos']) && $etapa['misseosetapashistoricos']['status'] == 'CONCLUIDO'){ echo 'class="disabled"';} ?>> <input type="checkbox" /> Etapa <?php echo $contadorEtapa;?> </div><br/>

                       <?php $contadorEtapa++;}?>
                <div class="text-center">
                    <!-- <small><small><span class="glyphicon glyphicon-info-sign"></span> <?php $date=date_create($missao['missoes']['datatermino']); echo 'Válido até '.date_format($date,"d/m/Y");  ?></small></small> -->
                </div>
              </div> </a>
        </div>
        <?php } ?>
    </div>

    <div class="missoes-finalizadas"></div>

</div>

