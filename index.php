<?php

use SMSTranscoder\Decoders\GSMDecoder;
use SMSTranscoder\Encoders\JSONEncoder;
use SMSTranscoder\Transcoder;

require_once "vendor/autoload.php";

echo (new Transcoder(
    GSMDecoder::make('php://stdin'),
    new JSONEncoder
))->transcode();