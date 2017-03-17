<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Acao
 *
 * @author user
 */
class Acao extends AppModel {

    //put your code here
    var $useTable = false;

    public function buscaAcoesPorJogador($jogador_id) {
        return($this->query("SELECT * FROM jogadoracao INNER JOIN acoes ON acoes.id = jogadoracao.acao_id WHERE jogador_id = {$jogador_id} order by acoes.datatermino;"));
    }

    public function buscaObjetosPorAcao($acao_id) {
        return($this->query(""
                        . "select * from objetos_acoes"
                        . " inner join objetos on objetos.id = objetos_acoes.objeto_id "
                        . "inner join acoes on acoes.id = objetos_acoes.acao_id"
                        . " WHERE acao_id ={$acao_id};"));
    }

    public function buscaRespostasPorObjeto($objeto_id) {
        return($this->query("select * from respostasobjeto WHERE objeto_id = {$objeto_id};"));
    }

    public function insereHistoricoAcaoJogador($historico) {

        $hoje = date('Y-m-d');
        return($this->query(
                        "INSERT INTO acoeshistoricojogadores(
                            `acao_id`," .
                        "`jogador_id`," .
                        "`qtd_objetos`," .
                        "`acertos`," .
                        "`erros`," .
                        "`pontos_somados`," .
                        "`dataregistro`)" .
                        "VALUES("
                        . "{$historico['acao_id']},"
                        . "{$historico['jogador_id']},"
                        . "{$historico['qtd_objetos']},"
                        . "{$historico['acertos']},"
                        . "{$historico['erros']},"
                        . "{$historico['pontos_somados']},"
                        . "'{$hoje}');"));
    }
    
    public function mudaStatusJogadoracao($acao_id){
         return($this->query("UPDATE jogadoracao SET `realizado` = 1 WHERE id = {$acao_id};"));
    }

}
