<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

it('check pair key', function () {
    $encode = JWT::encode(['feature' => 'token'], file_get_contents(dirname(__DIR__) . DIRECTORY_SEPARATOR . "/../pair.sec"), 'RS256');
    $decode = JWT::decode($encode, new Key(file_get_contents(dirname(__DIR__) . DIRECTORY_SEPARATOR . "/../pair.pub"), 'RS256'));
    $this->assertEquals($decode->feature, 'token');
});