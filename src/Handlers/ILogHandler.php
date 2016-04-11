<?php
/**
 * This file is part of the Lib: TF\Parser
 * Copyright (c) 2016 Protsenko Vadim (DWSVad email://dws.vad@gmail.com) (http://TimFamily.Kiev.ua)
 *
 * Date: 15.03.2016
 */
namespace TF\Logger\Handlers;
/**
 * Interface ILogHandler
 *
 * todo add comment and PHPDoc info  for this interface
 */
interface ILogHandler {

    /**
     * todo add comment and PHPDoc info  for this function
     *
     * @param string $module
     * @param $message
     * @param string $level
     * @return boolean
     */
    public function save($module,$message,$level);
}