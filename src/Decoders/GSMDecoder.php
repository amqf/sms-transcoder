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

        for($line=1; $line < count($data)-2; $line++)
        {
            $data = [
                'header' => explode(',', $data[$line]),
                'text' => $data[$line+1],
            ];

            $messages[] = [
                'seq' => str_replace('+CMGL: ', '', $data['header'][0]),
                'status' => str_replace('"', '', $data['header'][1]),
                'from' => str_replace('"', '', $data['header'][2]),
                'timestamp' => str_replace('"', '', sprintf("%s %s", $data['header'][4], $data['header'][5])),
                'text' => str_replace('"', '', $data['text']),
            ];
        }

        return $messages;
    }
}