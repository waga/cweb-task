<?php

namespace Task\Validator;

use CWeb\Validator;

class Form extends Validator
{
    /**
     * Validate form
     * 
     * @param array $data Input data to validate
     * @return bool
     */
    public function validate(array $data)
    {
        if (!array_key_exists('email', $data) || !$data['email']) {
            $this->errors[] = 'Empty email';
        } else if (!preg_match('/[^@]+@[^\.]+\.[a-z]+/', $data['email'])) {
            $this->errors[] = 'Invalid email';
        }
        
        if (!array_key_exists('first_name', $data) || !$data['first_name']) {
            $this->errors[] = 'Empty first name';
        } else if (!preg_match('/^[a-zA-Z]+$/', $data['first_name'])) {
            $this->errors[] = 'Invalid first name';
        }
        
        if (!array_key_exists('last_name', $data) || !$data['last_name']) {
            $this->errors[] = 'Empty surname';
        } else if (!preg_match('/^[a-zA-Z]+$/', $data['last_name'])) {
            $this->errors[] = 'Invalid surname';
        }
        
        if (!array_key_exists('address', $data) || !$data['address']) {
            $this->errors[] = 'Empty address';
        }
        
        if (!array_key_exists('country', $data) || !$data['country']) {
            $this->errors[] = 'Empty country';
        }
        
        if (!array_key_exists('post_code', $data) || !$data['post_code']) {
            $this->errors[] = 'Empty post code';
        }
        
        if (!array_key_exists('phone', $data) || !$data['phone']) {
            $this->errors[] = 'Empty phone';
        }
        
        return empty($this->errors);
    }
}
