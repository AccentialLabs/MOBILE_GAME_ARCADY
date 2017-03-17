<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Programa
 *
 * @author user
 */
class Programa extends AppModel {

    //put your code here
    var $useTable = false;

    /**
     * retorna programas cadastrados
     * para esse jogador e/ou sua(s) equipes
     * @param type $jogador_id
     */
    public function getProgramasPorJogador($jogador_id) {
        $programas = '';
        $programas = $this->query("select * from jogadorprograma inner join funcionario on funcionario.id = jogadorprograma.jogador_id inner join programas on programas.id = jogadorprograma.programa_id where funcionario.id = {$jogador_id};");

        /**
         * busca quantidade de rodadas por programa
         */
        $contador = 0;
        foreach ($programas as $programa) {
            $programa['rodadas'] = $this->query("select count(*) qtd from programarodadas where programa_id = {$programa['programas']['id']};");
            $programas[$contador] = $programa;
            $contador++;
        }

        return $programas;
    }

    /**
     * Retorna os personagens que serão selecionados
     * pelos jogadores nos programas
     * @param type $programa_id
     * @return type
     */
    public function getPersonagensPorPrograma($programa_id) {
        $personagens = $this->query("SELECT * FROM personagemprograma WHERE personagemprograma.programa_id = {$programa_id} and quatidademaxima > 0;");
        return $personagens;
    }

    /**
     * 
     * @param type $personagem_id
     */
    public function decresceQuantidadePersonagem($personagem_id) {
        $this->query("update personagemprograma set `quatidademaxima` = `quatidademaxima` - 1 WHERE id = {$personagem_id}; ");
    }

    public function insertJogadoresSelecionaPersonagem($dados) {

        $data_criacao = date('Y-m-d');
        $sql = "INSERT INTO `gaming`.`programajogadorespersonagens`" .
                "(`jogador_id`," .
                "`personagem_id`," .
                "`programa_id`," .
                "`data_criacao`)" .
                "VALUES("
                . "{$dados['jogador_id']},"
                . "{$dados['personagem_id']},"
                . "{$dados['programa_id']},"
                . "'{$data_criacao}');";

        $this->query($sql);
    }

    public function buscaRodadasPorPrograma($programa_id, $jogador_id) {
        return $this->query("select * from programarodadas left join programahistoricojogadorrodadas on programahistoricojogadorrodadas.programarodada_id = programarodadas.id and programahistoricojogadorrodadas.jogador_id = {$jogador_id} where programarodadas.programa_id = {$programa_id};");
    }

    /**
     * Busca os objetos que foram cadastrados para serem respondidos na rodada vigente
     * @param type $rodada_id
     * @return type
     */
    public function buscaObjetosPorRodada($rodada_id = 0) {
        return $this->query("select * from programarodadaobjetos"
                        . " inner join objetos on objetos.id = programarodadaobjetos.objeto_id "
                        . "where programarodadaobjetos.programarodada_id = $rodada_id;");
    }

    /**
     * respostas por objeto
     * @param type $objeto_id
     * @return type
     */
    public function buscaRespostasPorObjeto($objeto_id) {
        return($this->query("select * from respostasobjeto WHERE objeto_id = {$objeto_id};"));
    }

    
    public function addPontosJogador($jogador = 0, $qtdPontos = 0) {
        return($this->query("update ranking set pontos = pontos + {$qtdPontos} where jogador_id = {$jogador};"));
    }

}
