<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
App::uses('AppController', 'Controller');

/**
 * Description of LoginController
 *
 * @author user
 */
class LoginController extends AppController {
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

    public function splash() {
        $this->layout = '';
    }

    public function index() {
        $this->layout = '';
    }

    public function logar() {
        $this->autoRender = false;
        session_start();

        $email = $this->request->data['email'];
        $senha = $this->request->data['senha'];

        $usuario = $this->Login->logar($email, $senha);

        if (!empty($usuario)) {
            $this->Session->write('jogadorLogado', $usuario[0]);
            $this->redirect("../Home/index");
        } else {
            $this->Session->setFlash(__('Usuário ou senha inválidos.'));
            $this->redirect("index");
        }
    }

    public function logout() {
        session_destroy();
        $this->redirect(array('controller' => 'Login', 'action' => 'index'));
    }

    public function esqueciSenha() {
        $this->layout = '';
    }

    public function trocarSenha() {
        $this->autoRender = false;

        $email = $this->request->data['email'];

        $usuario = $this->Login->perdiMinhaSenha($email);

        print_r($usuario);
    }

}
