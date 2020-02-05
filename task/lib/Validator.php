<?php

namespace CWeb;

abstract class Validator
{
    /**
     * Errors
     * 
     * @var array
     */
    protected $errors = array();
    
    /**
     * Validate form
     * 
     * @param array $data Input data to validate
     * @return bool
     */
    abstract public function validate(array $data);
    
    /**
     * Get errors
     * 
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }
}
