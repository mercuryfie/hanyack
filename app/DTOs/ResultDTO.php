<?php
namespace App\DTOs;

use App\DTOs\BaseDTO;


class ResultDTO extends BaseDTO
{

    public static function success(mixed $info = null): self
    {
        return new self('ok', $info,'');
    }

    public static function fail(string $result = 'error',mixed $info = null,string $msg = ''): self
    {
        return new self($result, $info, $msg);
    }

}


