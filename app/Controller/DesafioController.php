<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DesafioController
 *
 * @author user
 */
class DesafioController extends AppController {
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

        $desafios = $this->Desafio->buscaDesafiosPublicos($logado['funcionario']['id']);

        $this->set('logado', $logado);
        $this->set('desafios', $desafios);
    }

    public function escolheDesafiado($desafio_id) {

        $this->layout = '';
        session_start();
        $logado = $this->Session->read('jogadorLogado');

        $jogadores = $this->Desafio->buscaJogadores();

        $this->Session->write('desafioID', $desafio_id);

        $this->set('logado', $logado);
        $this->set('jogadores', $jogadores);
    }

    public function objetosDesafio($desafio_id = 0) {
        $this->layout = '';
        session_start();
        $logado = $this->Session->read('jogadorLogado');

        $objs = $this->Desafio->buscaObjetosPorDesafio($desafio_id);

        $objetos = '';
        $contador = 0;
        foreach ($objs as $obj) {
            $objetos[$contador] = $obj;
            $objetos[$contador]['respostas'] = $this->Desafio->buscaRespostasPorObjeto($obj['objetos']['id']);

            $contador++;
        }

        $this->Session->write('desafioID', $desafio_id);

        $this->set('objetos', $objetos);
        $this->set('logado', $logado);
    }

    public function realizaDesafio() {
        $this->layout = '';
        session_start();
        $logado = $this->Session->read('jogadorLogado');
        $pontos = 0;


        $desafioID = $this->Session->read('desafioID');

        /*
         * mudando status do desafio para REALIZADO
         */
        $this->Desafio->realizaDesafio($desafioID, $logado['funcionario']['id']);

        $objetosDoDesafio = $this->Desafio->buscaObjetosPorDesafio($desafioID);

        /**
         * recuperando pontos das respostas de escala  
         */
        foreach ($objetosDoDesafio as $objeto) {
            if ($objeto['objetos']['escala'] == 1) {
                $selecaoEscala = $_POST[$objeto['objetos']['id']];
                if ($selecaoEscala > $objeto['objetos']['pontuacao_ponto_medio']) {
                    $pontos = $pontos + $objeto['objetos']['pontuacao_ponto_medio_acima'];
                } else if ($selecaoEscala < $objeto['objetos']['pontuacao_ponto_medio']) {
                    $pontos = $pontos + $objeto['objetos']['pontuacao_ponto_medio_abaixo'];
                }
            }
        }

        /**
         * recuperando pontos das respostas alternativas
         */
        foreach ($_POST['data']['respostas'] as $resposta) {
            $arrayResp = explode('-', $resposta);

            if ($arrayResp[0] == 'ganha') {
                $pontos = $pontos + $arrayResp[1];
            } else if ($arrayResp[0] == 'perde') {
                $pontos = $pontos - $arrayResp[1];
            }
        }

        //adicionar pontos ao ranking do usuário
        $this->Desafio->addPontosJogador($logado['funcionario']['id'], $pontos);
    }

    /**
     * Cria registro de Desafio para o usuário desafiado
     */
    public function desafiaJogador() {
        $this->autoRender = false;
        session_start();
        $logado = $this->Session->read('jogadorLogado');

        $desafiado_id = $this->request->data['desafiadoID'];
        $desafioID = $this->Session->read('desafioID');

        $this->Desafio->addDesafio($desafiado_id, $desafioID, $logado['funcionario']['id']);

        $this->redirect(array("controller" => 'Desafio',
            "action" => "objetosDesafio/" . $desafioID));
    }

    /**
     * Invalida desafio sem registro de objetos
     * executa quando clicado no botão "VOLTAR" da página objetosDesafio
     */
    public function desafioInvalido() {
        $this->autoRender = false;
          session_start();
        $logado = $this->Session->read('jogadorLogado');

        $desafioID = $this->Session->read('desafioID');
        /*
         * mudando status do desafio para REALIZADO
         */
        $this->Desafio->realizaDesafio($desafioID, $logado['funcionario']['id']);
       $this->redirect(array("controller" => 'Desafio',
            "action" => "index/"));
    }

}
