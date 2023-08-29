<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use App\Pipelines\PairKeyCheckPipeline;

it('check pair key', function () {
    $encode = JWT::encode(['feature' => 'token'], file_get_contents(dirname(__DIR__) . DIRECTORY_SEPARATOR . "/../pair.sec"), 'RS256');
    $decode = JWT::decode($encode, new Key(file_get_contents(dirname(__DIR__) . DIRECTORY_SEPARATOR . "/../pair.pub"), 'RS256'));
    $this->assertEquals($decode->feature, 'token');
});

it('check pair key with pipeline', function (): void {
    $token = JWT::encode([
        'name' => 'Maulana Saputra',
        'email' => 'maulana.saputra@aqi.co.id',
        'feature' => 'api',
        'exp' => 1703983398
    ], file_get_contents(dirname(__DIR__) . DIRECTORY_SEPARATOR . "/../pair.sec"), 'RS256');

    $pipeline = new PairKeyCheckPipeline;
    $response = $pipeline->__invoke(
        $token,
        next: fn () => $token,
    );
    expect($response)->toEqual($token);
});