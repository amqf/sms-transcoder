<?php

use PHPUnit\Framework\TestCase;
use SMSTranscoder\Decoders\GSMDecoder;

class GSMDecoderTest extends TestCase
{
    public function testToArray()
    {
        $input = <<<INPUT
AT+CMGL="ALL"
+CMGL: 1,"REC READ","+55113883828846","","22/05/05,16:04:23+08"
00480065006C006C006F00200077006F0072006C0064002000C1
+CMGL: 2,"REC UNREAD","+5511388382882","","22/05/10,13:54:14+08"
Essa eh a segunda mensagem
OK
INPUT;

        $expectedArray = [
            [
                'seq' => '1',
                'status' => 'REC READ',
                'from' => '+55113883828846',
                'timestamp' => '22/05/05 16:04:23+08',
                'text' => '00480065006C006C006F00200077006F0072006C0064002000C1',
            ],
            [
                'seq' => '2',
                'status' => 'REC UNREAD',
                'from' => '+5511388382882',
                'timestamp' => '22/05/10 13:54:14+08',
                'text' => 'Essa eh a segunda mensagem',
            ]
        ];

        $result = (new GSMDecoder($input))->toArray();

        $this->assertEquals($result, $expectedArray);
    }
}
?>