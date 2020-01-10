<?php

class Form{

    public $controller;
    public $errors;

    public function __construct($controller)
    {
        $this->controller = $controller;
    }

    public function input($name, $label, $options = array())
    {
        $error = false;
        $classError = '';

        if (isset($this->errors[$name]))
        {
            $error = $this->errors[$name];
            $classError = 'error';
        }
        if (!isset($this->controller->request->data->$name))
        {
            $value = '';
        }
        else
        {
            $value = htmlspecialcars($this->controller->request->data->$name);
        }
        if ($label == 'hidden')
        {
            return '<input type="hidden" name="'.$name.'" value="'.$value.'">';
        }

        $attr = '';
        foreach($options as $k=>$v){
            if ($k != 'type') {
                $attr .= "$k=\"$v\"";
            } 
        }
        if(!isset($options['type'])){
            $html = '<div class="col-6 col-12-small">
                        <label for="input'.$name.'">'.$label.'</label>
                        <input type="text" id="input'.$name.'"name="'.$name.'" value="'.htmlspecialchars($value).'"'.htmlspecialchars($attr).'>';
                        
        }
        elseif($options['type'] == 'textarea'){
            $html = '<div class="col-6 col-12-small">
                        <label for="input'.$name.'">'.$label.'</label>
                        <textarea id="mytextarea" id="input'.$name.'" name="'.$name.'"'.$attr.'>'.htmlspecialchars($value).'</textarea>';
        }
        elseif($options['type'] == 'checkbox'){
            $html = '<div class="col-6 col-12-small">
                        <input type="hidden" name="'.$name.'" value="0">
                        <input type="checkbox" id="input'.$name.'" name="'.$name.'" value="1" >
                        <label for="input'.$name.'">'.$label.'</label>';
        }
        elseif($options['type'] == 'password'){
            $html = '<div class="col-6 col-12-small">
                        <label for="input'.$name.'">'.$label.'</label>
                        <input type="password" id="input'.$name.'" name="'.$name.'" value="'.$value.'"'.$attr.'>';
        }
        if($error){
            $html = '<span>'.$error.'</span>';
        }
        $html .= '</div>';
        return $html;
    }
}