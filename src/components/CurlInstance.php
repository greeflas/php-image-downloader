<?php
namespace greeflas\tools\components;

/**
 * Class for work with cURL PHP extension
 * @see http://php.net/manual/en/book.curl.php
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 */
class CurlInstance
{
    /**
     * @var resource
     */
    protected $_seance;


    /**
     * Init of curl seance
     *
     * @param string $url
     * @throws \Exception
     */
    public function init($url)
    {
        $this->_seance = curl_init($url);

        if (!$this->_seance) {
            throw new \Exception('Failed to init cURL seance!');
        }
    }

    /**
     * Set param for seance
     *
     * @param integer $option
     * @param mixed $value
     * @return bool
     */
    public function setParam($option, $value)
    {
        return curl_setopt($this->_seance, $option, $value);
    }

    /**
     * Set params for seance
     *
     * @param array $params
     * @return bool
     */
    public function setParams($params)
    {
        foreach ($params as $option => $value) {
            if (!$this->setParam($option, $value)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Exec query
     *
     * @return mixed
     */
    public function exec()
    {
        return curl_exec($this->_seance);
    }

    /**
     * Close curl seance
     *
     */
    public function close()
    {
        curl_close($this->_seance);
    }

    /**
     * Get info about operation
     *
     * @param integer $opt
     * @return mixed
     */
    public function getInfo($opt)
    {
        return curl_getinfo($this->_seance, $opt);
    }
}