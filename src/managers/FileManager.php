<?php
namespace greeflas\tools\managers;

/**
 * Manager for work with files
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 */
class FileManager
{
    /**
     * @var resource
     */
    protected $_instance;


    /**
     * @return resource
     */
    public function getInstance()
    {
        return $this->_instance;
    }

    /**
     * Get file resource
     *
     * @param string $fileName
     * @param string $mode
     * @throws \Exception
     */
    public function open($fileName, $mode)
    {
        $this->_instance = fopen($fileName, $mode);
        if (!$this->_instance) {
            throw new \Exception('Failed to open file resource!');
        }
    }

    /**
     * Close file resource
     *
     * @return bool
     */
    public function close()
    {
        return fclose($this->_instance);
    }

    /**
     * Helper method for building a full path to file
     *
     * @param string $path
     * @param string $fileName
     * @return string
     */
    public static function buildPathToFile($path, $fileName)
    {
        return $path . DIRECTORY_SEPARATOR . $fileName;
    }

    /**
     * Delete file
     *
     * @param string $fileName
     * @return bool
     */
    public static function deleteFile($fileName)
    {
        return unlink($fileName);
    }
}