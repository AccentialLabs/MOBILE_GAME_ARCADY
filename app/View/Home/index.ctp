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

<style>

    .primary-badge{
            background-color: #337ab7 !important;
            float: right !important;
            border-radius: 0px;
    }

    .danger-badge{
            background-color: #d9534f !important;
            float: right !important;
    }
</style>

<?php
echo $this->Html->css('game-menu', null, array('media' => 'screen')) . "\n";
echo $this->Html->css('home', null, array('media' => 'screen')) . "\n";
echo $this->fetch('css');
?>

    <?php //print_r($resumo); ?>
<?php echo $this->Element('header_menu'); ?>

<div>
    
    <div class="col-md-12 text-center"> 
        <a href="../Home/rankingGeral"><div class="col-xs-6 text-center home-dashboard-especial"><span class="glyphicon glyphicon-sort"></span> Ranking</div></a>
        <a href="../Home/atividades"><div class="col-xs-6 text-center home-dashboard-especial"><span class="glyphicon glyphicon-wrench"></span> Atividades</div></a>
        
        <a href="../Home/conquista"><div class="col-xs-6 text-center home-dashboard"><h3><span class="glyphicon glyphicon-glass"></span></h3> Conquistas</div></a>
        <a href="../Home/conteudo"><div class="col-xs-6 text-center home-dashboard"><h3><span class="glyphicon glyphicon-folder-open"></span></h3>Conteúdo</div></a>
        
        <a href="../Acao/index">
            
            <div class="col-xs-6 text-center home-dashboard">

<?php
                if(!empty($resumo['acoes'][0])){
                $today = date('Y-m-d H:i:s');
                $data1 = new DateTime( $resumo['acoes'][0]['acoes']['datatermino']);
                $data2 = new DateTime( $today );
                $intervalo = $data1->diff( $data2 );
                $intervalo = $intervalo->d+1;
                    
                if($intervalo <= 2){
                    echo '<span class="badge danger-badge">7</span>';
                    }else{
                echo '<span class="badge primary-badge">1</span>';
                }

                }
                 ?>

    
            <h3>
                <span class="glyphicon glyphicon-flash"></span>
            </h3> Ações
            </div>
        </a>
        <a href="../Missao/index">
            <div class="col-xs-6 text-center home-dashboard">

                <?php
                if(!empty($resumo['missoes'][0])){
                $today = date('Y-m-d H:i:s');
                $data1 = new DateTime( $resumo['missoes'][0]['missoes']['datatermino']);
                $data2 = new DateTime( $today );
                $intervalo = $data1->diff( $data2 );
                $intervalo = $intervalo->d+1;
                    
                if($intervalo <= 2){
                    echo '<span class="badge danger-badge">7</span>';
                    }else{
                echo '<span class="badge primary-badge">1</span>';
                }

                }
                 ?>
                <h3><span class="glyphicon glyphicon-briefcase"></span></h3>Missões
            </div>
        </a>
        
        <a href="../Programa/index"><div class="col-xs-6 text-center home-dashboard"><h3><span class="glyphicon glyphicon-folder-close"></span></h3> Programas</div></a>
        <a href="../Desafio/index">
            <div class="col-xs-6 text-center home-dashboard">
                
 <?php
                if(!empty($resumo['desafios'][0])){
                $today = date('Y-m-d H:i:s');
                $data1 = new DateTime( $resumo['desafios'][0]['desafio']['datatermino']);
                $data2 = new DateTime( $today );
                $intervalo = $data1->diff( $data2 );
                $intervalo = $intervalo->d+1;
                    
                if($intervalo <= 2){
                    echo '<span class="badge danger-badge">7</span>';
                    }else{
                echo '<span class="badge primary-badge">1</span>';
                }

                }
                 ?>

                <h3><span class="glyphicon glyphicon-fire"></span></h3>Desafios
            </div>
        </a>
            
        <!-- 
            <a href="../Programa/index"><div class="col-xs-12 text-center home-dashboard home-dashboard-especial"><h3>
            <img class="icon icons8-Playing-Filled" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAABIklEQVRoQ+2Y4QrDMAiEm/d/6JXBWrKwDO/qiQn2t0Y/Tw1NOzb52iYcRw/yWhiqFUgy9UqRCEGutrfMLqUIEuAJMBInJcjsSvinDATCBGAUYeKEgCAtwoC/fSAQOsjH0TK0dAzlhci0SIEoFWGry/iFzAiTGOpTIGjF1PalCFLhuhCBalVrAcUKMS1FQsoMBAlRpLZWNkWAfGjTkNaiswMcCwQo1v2+vOyv7gW7xdYa/9tVqshnZAuQsaWULSZVZFmQPvFZ9S02yEa8F4rnc5AlSYtNGpArkdmGUiwA1xmxJmi1Q5RxA2E3Eus3QkpBLI/YaUGQduhtn9747opYkvulVBoQVgkvPzdFvBJizykQtnIqvy9FVEFCzp3t+pDgnkFO9eVaM0pfgKQAAAAASUVORK5CYII=" width="50" height="50"></h3> Mini Games</div></a>
        -->
</div>
    
</div>

