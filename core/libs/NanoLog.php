<?php

namespace core\libs;

use Exception;

/**
 * This a minimalistic and general prupose log Class.
 * Allows the user to refer handler for exceptions and errors.
 * Can be extended
 *
 * @author Robert Carneiro de Assis <rc.assis.job@bol.com.br>
 * @package https://github.com/rocassis/nanolog
 */
class NanoLog
{
    private $log = [];
    private $filePath;

    public function __construct($pathLogFile = null)
    {
        if (isset($pathLogFile)) {
            $this->filePath = $pathLogFile;
        }
    }

    /**
     * Throw exception to avoid system crash
     */
    public function __call($name, $param)
    {
        throw new \Exception("The method called {$name} not exists!");
    }

    /**
     * Basic function for record a log
     *
     * @param string $message
     * @param array $context Must have code, file, line, trace and type as index
     * @return void
     */
    public function logBasic($message, $context = [])
    {
        $log = [
            'message'   => trim($message),
            'code'      => trim($context['code'] ?? ''),
            'file'      => trim($context['file'] ?? ''),
            'line'      => trim($context['line'] ?? ''),
            'trace'     => trim($context['trace'] ?? ''),
            'type'      => trim($context['type'] ?? '')
        ];

        $this->_saveFile($log);
    }

    /**
     * This function has all necessary parameters for create a log.
     * @testFunction testManual_log
     */
    public function manual_log($message, $type = null, $file = null, $line = null, $code = null, $trace = null)
    {
        $log = [
            'message'   => trim($message),
            'code'      => trim($code),
            'file'      => trim($file),
            'line'      => trim($line),
            'trace'     => trim($trace),
            'type'      => trim($type)
        ];

        $this->_saveFile($log);
    }

    /**
     * Manual log an execption in log file
     * @param Exception $exception Excetpion object
     */
    public function log_exception(Exception $exception)
    {
        $log = [
            "message"   => $exception->getMessage(),
            "code"      => $exception->getCode(),
            "file"      => $exception->getFile(),
            "line"      => $exception->getLine(),
            'trace'     => $exception->getTraceAsString(),
        ];

        $this->_saveFile($log);
    }

    /**
     * Save to log file errors during execution
     * @param type $errno Number of the error
     * @param type $errstr Message of the error
     * @param type $errfile File where error happend
     * @param type $errline Line number where error happend
     */
    public function errorHandler($errno, $errstr, $errfile, $errline)
    {
        $log = [
            'message'   => $errstr,
            'code'      => $errno,
            'file'      => $errfile,
            'line'      => $errline,
            'trace'     => '',
            'type'      => 'Error'
        ];

        $this->_saveFile($log);
    }

    /**
     * Get excpetions of the systems
     *
     * @param Exception $exception
     * @return void
     */
    public function exceptionHandler(Exception $exception)
    {
        $log = [
            "message"   => $exception->getMessage(),
            "code"      => $exception->getCode(),
            "file"      => $exception->getFile(),
            "line"      => $exception->getLine(),
            'trace'     => $exception->getTraceAsString(),
            'type'      => 'Exception'
        ];

        $this->_saveFile($log);
    }

    /**
     * Function to save the log to a defined file, create the if not exists
     *
     * @param array $log Array with logs parts
     * @return void
     */
    private function _saveFile(array $log)
    {
        $type = $log['type'] ?? 'Error';
        $date = date("d/m/Y H:i:s");
        $trace = preg_replace("/\r?\n/", "", $log['trace']);
        $message = "[{$date}] {$type}: {$log['message']} | Line: {$log['line']}";
        $message .= " | Code: {$log['code']} ";
        $message .= " Trace: {$trace}\n";

        $filePath = $this->filePath;

        file_put_contents($filePath, $message, FILE_APPEND | FILE_TEXT);
    }
}
