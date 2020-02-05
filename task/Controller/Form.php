<?php

namespace Task\Controller;

use CWeb\Controller;
use Task\Validator\Form as FormValidator;

class Form extends Controller
{
    public function index()
    {
        if ($_POST) {
            $formValidator = new FormValidator();
            if (!$formValidator->validate($_POST)) {
                $this->setSessionMessages(
                    $formValidator->getErrors());
            } else {
                
                $userExists = $this->database->query('
                    SELECT `id` 
                    FROM `users` 
                    WHERE `email` = ? 
                    LIMIT 0, 1
                ', array($_POST['email']));
                
                if ($userExists) {
                    $this->setSessionMessage('Email already exists.', 'warning');
                    $this->redirect('/form');
                    return;
                }
                
                $userId = $this->database->query('
                    INSERT INTO `users` (
                        `email`, 
                        `first_name`, 
                        `last_name`, 
                        `address`, 
                        `country`, 
                        `post_code`, 
                        `phone`
                    ) VALUES (?, ?, ?, ?, ?, ?, ?)
                ', array(
                    $_POST['email'],
                    $_POST['first_name'],
                    $_POST['last_name'],
                    $_POST['address'],
                    $_POST['country'],
                    $_POST['post_code'],
                    $_POST['phone'],
                ));
                
                if ($userId) {
                    $this->setSessionMessage(
                        'Form data saved successfully.', 'success');
                } else {
                    $this->setSessionMessage('Failed to save data.', 'warning');
                }
            }
            $this->redirect('/form');
        }
    }
}
