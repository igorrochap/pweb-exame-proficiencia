<?php

namespace App\Exceptions\Product;

use Exception;

class QuantityNotAllowedException extends Exception
{
    protected $message = 'Movement quantity is not allowed.';
}
