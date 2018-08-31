<?php
namespace greeflas\tools;

use greeflas\tools\exceptions\InvalidConfigurationException;
use greeflas\tools\exceptions\NotAllowedFileExtensionException;
use greeflas\tools\interfaces\FileValidator;
use greeflas\tools\components\CurlInstance;
use greeflas\tools\managers\FileManager;

/**
 * Component for downloading images by URL
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 */
class ImageDownloader
{
    /**
     * @var array Array with configuration for validator class
     */
    public $validator;

    /**
     * @var CurlInstance
     */
    protected $_curl;
    /**
     * @var FileManager
     */
    protected $_fileManager;


    /**
     * Class constructor
     *
     * @param null|array $validator
     */
    public function __construct($validator = null)
    {
        $this->validator = $validator;

        $this->_curl = new CurlInstance();
        $this->_fileManager = new FileManager();
    }

    /**
     * Validate downloaded file
     *
     * @param mixed $value
     * @return boolean
     * @throws InvalidConfigurationException
     * @throws \Exception
     */
    protected function validate($value)
    {
        if (!isset($this->validator['class'])) {
            $message = 'Configuration of validator class must contain a class name';
            throw new InvalidConfigurationException($message);
        }

        $validatorClass = $this->validator['class'];
        $validator = new $validatorClass();
        if ($validator instanceof FileValidator) {
            return $validator->validate($value);
        }

        throw new \Exception('Validator class should be instance of ' . FileValidator::class);
    }

    /**
     * Method for downloading the image by URL to file system
     *
     * @param string $url URL of the image
     * @param string $pathToSave Path for saving image
     * @param string $fileName Image file name
     * @return boolean
     * @throws NotAllowedFileExtensionException
     */
    public function download($url, $pathToSave, $fileName)
    {
        $fullPath = FileManager::buildPathToFile($pathToSave, $fileName);

        // prepare downloading
        $this->_curl->init($url);
        $this->_fileManager->open($fullPath, 'wb');
        $this->_curl->setParams([
            CURLOPT_FILE => $this->_fileManager->getInstance(),
            CURLOPT_HEADER => 0,
            CURLOPT_FOLLOWLOCATION => true
        ]);

        // download file
        $res = $this->_curl->exec();
        // validate downloaded file
        $isValid = $this->validate(
            $this->_curl->getInfo(CURLINFO_CONTENT_TYPE)
        );

        // close instances
        $this->_curl->close();
        $this->_fileManager->close();

        // if file is not valid - delete it from file system
        if (!$isValid) {
            FileManager::deleteFile($fullPath);
            throw new NotAllowedFileExtensionException('Wrong file extension');
        }

        return $res;
    }
}
