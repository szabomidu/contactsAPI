<?php


namespace src\Logger;

/**
 * Class Logger
 *
 * A basic logger class to write out errors into error.log file.
 *
 * @package src\Logger
 */
class Logger
{
    private $loggerFile;

    /**
     * Logger constructor.
     *
     * Sets the path to the logger file from environment variable.
     */
    public function __construct()
    {
        $this->loggerFile = $_ENV["LOGGER_FILE"];
    }

    /**
     * Calls composeLoggerMessage and writeToLoggerFile methods. This method
     * is called when an error occurs and logging is called.
     *
     * @param $errorMessage string error message in string format
     */
    public function logError(string $errorMessage)
    {
        $content = $this->composeLoggerMessage($errorMessage);
        $this->writeToLoggerFile($content);
    }

    /**
     * Writes content to logger file in append mode.
     *
     * @param $content string composed logger message
     */
    private function writeToLoggerFile(string $content)
    {
        $file = fopen($this->loggerFile, "a");
        fwrite($file, $content);
        fwrite($file, PHP_EOL);
        fclose($file);
    }

    /**
     * This method adds date and time and '[ERROR]' prefix to error message.
     *
     * @param $errorMessage string error message in string format
     * @return string composed logger message
     */
    private function composeLoggerMessage(string $errorMessage): string
    {
        return "[ERROR]" . date('Y-m-d H:i:s') . $errorMessage;
    }
}