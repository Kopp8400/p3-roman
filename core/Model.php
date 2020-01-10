<?php

class Model{

    static $connections = array();

    public $conf = 'default';
    public $table = false;
    public $db;
    public $primaryKey = 'id';
    public $id;
    public $errors = array();
    public $form;

    public function __construct(){

         // INITIALIZE SOME VAR
        if ($this->table === false) {
            $this->table = strtolower(get_class($this)).'s';
        }

        // CONNECTION TO THE DATABASE
        $conf = Conf::$databases[$this->conf];
        if (isset(Model::$connections[$this->conf])) {
            $this->db = Model::$connections[$this->conf];
            return true;
        }
        try{
            $pdo = new PDO('mysql:host='.$conf['host'].';dbname='.$conf['database'].';',
                $conf['login'],
                $conf['password']
            ); 
            $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);

            Model::$connections[$this->conf] = $pdo;
            $this->db = $pdo;
        }catch(PDOException $e){
            if(Conf::$debug > 1){
                die($e->getMessage());
            }
            else {
                die('Impossible de se connecter à la base de données');
            }
            
        }
       
    }

    public function find($req){
        $primaryKey = 'id';
        $sql = 'SELECT ';

        if (isset($req['fields'])) {
            if (is_array($req['fields'])) {
                $sql .= implode(', ', $req['fields']);
            }else{
                $sql .= $req['fields'];
            }
        }else{
            $sql .='*';
        }

        $sql .= ' FROM '.$this->table.' as '.get_class($this).' ';

        if (isset($req['conditions'])) {
            $sql .= 'WHERE ';
            if (!is_array($req['conditions'])) {
                $sql .= $req['conditions'];
            }else{
                $cond = array();
                foreach ($req['conditions'] as $k=>$v) {
                    if (!is_numeric($v)) {
                        $v = '"'.$v.'"';
                    }
                    $cond[] = "$k=$v";
                }
                $sql .= implode(' AND ', $cond);
            }
            
        $sql .= ' ORDER BY '.$primaryKey.' ASC';
        }
        if (isset($req['limit'])) {
            $sql .= ' LIMIT '.$req['limit'];
            
        }
        $pre = $this->db->prepare($sql);
        $pre->execute();
        return $pre->fetchAll(PDO::FETCH_OBJ);
    }

    public function findFirst($req)
    {
        return current($this->find($req));
    }

    public function findCount($conditions){
        $res = $this->findFirst(array(
            'fields' => 'COUNT('.$this->primaryKey.') as count',
            'conditions' => $conditions
            ));
        return $res->count;
    }

    public function delete($id){
        $sql = "DELETE FROM {$this->table} WHERE {$this->primaryKey} = $id";
        $this->db->query($sql);
        
    }

    public function signal($id, $ref_id){
        $key = $this->primaryKey;
        $fields = array();
        $e = array();
        foreach ($id as $k=>$v) {
            if($k!=$this->primaryKey){
                $fields[] = "$k=:$k";
                $e[":$k"] = $v;
            }elseif(!empty($v)){
                $e[":$k"] = $v;
            }    
        }
        $sql = 'UPDATE '.$this->table.' SET state = state + 1 WHERE id='.$id;
        $pre = $this->db->prepare($sql);      
        $pre->execute($e);
    }

    public function moderate($id, $ref_id){
        $key = $this->primaryKey;
        $fields = array();
        $e = array();
        foreach ($id as $k=>$v) {
            if($k!=$this->primaryKey){
                $fields[] = "$k=:$k";
                $e[":$k"] = $v;
            }elseif(!empty($v)){
                $e[":$k"] = $v;
            }    
        }
        $sql = 'UPDATE '.$this->table.' SET state = state + 2 WHERE id='.$id;
        $pre = $this->db->prepare($sql);      
        $pre->execute($e);
    }

    public function save($data){
        $key = $this->primaryKey;
        $fields = array();
        $d = array();
        foreach ($data as $k=>$v) {
            if($k!=$this->primaryKey){
                $fields[] = "$k=:$k";
                $d[":$k"] = $v;
            }elseif(!empty($v)){
                $d[":$k"] = $v;
            }    
        }
        
        if(isset($data->$key) && !empty($data->$key)){
            $sql = 'UPDATE '.$this->table.' SET '.implode(',', $fields).' WHERE '.$key.'=:'.$key;
            $this->id = $data->$key;
            $action = 'update';
            
        }else{
            if(isset($data->$key)) unset($data->$key);
            $sql = 'INSERT INTO '.$this->table.' SET '.implode(',', $fields);
            $action = 'insert';
        }
        $pre = $this->db->prepare($sql);      
        $pre->execute($d);
        if($action == 'insert'){
            $this->id = $this->db->lastInsertId();
        }
        
    }
    
    function validates($data){
        $errors = array();
        foreach($this->validate as $k=>$v){
            if(!isset($data->$k)){
                $errors[$k] = $v['message'];
            }else{
                if($v['rule'] == 'notEmpty'){
                    if(empty($data->$k)){
                        $errors[$k] = $v['message'];
                    }
                }elseif(!preg_match('/^'.$v['rule'].'$/', $data->$k)){
                    $errors[$k] = $v['message'];
                }
            }
        }
        $this->errors = $errors;
        if(isset($this->Form)){
            $this->Form->errors = $errors;
        }
        if(empty($errors)){
            return true;
        }
        return false;
    }
}












