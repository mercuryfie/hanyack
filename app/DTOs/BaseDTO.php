<?php
namespace App\DTOs;

abstract class BaseDTO
{
    public function __construct(
        public string $result,
        public mixed $info,
        public string $message = ''
    ) {}
}