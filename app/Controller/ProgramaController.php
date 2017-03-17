<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProgramaController
 *
 * Controller responsável por todas as views de Programa
 * @author Matheus Odilon
 */
class ProgramaController extends AppController {
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

    /**
     * 
     */
    public function index() {
        $this->layout = '';
        session_start();
        $logado = $this->Session->read('jogadorLogado');

        $programas = $this->Programa->getProgramasPorJogador($logado['funcionario']['id']);

        $this->set('programas', $programas);
        $this->set('logado', $logado);
    }

    public function personagens($programaId = null) {
        $this->layout = '';
        session_start();
        $logado = $this->Session->read('jogadorLogado');

        $personagens = $this->Programa->getPersonagensPorPrograma($programaId);
        $this->Session->write("programaIdClicked", $programaId);

        $rodadas = $this->Programa->buscaRodadasPorPrograma($programaId, $logado['funcionario']['id']);

        $this->set('rodadas', $rodadas);
        $this->set('personagens', $personagens);
        $this->set('logado', $logado);
    }

    public function decrescePersonagem() {
        $this->autoRender = false;
        session_start();
        $logado = $this->Session->read('jogadorLogado');

        $personagem_id = $this->request->data['personagem_id'];

        //
        $this->Programa->decresceQuantidadePersonagem($personagem_id);

        $dados['personagem_id'] = $personagem_id;
        $dados['jogador_id'] = $logado['funcionario']['id'];
        $dados['programa_id'] = $this->Session->read("programaIdClicked");

        //
        $this->Programa->insertJogadoresSelecionaPersonagem($dados);
    }

    public function rodada() {
        $this->layout = '';
        session_start();
        $logado = $this->Session->read('jogadorLogado');
        $programaID = $this->Session->read("programaIdClicked");
        $rodadaID = 0;
        $contadorRodada = 0;

        $rodadas = $this->Programa->buscaRodadasPorPrograma($programaID, $logado['funcionario']['id']);

        /**
         * verificamos qual rodada ainda não foi realizada
         */
        foreach ($rodadas as $rodada) {

            if ($rodada['programahistoricojogadorrodadas']['id'] == '') {
                $contadorRodada++;
                $rodadaID = $rodada['programarodadas']['id'];

                break;
            }
        }

        $this->Session->write("programaRodadaID", $rodadaID);

        /**
         * Agora vamos buscar os objetos da rodada
         */
        $objs = $this->Programa->buscaObjetosPorRodada($rodadaID);
        $objetos = '';
        $contador = 0;
        foreach ($objs as $obj) {
            $objetos[$contador] = $obj;
            $objetos[$contador]['respostas'] = $this->Programa->buscaRespostasPorObjeto($obj['objetos']['id']);

            $contador++;
        }

        $this->set('objetos', $objetos);
        $this->set('logado', $logado);
        $this->set('contadorRodada', $contadorRodada);
    }

    /**
     * 
     */
    public function realizaPrograma() {
        $this->autoRender = false;

        session_start();
        $logado = $this->Session->read('jogadorLogado');
        $pontos = 0;
        $rodadaID = $this->Session->read("programaRodadaID");

        $objetosDoPrograma = $this->Programa->buscaObjetosPorRodada($rodadaID);

        /**
         * recuperando pontos das respostas de escala  
         */
        foreach ($objetosDoPrograma as $objeto) {
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
        $this->Programa->addPontosJogador($logado['funcionario']['id'], $pontos);

        $this->redirect(array("controller" => 'Programa',
            "action" => "rodadaSucesso/"));
    }

    /**
     * mostra mensagem após terminar rodada
     */
    public function rodadaSucesso() {
        $this->layout = '';
        session_start();

        $logado = $this->Session->read('jogadorLogado');
        $this->set('logado', $logado);
    }

}
