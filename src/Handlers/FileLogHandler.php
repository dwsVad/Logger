<?php
/**
 * This file is part of the Lib: TF\Parser
 * Copyright (c) 2016 Protsenko Vadim (DWSVad email://dws.vad@gmail.com) (http://TimFamily.Kiev.ua)
 *
 * Date: 15.03.2016
 */
namespace TF\Logger\Handlers;

use TF\Logger\Formatters\IFormatter;

/**
 * Class FileLogHandler
 * @package TF\Logger\Handlers
 *
 * todo add comment and PHPDoc info  for this class
 */
class FileLogHandler  implements ILogHandler {

    /** @var string $logsDir */
    private $logsDir ='';

    /** @var string $logsExtension */
    private $logsExtension = '.log';

    /** @var int $logSizeLimit in bytes */
    private $logSizeLimit = 1048576; // 1Mb

    /** @var  IFormatter */
    private $formatter;

    /**
     * todo add comment and PHPDoc info  for this method
     *
     * FileLogHandler constructor.
     * @param IFormatter $formatter
     * @param $logsDir
     */
    public function __construct(IFormatter $formatter,$logsDir) {
        $this->formatter = $formatter;
        $this->logsDir = $logsDir;
    }

    /**
     * todo add comment and PHPDoc info  for this function
     *
     * @param string $module
     * @param $message
     * @param string $level
     * @return bool
     */
    public function save($module, $message, $level) {

        $logFile = $this->logsDir.DIRECTORY_SEPARATOR.$module.$this->logsExtension;
        $formattedLogLine = $this->formatter->format($message,$level);

        clearstatcache();
        if(file_exists($logFile) === false) {
            if($this->write($logFile,$formattedLogLine)) {
                chmod($logFile, 0664);
                return true;
            }
            return false;

        }
        if((file_exists($logFile) && filesize($logFile) > $this->logSizeLimit))
            $this->rotateLogFile($logFile);

        return $this->write($logFile,$formattedLogLine);
    }

    /**
     * todo add comment and PHPDoc info  for this function
     *
     * @param string $logFile
     * @param string $lineLog
     * @return bool
     */
    private function write($logFile,$lineLog) {
        return (file_put_contents($logFile,$lineLog,FILE_APPEND) !== false);
    }

    /**
     * todo add comment and PHPDoc info  for this function
     *
     * @param string $logFile
     *
     */
    private function rotateLogFile($logFile) {
        clearstatcache();
        if(file_exists($logFile.".bak1.zip")) {
            //удаляем самы старый архив бекапа
            if(file_exists($logFile.".bak9.zip"))
                unlink($logFile.".bak9.zip");
            //смещаем все архивы бекапа
            for($i = 8; $i >= 1; $i--) {
                if(file_exists($logFile . ".bak" . $i . ".zip"))
                    rename($logFile . ".bak" . $i . ".zip", $logFile . ".bak" . ($i + 1) . ".zip");
            }
        }

        $zip = new \ZipArchive();
        if ($zip->open($logFile.".bak1.zip", \ZIPARCHIVE::CREATE) === true) {
            $zip->addFile($logFile, basename($logFile));
            $zip->close();
            unlink($logFile);
        }
        else {
            rename($logFile, "{$logFile}.bak");
        }
    }
}