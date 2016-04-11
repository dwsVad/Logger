<?php
/**
 * This file is part of the Lib: TF\Logger
 * Copyright (c) 2016 Protsenko Vadim (DWSVad email://dws.vad@gmail.com) (http://TimFamily.Kiev.ua)
 *
 * Date: 09.03.2016
 */
namespace TF\Logger;

use TF\Logger\Handlers\ILogHandler;

/**
 * Class Logger
 * @package TF\Libs\Logger
 *
 * Basic usage:
 * Initialise:
 *          $logsDir='';
 *          Logger::addHandler(new FileLogHandler(new DefaultFileLogFormatter(),$logsDir));
 * Usage samples:
 * 1.
 *          Logger::getLogger('moduleName1')->log("message",Logger::WARNING);
 * 2.
 *          Logger::getLogger('moduleName2')->warning('log message');
 * 3.
 *          $loggerModule3 = Logger::getLogger('moduleName3');
 *          $loggerModule3->log('log message',Logger::WARNING);
 * 4.
 *          $loggerModule4 = Logger::getLogger('moduleName4');
 *          $loggerModule4->warning('log message');
 */
class Logger {
    const NONE = 0;
    const CRITICAL = 1;
    const WARNING  = 2;
    const INFO  = 3;
    const TRACE = 4;
    const DEBUG = 5;

    private static $levels = array(
        0 => 'NONE',
        1 => 'CRITICAL',
        2 => 'WARNING',
        3 => 'INFO',
        4 => 'TRACE',
        5 => 'DEBUG'
    );

    /** @var int $globalLogLevel */
    private static $globalLogLevel = self::DEBUG;
    /** @var Logger[] */
    private static $loggersMap = array();

    /** @var ILogHandler[] */
    private static $logHandlers = array();

    /** @var string $moduleName */
    private $moduleName;

    /** @var int $moduleLogLevel */
    private $moduleLogLevel;

    /**
     * todo add comment and PHPDoc info  for this method
     *
     * Logger constructor.
     * @param string $moduleName
     * @param int $moduleLogLevel
     */
    private function __construct($moduleName, $moduleLogLevel) {
        $this->moduleLogLevel = $moduleLogLevel;
        $this->moduleName = $moduleName;
    }

    /**
     * todo add comment and PHPDoc info  for this function
     *
     * @param string $module
     * @return Logger
     */
    public static function getLogger($module = 'core') {
        if(!array_key_exists($module,self::$loggersMap))
            self::$loggersMap[$module] = new Logger($module,self::$globalLogLevel);

        return self::$loggersMap[$module];
    }

    /**
     * todo add comment and PHPDoc info  for this function
     *
     * @param ILogHandler $logHandler
     */
    public static function addHandler(ILogHandler $logHandler) {
        self::$logHandlers[] = $logHandler;
    }


    /**
     * todo add comment and PHPDoc info  for this function
     *
     * @param $message
     * @param int $logLevel
     */
    public function log($message, $logLevel = self::DEBUG) {
        if($logLevel <= $this->moduleLogLevel) {
            foreach(self::$logHandlers as $appender) {
                $appender->save($this->moduleName,$message,self::getLogLevelName($logLevel));
            }
        }

    }

    /**
     * todo add comment and PHPDoc info  for this function
     *
     * @param $message
     */
    public function warning($message){
        $this->log($message, self::WARNING);
    }

    /**
     * todo add comment and PHPDoc info  for this function
     *
     * @param $message
     */
    public function critical($message){
        $this->log($message, self::CRITICAL);
    }

    /**
     * todo add comment and PHPDoc info  for this function
     *
     * @param $message
     */
    public function info($message){
        $this->log($message, self::INFO);
    }

    /**
     * todo add comment and PHPDoc info  for this function
     *
     * @param $message
     */
    public function trace($message){
        $this->log($message, self::TRACE);
    }

    /**
     * todo add comment and PHPDoc info  for this function
     *
     * @param $message
     */
    public function debug($message){
        $this->log($message, self::DEBUG);
    }

    /**
     * todo add comment and PHPDoc info  for this function
     *
     * @param $codeLevel
     * @return mixed
     */
    private static function getLogLevelName($codeLevel) {
        return self::$levels[$codeLevel];
    }
}