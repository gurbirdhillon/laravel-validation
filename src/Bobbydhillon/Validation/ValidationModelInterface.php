<?php
/**
 * User: Bobby Dhillon
 * Date: 14-07-03
 * Time: 9:49 PM
 */

namespace Bobbydhillon\Validation;

interface ValidationModelInterface {

    /**
     * @param int $id
     * @return mixed
     */
    public static function getValidationErrors($id = 0);

    /**
     * @param $id
     * @return array , i.e array of validation rules for updating the record
     */
    public static function getUpdateValidationRules($id);

    /**
     * @return bool|\Illuminate\Database\Eloquent\Model|static
     */
    public static function createRecord();

    /**
     * return void
     */
    public function updateRecord();

}
