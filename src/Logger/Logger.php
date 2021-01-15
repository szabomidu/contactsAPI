<?php


namespace src\Logger;


class Logger
{
    private $loggerFile;

    /**
     * Logger constructor.
     */
    public function __construct()
    {
        $this->loggerFile = $_ENV["LOGGER_FILE"];
    }

    public function logError($errorMessage)
    {
        $content = $this->composeLoggerMessage($errorMessage);
        $this->writeToLoggerFile($content);
    }

    private function writeToLoggerFile($content)
    {
        $file = fopen($this->loggerFile, "a");
        fwrite($file, $content);
        fwrite($file, PHP_EOL);
        fclose($file);
    }

    private function composeLoggerMessage($errorMessage): string
    {
        return "[ERROR]" . date('Y-m-d H:i:s') . $errorMessage;
    }
}