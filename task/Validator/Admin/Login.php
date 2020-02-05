<?php

namespace Task\Validator\Admin;

use CWeb\Validator;

class Login extends Validator
{
    /**
     * Validate admin login
     * 
     * @param array $data Input data to validate
     * @return bool
     */
    public function validate(array $data)
    {
        if (!array_key_exists('username', $data) || !$data['username']) {
            $this->errors[] = 'Empty username';
        }
        
        if (!array_key_exists('password', $data) || !$data['password']) {
            $this->errors[] = 'Empty password';
        }
        
        return empty($this->errors);
    }
}
