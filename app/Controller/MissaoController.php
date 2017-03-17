<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MissaoController
 *
 * @author user
 */
class MissaoController extends AppController {
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

        $missoes = $this->Missao->getMissoesPorJogador($logado['funcionario']['id']);

        $this->set('logado', $logado);
        $this->set('missoes', $missoes);
    }

    public function missaoEtapas($missao_id) {
        $this->layout = '';
        session_start();
        $logado = $this->Session->read('jogadorLogado');

        $etapas = $this->Missao->getEtapasPorMissao($missao_id);
        $this->set('etapas', $etapas);
        $this->set('logado', $logado);
    }

    public function executarEtapa($etapa = null, $ordem = 0) {
        $this->layout = '';
        session_start();
        $logado = $this->Session->read('jogadorLogado');

        $objs = $this->Missao->buscaObjetosPorEtapa($etapa);
        $objetos = '';
        $contador = 0;
        foreach ($objs as $obj) {
            $objetos[$contador] = $obj;
            $objetos[$contador]['respostas'] = $this->Missao->buscaRespostasPorObjeto($obj['objetos']['id']);

            $contador++;
        }

        $this->set('objetos', $objetos);
        $this->set('logado', $logado);
        $this->set('ordem', $ordem);
    }

    public function finalizaEtapaMissao() {
        $this->autoRender = false;
        session_start();
        $logado = $this->Session->read('jogadorLogado');

        $acertos = 0;
        $erros = 0;
        $pontosSomados = 0;
        $qtdObjetos = 0;

        $formularios = $this->request->data;

        $objetos = $formularios['objetos'];
        $respostas = $formularios['respostas'];

        $qtdObjetos = count($objetos);
        $arrayJSON = '';

        $contadorArrayJSON = 0;
        foreach ($respostas as $resposta) {
            $resp = explode("-", $resposta);
            //GANHA OU PERDE

            $arrayJSON[$contadorArrayJSON]['objeto'] = $objetos[$contadorArrayJSON];
            $arrayJSON[$contadorArrayJSON]['resposta'] = $respostas[$contadorArrayJSON];
            $contadorArrayJSON++;
            if ($resp[0] == 'perde') {
                $erros++;

                //DECRESCE PONTOS 
                if (!empty($resp[1])) {
                    $pontosSomados = $pontosSomados - $resp[1];
                }
            } else if ($resp[0] == 'ganha') {
                $acertos++;

                //INCREMENTA PONTOS 
                if (!empty($resp[1])) {
                    $pontosSomados = $pontosSomados + $resp[1];
                }
            } else {
                
            }
        }

        $historico = '';
        $historico['missao_id'] = $this->request->data['missao_id'];
        $historico['missao_etapa_id'] = $this->request->data['etapa_id'];
        $historico['jogador_id'] = $logado['funcionario']['id'];
        $historico['qtd_objetos'] = $qtdObjetos;
        $historico['acertos'] = $acertos;
        $historico['erros'] = $erros;
        $historico['pontos_somados'] = $pontosSomados;
        $historico['respostas'] = base64_encode(json_encode($arrayJSON));

        //print_r($historico);

        $this->Missao->insereHistoricoMissaoJogador($historico);
        $this->Missao->addPontosJogador($logado['funcionario']['id'], $pontosSomados);

        $this->Missao->salvaLogDoJogador($logado['funcionario']['id'], $logado['funcionario']['nome']);
        
        $this->redirect(array('controller' => 'Missao', 'action' => 'index'));
    }

}
