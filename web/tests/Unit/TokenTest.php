<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use App\Pipelines\PairKeyCheckPipeline;

beforeEach(function() {
    $this->data = [
        'name'    => 'Maulana Saputra',
        'email'   => 'maulana.saputra@aqi.co.id',
        'feature' => 'api',
        'exp'     => 1703983398
    ];
});

it('check pair key', function () {
    $encode = JWT::encode(['feature' => 'token'], file_get_contents(dirname(__DIR__) . DIRECTORY_SEPARATOR . "/../pair.sec"), 'RS256');
    $decode = JWT::decode($encode, new Key(file_get_contents(dirname(__DIR__) . DIRECTORY_SEPARATOR . "/../pair.pub"), 'RS256'));
    $this->assertEquals($decode->feature, 'token');
});

it('check pair key with pipeline', function (): void {
    $token    = JWT::encode($this->data, file_get_contents(dirname(__DIR__) . DIRECTORY_SEPARATOR . "/../pair.sec"), 'RS256');
    $pipeline = new PairKeyCheckPipeline;
    $response = $pipeline->__invoke(
        $token,
        next: fn () => $token,
    );
    expect($response)->toEqual($token);
});

// source : https://laravel-news.com/conditionally-assert-throwing-an-exception-in-pest

it('check pair key failed with pipeline', function (): void {
    $token    = JWT::encode($this->data, file_get_contents(dirname(__DIR__) . DIRECTORY_SEPARATOR . "/../pair.sec"), 'HS256');
    $pipeline = new PairKeyCheckPipeline;
    $response = $pipeline->__invoke(
        $token,
        next: fn () => $token,
    );
})->throws(\Exception::class, 'Failed decrypt token');