<?php

namespace SMSTranscoder;

class Transcoder
{
    public static function transcode(string $input) : string
    {
        $data = explode("\n", $input);
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

        return json_encode($messages, JSON_UNESCAPED_SLASHES);
    }
}