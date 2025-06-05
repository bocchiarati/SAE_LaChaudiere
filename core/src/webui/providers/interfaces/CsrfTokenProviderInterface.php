<?php

namespace App\webui\providers\interfaces;

interface CsrfTokenProviderInterface {
    static function generate() : string;
    static function check($token) : bool;
}