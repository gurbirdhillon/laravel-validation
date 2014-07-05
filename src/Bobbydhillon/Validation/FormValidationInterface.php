<?php
/**
 * Created by PhpStorm.
 * User: Bobby
 * Date: 14-07-04
 * Time: 12:02 AM
 */

namespace Bobbydhillon\Validation;


interface FormValidationInterface {

    /**
     * Initialize validator
     *
     * @param array $formData
     * @param array $rules
     * @param array $messages
     * @return \Illuminate\Validation\Validator
     */
    public function make(array $formData, array $rules, array $messages = []);

} 