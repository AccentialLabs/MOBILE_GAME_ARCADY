<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of HomeController
 *
 * @author user
 */
class HomeController extends AppController {
    /* Sidebar Menu items */

    private $contextMenuItems = array(
        array('title' => 'Videos', 'url' => array('action' => '../movies/listVideos'), 'attr' => array()),
        array('title' => 'Menu 2', 'url' => array('action' => 'methods'), 'attr' => array()),
        array('title' => 'Menu 2', 'url' => array('action' => 'methods'), 'attr' => array()),
        array('title' => 'Menu 2', 'url' => array('action' => 'methods'), 'attr' => array())
    );

    public function beforeFilter() {
        parent::beforeFilter();

        $this->set('contextMenuItems', $this->contextMenuItems);
    }

    public function index() {
        $this->layout = '';
        session_start();
        $logado = $this->Session->read('jogadorLogado');

        $resumo = $this->Home->resumoDashboard($logado['funcionario']['id']);

        $this->set('resumo', $resumo);
        $this->set('logado', $logado);
    }

    public function rankingGeral() {
        $this->layout = '';
        session_start();
        $logado = $this->Session->read('jogadorLogado');

        $this->set('logado', $logado);

        $ranking = $this->Home->getRankingGeral();
        $rankingPos = $this->Home->buscaRankingPorPosicao();
        $this->set('ranking', $ranking);
        $this->set('rankingPos', $rankingPos);
    }

    public function atividades() {
        $this->layout = '';
        session_start();
        $logado = $this->Session->read('jogadorLogado');

        $atividades = $this->Home->buscaLogAtividades();
        $minhasAtividades = $this->Home->buscaLogAtividadesPorJogador($logado['funcionario']['id']);
        $this->set('atividades', $atividades);
        $this->set('minhasAtividades', $minhasAtividades);
    }

    public function conteudo() {

        $this->layout = '';
        $conteudos = $this->Home->buscaTodosConteudos();
        $this->set('conteudos', $conteudos);
    }

    public function conquista() {

        $this->layout = '';
        $conquistas = $this->Home->buscaConquistasPorJogador();
        $this->set('conquistas', $conquistas);
    }

    /**
     * Função deve estar em uma Cron, onde será executada a cada 5 minutos
     * A função deve organizar a lista de ranking dos jogados por pontos,
     * guardando suas respectivas posições
     * 
     */
    public function atualizaClassificacao() {
        $this->autoRender = false;

        $rankingPerPontos = $this->Home->getRankingGeral();
        $rankingPerPosition = $this->Home->buscaRankingPorPosicao();

        print_r($rankingPerPontos);
        echo "<br/><br/>";
        print_r($rankingPerPosition);

        $novaListaParaAtualizar = null;

        $contador = 0;
        foreach ($rankingPerPontos as $rkng) {

            $novaListaParaAtualizar[$contador]['jogador_id'] = $rkng['ranking']['jogador_id'];
            $novaListaParaAtualizar[$contador]['pontos'] = $rkng['ranking']['pontos'];
            $novaListaParaAtualizar[$contador]['posicao_atual'] = $contador + 1;
            $novaListaParaAtualizar[$contador]['posicao_anterior'] = 0;
            //Vemos se usuário já está cadastrado na lista de ranking por posicao
            //caso esteja, recuramos a posicao anterior do mesmo
            foreach ($rankingPerPosition as $perPosition) {



                if ($perPosition['ranking_posicoes']['jogador_id'] == $rkng['ranking']['jogador_id']) {

                    $novaListaParaAtualizar[$contador]['posicao_anterior'] = $perPosition['ranking_posicoes']['posicao_atual'];
                }
            }

            $contador++;
        }

        // echo "<br/><br/>";
        //print_r($rankingPerPosition);

        /**
         * Incluindo e Editando posicoes na tabela Ranking Posicoes
         */
        foreach ($novaListaParaAtualizar as $posicao) {
            $isValid = false;

            /*
             * Caso registro do usuário já exista, 
             * então editamos
             */
            foreach ($rankingPerPosition as $ranking) {
                if ($ranking['ranking_posicoes']['jogador_id'] == $posicao['jogador_id']) {
                    $isValid = true;

                    //editando registro existente
                    $data = '';
                    $data['pontos'] = $posicao['pontos'];
                    $data['posicao_atual'] = $posicao['posicao_atual'];
                    $data['posicao_anterior'] = $posicao['posicao_anterior'];
                    $data['id'] = $ranking['ranking_posicoes']['id'];

                    //UPDATE
                    $this->Home->updateRankingPorPosicao($data);
                }
            }

            /**
             * Caso não exista,
             * então criamos 
             */
            if ($isValid == false) {

                $this->Home->adicionaRankingPorPosicao($posicao['jogador_id'], $posicao['posicao_atual'], $posicao['posicao_anterior'], $posicao['pontos']);
            }
        }
    }

}
