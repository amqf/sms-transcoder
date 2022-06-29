<?php

namespace SMSTranscoder\Encoders;

use SMSTranscoder\OutputDataEncoder;

class JSONEncoder extends OutputDataEncoder
{
    public function toString() : string
    {
        return json_encode(
            $this->getData()
            , JSON_UNESCAPED_SLASHES
        );
    }
}