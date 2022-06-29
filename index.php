<?php

use SMSTranscoder\Decoders\GSMDecoder;
use SMSTranscoder\Encoders\JSONEncoder;
use SMSTranscoder\Transcoder;

require_once "vendor/autoload.php";

try
{
    echo (new Transcoder(
        GSMDecoder::make('php://stdin'),
        new JSONEncoder
    ))->transcode();
}catch(\Exception $ex)
{
    // Tip: here we can use some monitoring tool like sentry.io

    echo sprintf(
        "\nTranscoder ERROR. \n\n%s. \n\n%s"
        , $ex->getMessage()
        , $ex->getTraceAsString()
    );
    exit(1);
}