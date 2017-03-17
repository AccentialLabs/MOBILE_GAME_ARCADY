<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AcaoController
 *
 * @author user
 */
class AcaoController extends AppController {
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

        $acoes = $this->Acao->buscaAcoesPorJogador($logado['funcionario']['id']);

        $jogadorAcaoIDS = '';
        foreach ($acoes as $acao) {
            $jogadorAcaoIDS[$acao['jogadoracao']['acao_id']] = $acao['jogadoracao']['id'];
        }

        //salvando array de acao/Jogador na Sessão
        $this->Session->write("jogadorAcaoIDS", $jogadorAcaoIDS);

        $this->set('acoes', $acoes);
    }

    public function responderAcao($acaoID = null) {
        $this->layout = '';

        $objs = $this->Acao->buscaObjetosPorAcao($acaoID);
        $objetos = '';
        $contador = 0;
        foreach ($objs as $obj) {
            $objetos[$contador] = $obj;
            $objetos[$contador]['respostas'] = $this->Acao->buscaRespostasPorObjeto($obj['objetos']['id']);
            $contador++;
        }

        $this->set('objetos', $objetos);
    }

    /**
     * Startado quando clicado no borão "Enviar respostas"
     * Cria um historico de Acao com os dados referentes as respostas do usuário
     */
    public function finalizarAcao() {
        $this->autoRender = false;
        session_start();
        $logado = $this->Session->read('jogadorLogado');

        $historico = "";
        $acertos = 0;
        $erros = 0;
        $pontosSomados = 0;
        $qtdObjetos = 0;
        $acaoID = 0;
        $jogadorID = $logado['funcionario']['id'];

        $formularios = $this->request->data;

        $objetos = $formularios['objetos'];
        $respostas = $formularios['respostas'];

        $qtdObjetos = count($objetos);
        $acaoID = $formularios['acao_id'];

        foreach ($respostas as $resposta) {
            $resp = explode("-", $resposta);
            //GANHA OU PERDE
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

        $historico['jogador_id'] = $jogadorID;
        $historico['acao_id'] = $acaoID;
        $historico['qtd_objetos'] = $qtdObjetos;
        $historico['acertos'] = $acertos;
        $historico['erros'] = $erros;
        $historico['pontos_somados'] = $pontosSomados;

        $jogadorAcaoID_array = $this->Session->read('jogadorAcaoIDS');
        $jogadorAcaoID = $jogadorAcaoID_array[$acaoID];

        //salva historio da resposta da Acao
        $this->Acao->insereHistoricoAcaoJogador($historico);
        $this->Acao->mudaStatusJogadoracao($jogadorAcaoID);

        $ganhouOuPerdeu = '';
        if ($pontosSomados > 0) {
            $ganhouOuPerdeu = "ganhou";
        } else {
            $ganhouOuPerdeu = "perdeu";
        }

        $this->redirect(array('controller' => 'Acao', 'action' => 'mostraPontos/' . $ganhouOuPerdeu . '/' . $pontosSomados));
    }

    public function mostraPontos($ganhouOuPerdeu, $qtdPontos) {
        $this->layout = '';
        
        $this->set("ganhouPerdeu", $ganhouOuPerdeu);
        $this->set("pontos", $qtdPontos);
    }

}
