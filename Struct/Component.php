<?php
/**
 * Created by PhpStorm.
 * User: ben
 * Date: 27.09.17
 * Time: 00:23
 */

namespace Styleguide\Struct;

use Shopware\Bundle\StoreFrontBundle\Struct\Struct;

class Component extends Struct implements \JsonSerializable
{
    /**
     * @var string
     */
    private $group = '';

    /**
     * @var string
     */
    private $name = '';

    /**
     * @var string
     */
    private $file = '';

    /**
     * @return string
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * @param string $group
     */
    public function setGroup($group)
    {
        $this->group = $group;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param string $file
     */
    public function setFile($file)
    {
        $this->file = $file;
    }

    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    function jsonSerialize()
    {
        return get_object_vars($this);
    }

    function __toString()
    {
        return $this->getFile();
    }
}