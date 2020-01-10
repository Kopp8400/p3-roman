<?php

class Comment extends Model{
    var $validate = array(
        'username' => array(
            'rule' => 'notEmpty',
            'message' => 'Vous devez préciser un nom d\'utilisateur'   
        ),
        'comment' => array(
            'rule' => 'notEmpty',
            'message' => 'Commentaire non valide'
        )
    );
}