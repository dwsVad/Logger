<?php
/**
 * This file is part of the Lib: TF\Parser
 * Copyright (c) 2016 Protsenko Vadim (DWSVad email://dws.vad@gmail.com) (http://TimFamily.Kiev.ua)
 *
 * Date: 15.03.2016
 */
namespace TF\Logger\Formatters;

/**
 * Interface IFormatter
 *
 * todo add comment and PHPDoc info  for this interface
 */
interface IFormatter {

    /**
     * todo add comment and PHPDoc info  for this function
     *
     * @param $message
     * @param string $level
     * @return string
     */
    public function format($message,$level);
}