<?php

namespace Prokl\Options;

use Bitrix\Main\Config\Option;
use Exception;
use Prokl\Module\ModuleId;

/**
 * Class OptionHelper
 */
class OptionHelper extends BitrixHelper
{
    /**
     * @var string $moduleId
     */
    private $moduleId;

    /**
     * Фасад.
     *
     * @return static
     */
    public static function facade()
    {
        return new static(ModuleId::ID);
    }

    /**
     * @param string $moduleId
     */
    public function __construct(string $moduleId)
    {
        $this->moduleId = $moduleId;
    }

    /**
     * @param string $optioName
     * @param mixed  $value
     *
     * @return bool
     */
    public function setOption(string $optioName, $value) : bool
    {
        $value = $this->revertOption($value);

        try {
            Option::set($this->moduleId, $optioName, $value);
            return true;
        } catch (Exception $e) {}

        return false;
    }

    /**
     * @param string $optionName
     * @param string $defaultValue
     *
     * @return mixed|false
     */
    public function getOption(string $optionName, string $defaultValue = '')
    {
        try {
            $value = Option::get($this->moduleId, $optionName, $defaultValue);

            return $this->prepareOption($value);
        } catch (Exception $e) {
        }

        return false;
    }

    /**
     * @param string $optionName
     * @param string $defaultValue
     *
     * @return mixed|false
     */
    public function getRealValueOption(string $optionName, string $defaultValue = '')
    {
        try {
            $value = Option::getRealValue($this->moduleId, $optionName);
            if (!$value) {
                $value = $defaultValue;
            }

            return $this->prepareOption($value);
        } catch (Exception $e) {
        }

        return false;
    }

    /**
     * @param string $optionName
     *
     * @return bool
     */
    public function deleteOptions(string $optionName) : bool
    {
        try {
            Option::delete($this->moduleId, ['name' => $optionName]);
            return true;
        } catch (Exception $e) {
        }

        return false;
    }

    /**
     * @param mixed $item
     *
     * @return mixed
     */
    private function prepareOption($item)
    {
        if (!empty($item) && !is_numeric($item)) {
            if ($this->isSerialize($item)) {
                return unserialize($item);
            } elseif ($this->isJson($item)) {
                $item = json_decode($item, true);
            }
        }

        return $item;
    }

    /**
     * @param mixed $item
     * @param bool  $json
     *
     * @return mixed
     */
    private function revertOption($item, bool $json = false)
    {
        if (is_array($item)) {
            if ($json) {
                $item = json_encode($item);
            } else {
                $item = serialize($item);
            }
        }

        return $item;
    }

    /**
     * @param string $string
     *
     * @return bool
     */
    private function isSerialize(string $string) : bool
    {
        return (unserialize($string) !== false || $string == 'b:0;');
    }

    /**
     * @param string $string
     *
     * @return bool
     */
    protected function isJson(string $string) : bool
    {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }
}