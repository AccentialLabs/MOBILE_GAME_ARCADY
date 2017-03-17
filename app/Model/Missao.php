<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Missao
 * OBS: As funções estao em ordem de hierarquia (MISSOES > ETAPAS > OBJETOS > RESPOSTAS)
 * @author user
 */
class Missao extends AppModel {

    //put your code here
    var $useTable = false;

    /**
     * missões por jogador
     * @param type $jogador_id
     * @return type
     */
    public function getMissoesPorJogador($jogador_id) {
        $missoes = '';
        $missoes = $this->query("SELECT * FROM jogadormissoes INNER JOIN missoes ON missoes.id = jogadormissoes.missao_id WHERE jogadormissoes.jogador_id = {$jogador_id};");

        //buscando etapas das missões
        $contador = 0;
        foreach ($missoes as $missao) {
            $missao['etapas'] = $this->query("select * from missaoetapas LEFT JOIN misseosetapashistoricos on misseosetapashistoricos.missao_etapa_id = missaoetapas.id where missaoetapas.missao_id = {$missao['missoes']['id']};");
            $missoes[$contador] = $missao;
            $contador++;
        }

        return $missoes;
    }

    /**
     * etapas por missão
     * @param type $missao_id
     * @return type
     */
    public function getEtapasPorMissao($missao_id) {
        return $this->query("select * from missaoetapas INNER JOIN missoes on missoes.id = missaoetapas.missao_id LEFT JOIN misseosetapashistoricos on misseosetapashistoricos.missao_etapa_id = missaoetapas.id where missaoetapas.missao_id = {$missao_id};");
    }

    /**
     * objetos por etapa
     * @return type
     */
    public function buscaObjetosPorEtapa($etapa_id) {
        return $this->query("SELECT * FROM missaoetapaobjetos "
                        . "INNER JOIN objetos ON objetos.id = missaoetapaobjetos.objeto_id "
                        . " INNER JOIN missaoetapas ON missaoetapas.id = missaoetapaobjetos.missaoetapa_id "
                        . " WHERE missaoetapaobjetos.missaoetapa_id = {$etapa_id} ORDER BY missaoetapaobjetos.ordem;");
    }

    /**
     * respostas por objeto
     * @param type $objeto_id
     * @return type
     */
    public function buscaRespostasPorObjeto($objeto_id) {
        return($this->query("select * from respostasobjeto WHERE objeto_id = {$objeto_id};"));
    }

    public function insereHistoricoMissaoJogador($historico) {
        $hoje = date('Y-m-d');
        return($this->query("INSERT INTO `gaming`.`misseosetapashistoricos`"
                        . "( "
                        . "`missao_id`,"
                        . "`missao_etapa_id`,"
                        . "`jogador_id`,"
                        . "`qtd_objetos`,"
                        . "`acertos`,"
                        . "`erros`,"
                        . "`pontos_somados`,"
                        . "`dataregistro`,"
                        . "`status`,"
                        . "`respostas`)"
                        . "VALUES("
                        . "{$historico['missao_id']},"
                        . "{$historico['missao_etapa_id']},"
                        . "{$historico['jogador_id']},"
                        . "{$historico['qtd_objetos']},"
                        . "{$historico['acertos']},"
                        . "{$historico['erros']},"
                        . "{$historico['pontos_somados']},"
                        . "'{$hoje}',"
                        . "'CONCLUIDO',"
                        . "'{$historico['respostas']}'"
                        . ");"));
    }

    public function addPontosJogador($jogador = 0, $qtdPontos = 0) {
        return($this->query("update ranking set pontos = pontos + {$qtdPontos} where jogador_id = {$jogador};"));
    }

    public function salvaLogDoJogador($jogador_id = 0, $nome_jogador = null) {

        $dat = date('Y-m-d');
        $sql = "INSERT INTO `gaming`.`log_atividades`" .
                "(`jogador_id`," .
                "`data`," .
                "`tipo`," .
                "`descricao_verbo`)" .
                "VALUES("
                . "{$jogador_id},"
                . "'{$dat}',"
                . "'missao',"
                . "'{$nome_jogador} acabou de finalizar mais uma etapa de missão');";

        $this->query($sql);
    }

}
