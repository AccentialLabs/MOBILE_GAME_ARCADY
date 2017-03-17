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
echo $this->Html->css('home', null, array('media' => 'screen')) . "\n";
echo $this->fetch('css');

echo $this->Html->script('backButtonjs') . "\n";
echo $this->fetch('script');
?>


<?php echo $this->Element('header_menu'); ?>


<div class="jumbotron text-center game-page-title">
    <h4>Ranking Geral</h4>      
</div>   
<div class="container row">
<?php //print_r($rankingPos); ?>
    <table class="table table-striped raking-table">
        <thead>
            <tr>
                <th colspan="3" class="text-center"><small>Posiçao Jogador</small></th>
            </tr>
        </thead>
        <tbody>
        <!-- Definimos como regra de negocio mostrar no 
                ranking somente metade dos jogadores cadastrados -->
            <?php                 
                $totalRanking = count($ranking); 
                $metadeTotal = ($totalRanking/2); ?>
            <?php $contador = 1; foreach($rankingPos as $position){
                    //if($contador < $metadeTotal){?>
            <tr>
                <td><?php echo $contador; ?></td>
                <td><div class="center-cropped img-circle ranking-foto" 
     style="background-image: url('<?php echo $position['funcionario']['urlfoto']; ?>');">
</div></td>
                <td><small><?php echo $position['funcionario']['nome'].'<br/><small>'.$position['ranking_posicoes']['pontos'].'</small>'; ?></small></td>
                <td><?php if($position['ranking_posicoes']['posicao_atual'] < $position['ranking_posicoes']['posicao_anterior']){echo "<span class='glyphicon glyphicon-chevron-up up-position'></span>"; }else if($position['ranking_posicoes']['posicao_atual'] > $position['ranking_posicoes']['posicao_anterior']){ echo "<span class='glyphicon glyphicon-chevron-down down-position'></span>"; }else if($position['ranking_posicoes']['posicao_atual'] == $position['ranking_posicoes']['posicao_anterior']){ echo "<span class='glyphicon glyphicon-unchecked'></span>";  }?></td>
            </tr>
            <?php $contador++;} //}?>
        </tbody>
    </table>

</div>
