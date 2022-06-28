<?php

use SMSTranscoder\Transcoder;

require_once "vendor/autoload.php";

echo Transcoder::transcode(file_get_contents('php://stdin'));