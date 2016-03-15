<?php
namespace TF\Libs\Logger;

class Logger
{
    const ERROR = 1;
    const WARNING = 3;
    const INFO = 8;
    const TRACE = 9;

    /** @var Logger[] */
    protected static  $_logs = array();

    protected static  $_logLevels = array(
        self::ERROR => 'Error',
        self::WARNING => 'Warning',
        self::INFO => 'Info',
        self::TRACE => 'Trace'
    );
    protected static $logsDir = null;

    private $loggerName;
    private $logPatch;


    public static function setDir($dirPath) {
        self::$logsDir = $dirPath;
        if (!is_writable(self::$logsDir))
            throw new \RuntimeException("Logs dir not writable");
    }

    public static function getLogger($loggerName) {
        if (!array_key_exists($loggerName, self::$_logs)) {
            $log = new Logger($loggerName);
            self::$_logs[$loggerName] = $log;
        }

        return self::$_logs[$loggerName];
    }

    /**
     * @param $loggerName
     * @throws \RuntimeException
     */
    public function __construct($loggerName) {
        $this->loggerName = $loggerName;

        if(is_null(self::$logsDir))
            throw new \RuntimeException("Logs dir not initialised");

        $this->logPatch =  self::$logsDir . DIRECTORY_SEPARATOR . $loggerName . '.log';
    }


    public function log($msg, $logLevel = self::INFO)
    {
        $logMessage = self::formatLogMessage($msg,$logLevel);
        file_put_contents( $this->logPatch, $logMessage, FILE_APPEND );
    }


    public function error($msg) {
        $this->log($msg,self::ERROR);
    }


    public function warning($msg) {
        $this->log($msg,self::WARNING);
    }


    public function info($msg) {
        $this->log($msg,self::INFO);
    }


    public function trace($msg) {
        $this->log($msg,self::TRACE);
    }


    private static function formatLogMessage($msg,$logLevel){
        return sprintf("[%s] [%s] [%d] [%s]\n",
            date('Y-m-d H:i:s'),
            self::$_logLevels[$logLevel],
            getmypid(),
            $msg
        );
    }
}
