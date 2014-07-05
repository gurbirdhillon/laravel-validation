<?php
/**
 * User: Bobby Dhillon
 * Date: 14-07-03
 * Time: 9:44 PM
 */

namespace Bobbydhillon\Validation;

use Illuminate\Database\Eloquent\Model as Eloquent;

use Illuminate\Support\Facades\Validator as Validator;

use Illuminate\Support\Facades\Input as Input;

abstract class ValidationModel  extends  Eloquent implements ValidationModelInterface {

    /**
     * @var array
     * Contains array of default form columns
     */
    protected static $dbColumns = array();

    /**
     * @var array
     * Contains array of fields used to update records
     */
    protected static $updateDbColumns = array();

    /**
     * @var array i.e. array('column' => 'model["column"]') or array('column' => 'form_field')
     * Contains array mapping column and form field, its advised to model[column] as form field to avoid field ambiguous
     */
    protected static $columnFieldMap = array();

    /**
     * @var array
     * Contains array of default values of form fields, i.e. what is used to fill the empty fields
     */
    protected static $columnDefaultValues = array();

    /**
     * @var array
     * That can be used to ignore fields while updating the records
     */
    protected static $ignoredFields = array();

    /**
     * @var array
     * Array of validation rules for new records, must use form field name
     */
    protected static $validationRules = array();


    /**
     * @param $id
     * @return array , i.e array (must use form field name) of validation rules for updating the record
     */
    public static function getUpdateValidationRules($id) {
        return array();
    }

    /**
     * @param int $id
     * @return Validator|Bool
     */
    public static function getValidationErrors($id = 0) {

        if($id > 0) {
            $validation = Validator::make( Input::all(), static::getUpdateValidationRules($id));
        } else {
            $validation = Validator::make( Input::all(), static::$validationRules );
        }

        if ($validation->fails())
        {
            return $validation;
        }

        return false;

    }

    /**
     * @param int $id
     * @return bool
     */
    public static function isValid($id = 0) {

        $status = true;

        $validationErrors = static::getValidationErrors($id);

        if ( $validationErrors) {
            $status = false;
        }

        return $status;

    }



    /**
     * @return array
     */
    public static function extractColumnValues() {

        $result = array();


        foreach(static::$columnFieldMap as $column => $field) {

            $result[$column] = Input::get($field,static::$columnDefaultValues[$column]);

        }

        return $result;

    }


    /**
     * @return bool|\Illuminate\Database\Eloquent\Model|static
     */
    public static function createRecord() {

        if(static::isValid()) {
            return parent::create(static::extractColumnValues());

        } else {
            return false;
        }

    }

    /**
     * return void
     */
    public function updateRecord() {

        if(static::isValid($this->id)) {

            foreach(static::$columnFieldMap as $column => $field) {
                if (Input::has($field) && ! in_array($column,static::$ignoredFields) )
                {
                    $this->{$column} = Input::get($field);
                }
            }

            $this->save();
        }


    }


} 