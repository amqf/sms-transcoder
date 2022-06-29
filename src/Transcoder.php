<?php

namespace SMSTranscoder;

use SMSTranscoder\InputDataDecoder;
use SMSTranscoder\OutputDataEncoder;

class Transcoder
{
    public function __construct(
        private InputDataDecoder $inputDataDecoder,
        private OutputDataEncoder $outputDataEncoder
    )
    {
    }

    public function transcode() : string
    {
        return $this->outputDataEncoder
            ->setData($this->inputDataDecoder->toArray())
            ->toString();
    }
}