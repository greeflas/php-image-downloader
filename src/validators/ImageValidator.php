<?php
namespace greeflas\tools\validators;

use greeflas\tools\interfaces\FileValidator;

/**
 * Validator for image files
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 */
class ImageValidator implements FileValidator
{
    /**
     * @inheritdoc
     */
    public function validate($extension)
    {
        $rules = $this->rules();
        if (in_array($extension, $rules['extensions'])) {
            return true;
        }

        return false;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            'extensions' => [
                'image/png',
                'image/gif',
                'image/jpeg'
            ],
        ];
    }
}