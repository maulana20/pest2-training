<?php

namespace App\Pipelines;

use Closure;
use App;
use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Carbon\Carbon;

class PairKeyCheckPipeline
{
    public function __invoke($token, Closure $next): mixed
    {
        $decode = $this->decode($token);
        if (empty($decode)) App::abort(403, "Failed verify");
        if ($decode->exp < Carbon::now()->timestamp) App::abort(403, "Token expired");
        if ($decode->feature !== "api") App::abort(403, "Feature api not found");
        return $next($token);
    }

    private function decode($token)
    {
        try {
            $publicKey = file_get_contents(dirname(__DIR__) . DIRECTORY_SEPARATOR . "/../pair.pub");
            return JWT::decode($token, new Key($publicKey, 'RS256'));
        } catch (Exception $e) {
            throw new Exception("Failed decrypt token");
        }
        return null;
    }
}
