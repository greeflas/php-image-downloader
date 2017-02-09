<?php
namespace greeflas\tools\validators;

use greeflas\tools\interfaces\FileValidator;

/**
 * This is fake validator
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 */
class FakeValidator implements FileValidator
{
    /**
     * @inheritdoc
     */
    public function validate($value)
    {
        return true;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [];
    }
}