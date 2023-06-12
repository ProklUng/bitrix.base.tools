<?php

namespace Prokl\Options;

use CMain;
use Exception;
use Throwable;

/**
 * Class BitrixHelper
 */
class BitrixHelper
{
    /**
     * Фасад.
     *
     * @return static
     */
    public static function facade()
    {
        return new static();
    }

    /**
     * @param        $method
     * @param        $msg
     * @param string ...$vars
     *
     * @throws Exception
     */
    protected function throwException($method, $msg, ...$vars)
    {
        $args = func_get_args();
        $method = array_shift($args);

        if ($msg instanceof Throwable) {
            $msg = static::getExceptionAsString($msg);
        } else {
            $msg = call_user_func_array('sprintf', $args);
            $msg = strip_tags($msg);
        }

        $msg = $this->getMethod($method) . ': ' . $msg;

        throw new Exception($msg);
    }

    /**
     * @param string $method
     *
     * @return void
     *
     * @throws Exception
     */
    protected function throwApplicationExceptionIfExists(string $method) : void
    {
        /* @global $APPLICATION CMain */
        global $APPLICATION;
        if ($APPLICATION->GetException()) {
            $this->throwException(
                $method,
                $APPLICATION->GetException()->GetString()
            );
        }
    }

    /**
     * @param Throwable $exception
     *
     * @return string
     */
    public static function getExceptionAsString(Throwable $exception): string
    {
        return sprintf(
            "[%s] %s (%s) in %s:%d",
            get_class($exception),
            $exception->getMessage(),
            $exception->getCode(),
            $exception->getFile(),
            $exception->getLine()
        );
    }

    /**
     * @param string $method
     *
     * @return string
     */
    private function getMethod(string $method) : string
    {
        $path = explode('\\', $method);
        $short = array_pop($path);

        return (string)$short;
    }
}