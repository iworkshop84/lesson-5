<?php

/**
 * Class ErrorLog
 *
 * @property $message
 * @property $file
 * @property $line
 * @property $time
 * @property $code
 *
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
        $this->message = 'Сообщение: ' . $data->getMessage();
        $this->code = 'Код ошибки: ' . $data->getCode();
        $this->file = 'Файл: ' .$data->getFile();
        $this->line = 'Строка: ' .$data->getLine();
        $this->time = 'Дата: ' . date("Y-m-d H:i:s");
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