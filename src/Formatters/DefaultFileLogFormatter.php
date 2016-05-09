<?php
/**
 * This file is part of the Lib: TF\Parser
 * Copyright (c) 2016 Protsenko Vadim (DWSVad email://dws.vad@gmail.com) (http://TimFamily.Kiev.ua)
 *
 * Date: 15.03.2016
 */
namespace TF\Logger\Formatters;

/**
 * Class DefaultFileLogFormatter
 * @package TF\Logger\Formatters
 *
 * todo add comment and PHPDoc info  for this class
 */
class DefaultFileLogFormatter implements IFormatter {

    /**
     * todo add comment and PHPDoc info  for this function
     *
     * @param $message
     * @param string $level
     * @return string
     */
    public function format($message,$level) {
        return '['.date("y-m-d H:i:s").'] ['.$level.'] ('.getmypid().') '.$message."\n";
    }

}