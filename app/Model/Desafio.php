<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Desafio
 *
 * @author user
 */
class Desafio extends AppModel {

    //put your code here
    var $useTable = false;

    public function buscaDesafiosPublicos($jogador_id) {
        return ($this->query("SELECT * FROM desafio"
                        . " LEFT JOIN jogadordesafios ON jogadordesafios.desafio_id = desafio.id AND jogadordesafios.jogador_id = {$jogador_id} AND jogadordesafios.realizado = 0"
                        . " WHERE desafiantetodos = 1 AND datainicio < NOW() AND datatermino > NOW() AND horainicio < NOW() AND horatermino > NOW();"));
    }

    public function buscaJogadores() {
        return $this->query("SELECT * FROM funcionario WHERE status = 1;");
    }

    public function buscaObjetosPorDesafio($desafio_id) {

        return $this->query("SELECT * FROM dasafioobjetos INNER JOIN objetos ON objetos.id = dasafioobjetos.objeto_id WHERE dasafioobjetos.desafio_id = {$desafio_id};");
    }

    /**
     * respostas por objeto
     * @param type $objeto_id
     * @return type
     */
    public function buscaRespostasPorObjeto($objeto_id) {
        return($this->query("select * from respostasobjeto WHERE objeto_id = {$objeto_id};"));
    }

    /**
     * muda o status do JogadorDesafios para realizado
     * @param type $desafio_id
     */
    public function realizaDesafio($desafio_id, $jogador_id) {
        $this->query("UPDATE jogadordesafios SET realizado = 1 WHERE desafio_id = {$desafio_id} and jogador_id = {$jogador_id};");
    }

    public function addPontosJogador($jogador = 0, $qtdPontos = 0) {
        return($this->query("update ranking set pontos = pontos + {$qtdPontos} where jogador_id = {$jogador};"));
    }

    public function addDesafio($jogador_id, $desafio_id, $desafiante_id) {
        $data = date('Y-m-d');
        
        $this->query("INSERT INTO jogadordesafios(desafio_id, jogador_id, dataatribuicao, realizado, isdesafiante, desafiante_id)"
                . "VALUES({$desafio_id}, {$jogador_id}, '{$data}', 0, 0, {$desafiante_id});");
        
    }
    
}
