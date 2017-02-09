<?php
namespace greeflas\tools\interfaces;

/**
 * Interface for validator classes
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 */
interface FileValidator
{
    /**
     * Validate method
     *
     * @param string $value
     * @return boolean
     */
    public function validate($value);

    /**
     * This method should return the array with validation rules
     * Example
     * ```php
     * public function rules()
     * {
     *      return [
     *          'extensions' => ['jpg', 'png', 'gif']
     *      ];
     * }
     * ```
     *
     * @return array
     */
    public function rules();
}