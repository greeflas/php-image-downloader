<?php
namespace greeflas\tools\exceptions;

/**
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 */
class NotAllowedFileExtensionException extends \Exception
{
    /**
     * User friendly message
     *
     * @return string
     */
    public function getName()
    {
        return 'Not allowed file extension!';
    }
}