<?php

namespace Prokl\Utils;

/**
 * Class SettingsManager
 */
class SettingsManager
{
    /**
     * @var array
     */
    private $params;

    /**
     * @var string
     */
    private $file;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->file = $_SERVER['DOCUMENT_ROOT'] ?? $this->detectDocumentRoot();

        $this->file .= '/bitrix/.settings.php';
        $this->params = include $this->file;
    }

    /**
     * DEBUG on.
     *
     * @return void
     */
    public function debugOn() : void
    {
        $this->params['exception_handling']['value']['debug'] = true;
        $this->updateFile();
    }

    /**
     * DEBUG off.
     *
     * @return void
     */
    public function debugOff() : void
    {
        $this->params['exception_handling']['value']['debug'] = false;
        $this->updateFile();
    }

    /**
     * DEBUG reverse.
     *
     * @return void
     */
    public function debugReverse() : void
    {
        $this->params['exception_handling']['value']['debug'] = $this->params['exception_handling']['value']['debug'] === false ? true: false;
        $this->updateFile();
    }

    /**
     * @return void
     */
    private function updateFile() : void
    {
        file_put_contents($this->file, "<?php\nreturn ".var_export($this->params, true).';', LOCK_EX);
    }

    /**
     * @return string
     */
    private function detectDocumentRoot() : string
    {
        $path = dirname(__FILE__);
        $result = '';

        foreach ([
                     '/../',
                     '/../../',
                     '/../../',
                     '/../../../',
                     '/../../../../',
                     '/../../../../../',
                     '/../../../../../..',
                 ] as $pathItem) {
            if (@file_exists($path.$pathItem.'bitrix/')) {
                $result = $path . $pathItem;
            }
        }

        return $result;
    }
}