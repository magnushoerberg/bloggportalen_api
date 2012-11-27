<?php
/**
 * Twingly Base class and init
 *
 * PHP 5
 *
 * @copyright 2012 Twingly 
 * */

set_include_path(get_include_path() . PATH_SEPARATOR . realpath(dirname(__FILE__)));

abstract class Twingly
{
    /**
     * @ignore
     * don't permit an explicit call of the constructor!
     * (like $t = new Twingly_Transaction())
     */
    protected function __construct()
    {
    }
    /**
     *      * @ignore
     *  don't permit cloning the instances (like $x = clone $v)
     */
    protected function __clone()
    {
    }

    /**
     * returns private/nonexistent instance properties
     * @ignore
     * @access public
     * @param string $name property name
     * @return mixed contents of instance properties
     */
    public function __get($name)
    {
        if (array_key_exists($name, $this->_attributes)) {
            return $this->_attributes[$name];
        }
        else {
            trigger_error('Undefined property on ' . get_class($this) . ': ' . $name, E_USER_NOTICE);
            return null;
        }
    }

    /**
     * used by isset() and empty()
     * @access public
     * @param string $name property name
     * @return boolean
     */
    public function __isset($name)
    {
        return array_key_exists($name, $this->_attributes);
    }

    public function _set($key, $value)
    {
        $this->_attributes[$key] = $value;
    }

    /**
     *
     * @param string $className
     * @param object $resultObj
     * @return object returns the passed object if successful
     * @throws Twingly_Exception_ValidationsFailed
     */
    public static function returnObjectOrThrowException($className, $resultObj)
    {
        $resultObjName = Twingly_Util::cleanClassName($className);
        if ($resultObj->success) {
            return $resultObj->$resultObjName;
        } else {
            throw new Twingly_Exception_ValidationsFailed();
        }
    }
}
require_once('Twingly/Blogg.php');
require_once('Twingly/Exception.php');
require_once('Twingly/Configuration.php');
require_once('Twingly/Http.php');
require_once('Twingly/Json.php');
require_once('Twingly/TopList.php');
require_once('Twingly/TopList.php');
require_once('Twingly/Util.php');
require_once('Twingly/Exception/Authentication.php');
require_once('Twingly/Exception/Authorization.php');
require_once('Twingly/Exception/Configuration.php');
require_once('Twingly/Exception/SSLCertificate.php');

if (version_compare(PHP_VERSION, '5.3.1', '<')) {
    throw new Twingly_Exception('PHP version >= 5.3.1 required');
}
function requireDependencies() {
    $requiredExtensions = array('openssl', 'curl');
    foreach ($requiredExtensions AS $ext) {
        if (!extension_loaded($ext)) {
            throw new Twingly_Exception('The Twingly library requires the ' . $ext . ' extension.');
        }
    }
}

requireDependencies();
