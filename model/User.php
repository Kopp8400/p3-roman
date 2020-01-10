<?php

class User extends Model{
    var $validate = array(
        'name' => array(
            'rule' => 'notEmpty',
            'message' => 'Vous devez rentrer un nom d\'utilisateur'   
        ),
        'password' => array(
            'rule' => '([a-z0-9\-]+)',
            'message' => 'Mot de passe non valide'
        )
    );
}