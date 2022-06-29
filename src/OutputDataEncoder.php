<?php

namespace SMSTranscoder;

abstract class OutputDataEncoder
{
    private array $data = [];

    public function setData(array $data) : static
    {
        $this->data = $data;
        return $this;
    }

    public function getData() : array
    {
        return $this->data;
    }

    abstract public function toString() : string;
}