<?php

namespace SMSTranscoder;

abstract class InputDataDecoder
{
    abstract public static function make(string $inputData) : InputDataDecoder;
    abstract public function toArray() : array;
}