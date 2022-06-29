<?php
use PHPUnit\Framework\TestCase;
use SMSTranscoder\Decoders\GSMDecoder;
use SMSTranscoder\Encoders\JSONEncoder;
use SMSTranscoder\Transcoder;

class TranscoderTest extends TestCase
{
    public function testTranscoder()
    {
        $input = <<<INPUT
AT+CMGL="ALL"
+CMGL: 1,"REC READ","+5511388382882","","22/05/05,16:04:23+08"
00480065006C006C006F00200077006F0072006C0064002000C1
+CMGL: 2,"REC UNREAD","+5511388382882","","22/05/10,13:54:14+08"
Essa eh a segunda mensagem
+CMGL: 3,"REC UNREAD","+551130872258","","22/05/30,19:37:01+08"
Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam...
OK
INPUT;
        $output = '[{"seq":"1","status":"REC READ","from":"+5511388382882","timestamp":"22/05/05 16:04:23+08","text":"00480065006C006C006F00200077006F0072006C0064002000C1"},{"seq":"2","status":"REC UNREAD","from":"+5511388382882","timestamp":"22/05/10 13:54:14+08","text":"Essa eh a segunda mensagem"},{"seq":"3","status":"REC UNREAD","from":"+551130872258","timestamp":"22/05/30 19:37:01+08","text":"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam..."}]';

        $transcoder = new Transcoder(
            new GSMDecoder($input),
            new JSONEncoder
        );

        $this->assertEquals($transcoder->transcode(), $output);
    }
}
?>