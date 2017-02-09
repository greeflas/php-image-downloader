<?php
namespace greeflas\tools\exceptions;

/**
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 */
class InvalidConfigurationException extends \Exception
{
    /**
     * User friendly message
     *
     * @return string
     */
    public function getName()
    {
        return 'Invalid configuration';
    }
}