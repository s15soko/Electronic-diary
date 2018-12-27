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

    // select option
    private $select_option;



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
        // convert $options to array
        $this->method = $method;
    }
    
    // form inputs
    public function setInputs($inputs)
    {
        // convert $inputs to array
        if(!is_array($inputs)) $inputs = array($inputs);
        $this->inputs = $inputs;
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

}


?>