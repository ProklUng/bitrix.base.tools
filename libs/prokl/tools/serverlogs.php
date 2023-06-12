<?php

namespace Prokl\Tools;

use Exception;
use Generator;

/**
 * Class ServerLogs
 */
class ServerLogs
{
    /**
     * @param string $file  Путь к файлу.
     * @param int    $limit Лимит.
     *
     * @return array
     * @throws Exception
     */
    public function apacheAccessLog(string $file, int $limit = 1000) : array
    {
        if (!$file) {
            return [];
        }

        $i = 0;
        $parsedLogs = [];

        foreach ($this->getLines($file) as $line) {
            if ($limit === \count($parsedLogs)) {
                $parsedLogs = [];
            }

            $parsedLogs[] = $line;

            $i++;
        }

        return array_reverse($parsedLogs);
    }

    /**
     * Фильтр лога.
     *
     * @param array  $data  Данные.
     * @param string $value Фильтруемое значение.
     *
     * @return array
     */
    public function filterLog(array $data, string $value) : array
    {
        if (!$value) {
            return $data;
        }

        return array_filter($data, function ($item) use ($value) {
           if (stripos($item, $value) !== false) {
               return true;
           }

           return false;

        });
    }

    /**
     * @param int $limit Лимит.
     *
     * @return array
     */
    public function phpErrorsLogLines(int $limit = 10000) : array
    {
        $file = ini_get('error_log');

        $parsedLogs = [];
        $logFileHandle = fopen($file, 'rb');

        while (!feof($logFileHandle)) {
            $currentLine = str_replace(PHP_EOL, '', fgets($logFileHandle));
            if ($limit === \count($parsedLogs)) {
                $parsedLogs = [];
            }

            $parsedLogs[] = $currentLine;
        }

        return array_reverse($parsedLogs);
    }

    /**
     * @param int $limit Лимит.
     *
     * @return array
     */
    public function phpErrorsLog(int $limit = 10000) : array
    {
        $file = ini_get('error_log');

        $parsedLogs = [];
        $logFileHandle = fopen($file, 'rb');

        while (!feof($logFileHandle)) {
            $currentLine = str_replace(PHP_EOL, '', fgets($logFileHandle));

            // Normal error log line starts with the date & time in []
            if ('[' === $currentLine[0]) {
                if ($limit === \count($parsedLogs)) {
                    $parsedLogs = [];
                }

                try {
                    $dateArr = [];
                    preg_match('~^\[(.*?)\]~', $currentLine, $dateArr);
                    $currentLine = str_replace($dateArr[0], '', $currentLine);
                    $currentLine = trim($currentLine);
                    $errorDateTime = new \DateTime($dateArr[1]);
                    $errorDateTime->setTimezone(new \DateTimeZone('Europe/Moscow'));
                    $errorDateTime = $errorDateTime->format('Y-m-d H:i:s');
                } catch (Exception $e) {
                    $errorDateTime = '';
                }

                // Get the type of the error
                if (false !== strpos($currentLine, 'PHP Warning')) {
                    $currentLine = str_replace('PHP Warning:', '', $currentLine);
                    $currentLine = trim($currentLine);
                    $errorType = 'WARNING';
                } else if (false !== strpos($currentLine, 'PHP Notice')) {
                    $currentLine = str_replace('PHP Notice:', '', $currentLine);
                    $currentLine = trim($currentLine);
                    $errorType = 'NOTICE';
                } else if (false !== strpos($currentLine, 'PHP Fatal error')) {
                    $currentLine = str_replace('PHP Fatal error:', '', $currentLine);
                    $currentLine = trim($currentLine);
                    $errorType = 'FATAL';
                } else if (false !== strpos($currentLine, 'PHP Parse error')) {
                    $currentLine = str_replace('PHP Parse error:', '', $currentLine);
                    $currentLine = trim($currentLine);
                    $errorType = 'SYNTAX';
                } else if (false !== strpos($currentLine, 'PHP Exception')) {
                    $currentLine = str_replace('PHP Exception:', '', $currentLine);
                    $currentLine = trim($currentLine);
                    $errorType = 'EXCEPTION';
                } else {
                    $errorType = 'UNKNOWN';
                }

                if (false !== strpos($currentLine, ' on line ')) {
                    $errorLine = explode(' on line ', $currentLine);
                    $errorLine = trim($errorLine[1]);
                    $currentLine = str_replace(' on line ' . $errorLine, '', $currentLine);
                } else {
                    $errorLine = substr($currentLine, strrpos($currentLine, ':') + 1);
                    $currentLine = str_replace(':' . $errorLine, '', $currentLine);
                }

                $errorFile = explode(' in /', $currentLine);
                $errorFile = '/' . trim($errorFile[1]);
                $currentLine = str_replace(' in ' . $errorFile, '', $currentLine);

                // The message of the error
                $errorMessage = trim($currentLine);

                $parsedLogs[] = [
                    'dateTime'   => $errorDateTime,
                    'type'       => $errorType,
                    'file'       => $errorFile,
                    'line'       => (int)$errorLine,
                    'message'    => $errorMessage,
                    'stackTrace' => []
                ];
            } // Stack trace beginning line
            else if ('Stack trace:' === $currentLine) {
                $stackTraceLineNumber = 0;

                while (!feof($logFileHandle)) {
                    $currentLine = str_replace(PHP_EOL, '', fgets($logFileHandle));

                    // If the current line is a stack trace line
                    if ('#' === $currentLine[0]) {
                        $parsedLogsLastKey = key($parsedLogs);
                        $currentLine = str_replace('#' . $stackTraceLineNumber, '', $currentLine);
                        $parsedLogs[$parsedLogsLastKey]['stackTrace'][] = trim($currentLine);

                        $stackTraceLineNumber++;
                    } // If the current line is the last stack trace ('thrown in...')
                    else {
                        break;
                    }
                }
            }
        }

        return $parsedLogs;
    }

    /**
     * Get all log files out of /var/log and return an array with additional information.
     *
     * @param string $logPath
     *
     * @return array
     */
    public function getLogFiles(string $logPath) : array
    {
        $files = [];

        foreach(glob($logPath . DIRECTORY_SEPARATOR . '*.log') as $file) {
            $info    = pathinfo($file);
            $size    = filesize($file);
            $changed = filemtime($file);
            $files[] = array(
                'id'             => $info['filename'],
                'name'           => $info['basename'],
                'readable'       => is_readable($file),
                'changed'        => $changed,
                'filesize'       => $size,
                'filesize_human' => $this->getNiceFileSize($size));
        }
        return $files;
    }

    /**
     * View для кнопки фильтра.
     *
     * @param string $id    ID кнопки.
     * @param string $value Текущее значение фильтра.
     *
     * @return string
     */
    public function generateViewFilterLog(string $id, string $value = '') : string
    {
        ob_start();
        $idInput = $id . '_input';
        ?>
            <div class="filter-container">
                <input class="cncl-input" id="<?=$idInput?>" value="<?=$value?>">
                <button class="cncl-button cncl-button_primary"
                        onclick="const url = addGetParam('filter_<?=$id?>', jQuery('#<?=$idInput?>').val(), 'filter_<?=$id?>', 'tab_cont_logs');
			            window.location.href =  url;
			        return false;">Фильтр</button>
            </div>
       <?php return ob_get_clean();
    }

    /**
     * View для вывода контента файлов лога.
     *
     * @param array  $logs  Построчный файл лога.
     * @param string $class Класс.
     *
     * @return string
     */
    public function generateViewLog(array $logs, string $class) : string
    {
        ob_start(); ?>

        <?php foreach ($logs as $logItem) : ?>
            <div class="log-item"><?=$logItem?></div>
        <?php endforeach;

        $content = "<div class='log-container {$class}'>" . ob_get_clean() . '</div>';

        return $content;
    }

    /**
     * Returns human-readable file size.
     *
     * @param string $item
     *
     * @return string
     */
    private function getNiceFileSize(string $item) : string
    {
        if(is_numeric($item)) {
            $f = $item;
        } else {
            $f = filesize($item);
        }

        $s = "Byte";
        if ($f > 1023) {
            $f = round(($f/1024),2);
            $s = "KB";

            if ($f > 1023) {
                $f = round(($f/1024),2);
                $s = "MB";

                if ($f > 1023) {
                    $f = round(($f/1024),2);
                    $s = "GB";
                }
            }
        }
        return $f . " " . $s;
    }

    /**
     * @param string $file
     *
     * @return Generator
     * @throws Exception
     */
    private function getLines(string $file) : Generator
    {
        $f = fopen($file, 'r');
        if (!$f) {
            throw new Exception();
        }
        while ($line = fgets($f)) {
            yield $line;
        }
        fclose($f);
    }
}
