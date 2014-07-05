<?php
/**
 * Created by PhpStorm.
 * User: Bobby
 * Date: 14-07-04
 * Time: 12:07 AM
 */

namespace Bobbydhillon\Validation;

use Illuminate\Validation\Factory as Validator;

class FormValidatorService implements FormValidationInterface {

    /**
     * @var \Illuminate\Validation\Factory
     */
    private $validator;

    /**
     * @param Validator $validator
     */
    function __construct(Validator $validator)
    {
        $this->validator = $validator;
    }

    /**
     * Initialize validation
     *
     * @param array $formData
     * @param array $rules
     * @param array $messages
     * @return \Illuminate\Validation\Validator
     */
    public function make(array $formData, array $rules, array $messages = [])
    {
        return $this->validator->make($formData, $rules, $messages);
    }

} 