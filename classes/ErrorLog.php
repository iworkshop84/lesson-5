<?php

/**
 * Class ErrorLog
 *
 * @property $message
 * @property $file
 * @property $line
 * @property $time
 *
 *
 */
class ErrorLog
{
    protected $data = [];

    public function __set($k, $v)
    {
        $this->data[$k] = $v;
    }


    public function __get($k)
    {
        return $this->data[$k];
    }

    public function assign($data)
    {
        $this->message = $data->getMessage();
        $this->file = $data->getFile();
        $this->line = $data->getLine();
        $this->time = date("Y-m-d H:i:s");
    }

    public function write()
    {
        $arr = $this->data;
        $str = implode(' | ', $arr);

        file_put_contents (__DIR__ ."/../errors.log",  $str . PHP_EOL, FILE_APPEND );

    }

    public static function read()
    {
        $res = file(__DIR__ ."/../errors.log");
        return $res;
    }

}