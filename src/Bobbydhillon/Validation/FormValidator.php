<?php
/**
 * Created by PhpStorm.
 * User: Bobby
 * Date: 14-07-04
 * Time: 12:09 AM
 */

namespace Bobbydhillon\Validation;


abstract class FormValidator {


    /**
     * @var FormValidationInterface
     */
    protected $validatorService;

    /**
     * @var \Illuminate\Validation\Validator
     */
    protected $validator;

    /**
     * @var array
     */
    protected $messages = [];

    /**
     * @var array
     */
    protected $rules = [];

    /**
     * @param FormValidationInterface $validatorService
     */
    function __construct(FormValidationInterface $validatorService)
    {
        $this->validatorService = $validatorService;
    }

    /**
     * Validate the form data
     *
     * @param array $formData
     * @return boolean|\Illuminate\Validation\Validator
     */
    public function getValidationErrors(array $formData)
    {
        $this->validator = $this->validatorService->make(
            $formData,
            $this->rules,
            $this->messages
        );

        if ($this->validator->fails())
        {
            return $this->validator;
        }

        return false;
    }

} 