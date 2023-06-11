<?php

namespace Prokl\Tools;

use Bitrix\Main\Config\Configuration;
use Bitrix\Main\ModuleManager;

/**
 * Class BitrixConfigs
 */
class BitrixConfigs
{
    /**
     * Загрузка битриксовых конфигов.
     *
     * @param string  $key                 Ключ в параметрах битриксовых файлов.
     * @param boolean $loadModulesServices Загружать такую же секцию в установленных модулях.
     *
     * @return array
     */
    public function loadBitrixConfig(string $key, bool $loadModulesServices = false) : array
    {
        $mainBitrixServices = Configuration::getInstance()->get($key) ?? [];

        $servicesModules = [];

        // Собрать конфиги всех установленных модулей.
        if ($loadModulesServices) {
            foreach (ModuleManager::getInstalledModules() as $module) {
                $services = Configuration::getInstance($module['ID'])->get($key) ?? [];
                if (count($services) > 0) {
                    $servicesModules[] = $services;
                }
            }
        }

        return array_merge($mainBitrixServices, ...$servicesModules);
    }
}