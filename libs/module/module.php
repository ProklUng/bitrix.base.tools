<?php

namespace Prokl\Module;

use Bitrix\Main\ArgumentNullException;
use Bitrix\Main\ArgumentOutOfRangeException;
use Exception;
use LogicException;

/**
 * Class Module
 * @package Prokl\Module
 *
 * @since 13.04.2021
 */
class Module
{
    /**
     * @var string $MODULE_ID ID модуля.
     */
    private $MODULE_ID;

    /**
     * @var string $MODULE_VERSION Версия модуля.
     */
    private $MODULE_VERSION;

    /**
     * @var string $MODULE_VERSION_DATE Дата версии модуля.
     */
    private $MODULE_VERSION_DATE;

    /**
     * @var string $ADMIN_FORM_ID ID формы админки модуля.
     */
    private $ADMIN_FORM_ID;

    /**
     * @var ModuleManager $options Менеджер опций модуля.
     */
    public $options;

    /**
     * @var array $moduleInstances Инициализированные экземпляры менеджеров модулей.
     */
    private static $moduleInstances = [];

    /**
     * @param array $options Array of module properties.
     *
     * @throws Exception Когда с параметрами что-то не то.
     */
    public function __construct(array $options = [])
    {
        if (!$options['MODULE_ID']) {
            throw new Exception('MODULE_ID is required');
        }

        $this->MODULE_ID = $options['MODULE_ID'];
        $this->MODULE_VERSION = $options['MODULE_VERSION'];
        $this->MODULE_VERSION_DATE = $options['MODULE_VERSION_DATE'];
        $this->ADMIN_FORM_ID = $options['ADMIN_FORM_ID'];

        $this->options = new ModuleManager($this->MODULE_ID);
    }

    /**
     * Добавить в стэк экземпляр менеджера модулей.
     *
     * @param object $moduleObject Экземпляр менеджера модулей.
     *
     * @return void
     */
    public function addModuleInstance($moduleObject) : void
    {
        static::$moduleInstances[$this->MODULE_ID] = $moduleObject;
    }

    /**
     * Получить экземпляр менеджера модуля по ID.
     *
     * @param string $moduleId ID модуля.
     *
     * @return object
     */
    public static function getModuleInstance(string $moduleId)
    {
        if (array_key_exists($moduleId, static::$moduleInstances)) {
            return static::$moduleInstances[$moduleId];
        }

        throw new LogicException(
            sprintf('Модуль %s не найден', $moduleId)
        );
    }

    /**
     * @return ModuleManager
     */
    public function getOptionsManager(): ModuleManager
    {
        return $this->options;
    }

    /**
     * Get module id.
     *
     * @return string MODULE_ID property
     */
    public function getId(): string
    {
        return $this->MODULE_ID;
    }

    /**
     * Get module version.
     *
     * @return string
     */
    public function getVersion(): string
    {
        return $this->MODULE_VERSION;
    }

    /**
     * Set module version.
     *
     * @param string $MODULE_VERSION Версия модуля.
     *
     * @return void
     */
    public function setVersion(string $MODULE_VERSION): void
    {
        $this->MODULE_VERSION = $MODULE_VERSION;
    }

    /**
     * Get module version date.
     *
     * @return string MODULE_VERSION_DATE property
     */
    public function getVersionDate(): string
    {
        return $this->MODULE_VERSION_DATE;
    }

    /**
     * Set module version date.
     *
     * @param string $MODULE_VERSION_DATE Дата модуля.
     *
     * @return void
     */
    public function setVersionDate(string $MODULE_VERSION_DATE): void
    {
        $this->MODULE_VERSION_DATE = $MODULE_VERSION_DATE;
    }

    /**
     * Output admin options form.
     *
     * @return void
     * @throws ArgumentNullException|ArgumentOutOfRangeException Когда что-то пошло не так.
     */
    public function showOptionsForm(): void
    {
        $form = new ModuleForm($this->options, $this->ADMIN_FORM_ID);
        $form->handleRequest();
        $form->write();
    }
}
