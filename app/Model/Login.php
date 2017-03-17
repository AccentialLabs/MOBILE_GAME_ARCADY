<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Login
 *
 * @author user
 */
class Login extends AppModel {

    //put your code here
    var $useTable = false;

    public function logar($email, $senha) {
        $senha = md5($senha);
        return($this->query("select * from funcionario inner join empresa on empresa.id = funcionario.empresa_id where funcionario.email LIKE '{$email}' and funcionario.senha LIKE '{$senha}';"));
    }

    public function perdiMinhaSenha($email) {

        $usuario = $this->query("select * from funcionario where email = '{$email}';");

        if (!empty($usuario)) {

            $novaSenha = $this->generateRandomString(5);
            $md5NovaSenha = md5($novaSenha);

            $this->query("update funcionario set senha = '{$md5NovaSenha}' where id = {$usuario['0']['funcionario']['id']};");

            return 'Sua nova senha foi enviada por email! <br/>' . $novaSenha;
        } else {
            return "Usuário não encontrado";
        }
    }

    function generateRandomString($length = 5) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    //put your code here
}
