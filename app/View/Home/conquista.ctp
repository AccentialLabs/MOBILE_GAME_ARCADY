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
echo $this->Html->script('conquista') . "\n";
echo $this->fetch('script');
?>
<?php
echo $this->Html->css('game-menu', null, array('media' => 'screen')) . "\n";
echo $this->Html->css('home', null, array('media' => 'screen')) . "\n";
echo $this->Html->css('game-page-title', null, array('media' => 'screen')) . "\n";

echo $this->Html->css('home/conquista', null, array('media' => 'screen')) . "\n";
echo $this->fetch('css');

echo $this->Html->script('backButtonjs') . "\n";
echo $this->fetch('script');
?>


<?php echo $this->Element('header_menu'); ?>



<div class="jumbotron text-center game-page-title">
    <h4>Conquista</h4>      
</div>   
<div style="position: fixed; background: #000; opacity: 0.7; width: 100%; height: 100%; top:0; z-index: 999; display: none;" id="fundo-conquista"> </div>

<div class="container container-badge-conquista" style="overflow: auto;">
    <div class="col-md-6 text-center"> 

    <?php foreach($conquistas as $conquista){?>

        <div class="col-xs-6 text-center home-dashboard <?php if(empty($conquista['jogador_reconhecimentos']['id'])){ echo 'conquista-bloqueada'; }else{ echo "conquista-desbloqueada";}?> ">
            <img src="<?php echo $conquista['tiporeconhecimento']['badge']; ?>" width="60" height="60" /><br/> 
                <?php echo $conquista['tiporeconhecimento']['conquista']; ?>
                <?php if(!empty($conquista['jogador_reconhecimentos']['id'])){?>
            <span class="glyphicon glyphicon-plus conquista-detalhes"></span>

            <div class="conquista-detalhes-corpo text-left col-md-8 pull-right">
                <small><small>
                        <p>
                            <span class="glyphicon glyphicon-time"></span> <?php $date=date_create($conquista['jogador_reconhecimentos']['datacriacao']); echo ' '.date_format($date,"Y/m/d");  ?><br/>
                            <span class="glyphicon glyphicon-user"></span> 5 possuem (1º)
                        </p>

                    </small></small>
            </div>
                <?php }?>
        </div>
    <?php }?>
    </div>

</div>


