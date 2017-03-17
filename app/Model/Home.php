<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Home
 *
 * @author user
 */
class Home extends AppModel {

    //put your code here
    var $useTable = false;

    public function getRankingGeral() {
        return($this->query("select * from ranking inner join funcionario on funcionario.id = ranking.jogador_id order by ranking.pontos DESC;"));
    }

    public function buscaTodosConteudos() {
        return($this->query("select * from conteudo;"));
    }

    public function buscaConquistasPorJogador() {

        return($this->query("select * from tiporeconhecimento left join jogador_reconhecimentos on jogador_reconhecimentos.reconhecimento_id = tiporeconhecimento.id order by tiporeconhecimento.id"));
    }

    public function buscaLogAtividades() {

        return($this->query("select * from log_atividades;"));
    }

    public function buscaLogAtividadesPorJogador($jogador_id) {
        return($this->query("select * from log_atividades where jogador_id = {$jogador_id};"));
    }

    /**
     * 
     * Function responsável por buscar dados de todas as listas abaixo
     * Mostraremos as quantidades faltantes de item do menu com base no retorno das listas
     * 
     * @param type $jogador_id
     */
    public function resumoDashboard($jogador_id = 0) {

        $missoes = $this->query("SELECT * FROM jogadormissoes INNER JOIN missoes ON missoes.id = jogadormissoes.missao_id WHERE jogadormissoes.jogador_id = {$jogador_id} and jogadormissoes.realizado = 0 order by missoes.datatermino DESC;");

        $desafios = $this->query("
                                    SELECT * FROM desafio INNER JOIN jogadordesafios ON jogadordesafios.desafio_id = desafio.id AND jogadordesafios.jogador_id = {$jogador_id} AND jogadordesafios.realizado = 0 order by desafio.datatermino DESC;");

        $programas = $this->query("select * from jogadorprograma inner join funcionario on funcionario.id = jogadorprograma.jogador_id inner join programas on programas.id = jogadorprograma.programa_id where funcionario.id = {$jogador_id} ORDER BY programas.datatermino DESC;");

        $acoes = $this->query("SELECT * FROM jogadoracao INNER JOIN acoes ON acoes.id = jogadoracao.acao_id WHERE jogador_id = {$jogador_id} order by acoes.datatermino DESC;");

        $conquistas = $this->query("select * from tiporeconhecimento left join jogador_reconhecimentos on jogador_reconhecimentos.reconhecimento_id = tiporeconhecimento.id order by tiporeconhecimento.id");

        $param['missoes'] = $missoes;
        $param['desafios'] = $desafios;
        $param['programas'] = $programas;
        $param['acoes'] = $acoes;
        $param['conquistas'] = $conquistas;

        return $param;
    }

    public function buscaRankingPorPosicao() {

        return $this->query("select * from ranking_posicoes inner join funcionario on funcionario.id = ranking_posicoes.jogador_id order by ranking_posicoes.pontos DESC;");
    }

    public function updateRankingPorPosicao($data) {

        $query = "UPDATE ranking_posicoes SET pontos = {$data['pontos']}, posicao_atual = {$data['posicao_atual']}, posicao_anterior = {$data['posicao_anterior']} WHERE id = {$data['id']}";
        $this->query($query);
    }

    public function adicionaRankingPorPosicao($jogador_id, $posicao_atual, $posicao_anterior, $pontos) {


        $query = "INSERT INTO ranking_posicoes(`jogador_id`, `posicao_atual`, `posicao_anterios`, `pontos`) VALUES({$jogador_id}, {$posicao_atual}, {$posicao_anterior}, {$pontos});";
        $this->query($query);
    }

}
