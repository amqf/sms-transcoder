<?php

use SMSTranscoder\Decoders\GSMDecoder;
use SMSTranscoder\Transcoder;

require_once "vendor/autoload.php";

echo (new Transcoder(
    GSMDecoder::make(file_get_contents('php://stdin')),
    
))->transcode();