<?php

namespace SMSTranscoder\Decoders;

use SMSTranscoder\InputDataDecoder;

class GSMDecoder extends InputDataDecoder
{
    public function __construct(private string $data)
    {
    }

    public static function make(string $inputData) : InputDataDecoder
    {
        return new static(file_get_contents($inputData));
    }

    public function toArray() : array
    {
        $data = explode("\n", $this->data);
        $messages = [];

        for($line=1; $line < count($data)-2; $line+=2)
        {
            $message = [
                'header' => explode(',', $data[$line]),
                'text' => $data[$line+1],
            ];

            $messages[] = [
                'seq' => str_replace('+CMGL: ', '', $message['header'][0]),
                'status' => str_replace('"', '', $message['header'][1]),
                'from' => str_replace('"', '', $message['header'][2]),
                'timestamp' => str_replace('"', '', sprintf("%s %s", $message['header'][4], $message['header'][5])),
                'text' => str_replace('"', '', $message['text']),
            ];
        }

        return $messages;
    }
}