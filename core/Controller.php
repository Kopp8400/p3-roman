<?php

class Controller{

    public $request;
    public $vars = array(); // VAR PASS TO VIEW
    public $layout = 'default'; // LAYOUT TO USE FOR RENDERING VIEW
    private $rendered = false; // RENDER ??

    function __construct($request = null){
        $this->Session = new Session();
        $this->Form = new Form($this);
        if ($request) {
            $this->request = $request;
            require ROOT.DS.'config'.DS.'hook.php';
        }
    }
    

    /**
     * Permit to render a view
     */
    public function render($view){
        if ($this->rendered) {
            return false;
        }
        extract($this->vars);
        if (strpos($view, '/') ===0) {
            $view = ROOT.DS.'view'.$view.'.php';
        }
        else{
            $view = ROOT.DS.'view'.DS.$this->request->controller.DS.$view.'.php';
        }
        ob_start();
        require($view);
        $content_for_layout = ob_get_clean();
        require ROOT.DS.'view'.DS.'layout'.DS.$this->layout.'.php';
        $this->rendered = true;
    }

    /**
     * Permit to pass var to the view
     */
    public function set($key,$value=null){
        if(is_array($key)){
            $this->vars += $key;
        }
        else{
            $this->vars[$key] = $value;
        }
    }

    /**
     * Permit to load Model
     */
    function loadModel($name){
        if (!isset($this->$name)) {
            $file = ROOT.DS.'model'.DS.$name.'.php';
            require_once($file);
            $this->$name = new $name();
            if(isset($this->Form)){
                $this->$name->Form = $this->Form;
            }
        }
    }

    /**
     * Permit to manage 404 Errors
     */
    function e404($message){
        header("HTTP/1.0 404 Not Found");
        $this->set('message', $message);
        $this->render('/errors/404');
        die();
    }


    function request($controller, $action){
        $controller .= 'Controller';
        require_once ROOT.DS.'controller'.DS.$controller.'.php';
        $c = new $controller();
        return $c->$action();
    }


    function redirect($url,$code = null)
    {
        if ($code == 301) {
            header("HTTP/1.1 301 Moved Permanently");
        }
        header("Location: ".Router::url($url));
    }

}