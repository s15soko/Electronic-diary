<?php

class formBuilderController
{
    // table name in database
    private $t_name;

    // set header text over input
    private $header;

    // form method
    private $method;
    
    // inputs in form
    private $inputs;

    // select options
    private $select_option;

    // column name in options
    private $name_options;

    // js form option 
    private $js_form;


    // table name in database
    public function setTableName($name)
    {
        $this->t_name = $name;
    }

    // header text over input
    public function setHeaderText($name)
    {
        // convert $inputs to array
        if(!is_array($name)) $name = array($name);
        $this->header = $name;
    }


    // form method
    public function setFormMethod($method)
    {
        $this->method = $method;
    }
    
    // form inputs
    public function setInputs($inputs)
    {
        // convert $inputs to array
        if(!is_array($inputs)) $inputs = array($inputs);
        $this->inputs = $inputs;
    }

    // set name options
    public function setNameOptions($name_options)
    {
        // convert $options to array
        if(!is_array($name_options)) $name_options = array($name_options);
        $this->name_options = $name_options;
    }

    // js form on click
    public function setJsOnClick($js)
    {
        $this->js_form = $js;
    }




    // gets
    public function getMethod()
    {
        return $this->method;
    }
    public function getHeaderText()
    {
        return $this->header;
    }
    public function getInputs()
    {
        return $this->inputs;
    }
    public function getNameOptions()
    {
        return $this->name_options;
    }
    public function getJs()
    {
        return $this->js_form;
    }

}


?>