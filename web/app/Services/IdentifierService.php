<?php

namespace App\Services;

class IdentifierService
{
    private const IDENTIFIERS = [
        "ztna" => ["name" => "Zero Trust Network Access"],
        "kasm" => ["name" => "Streaming Container"]
    ];

    public function __construct($identifier = null)
    {
        if (is_null($identifier)) $identifier = self::identifierByPath(request());
        if (! array_key_exists($identifier, static::IDENTIFIERS)) {
            throw new \Exception("unsupported service");
        }
        $this->identifier = $identifier;
    }
    
    public function getName()
    {
        return static::IDENTIFIERS[$this->identifier]["name"];
    }
    
    public static function identifierByPath($request)
    {
        $identifier = $request->route()->parameter("identifier");
        if (is_null($identifier)) {
            $path = explode('/', $request->path());
            if (isset($path[3]) && array_key_exists($path[3], static::IDENTIFIERS)) {
                $identifier = $path[3];
                $request->route()->setParameter("identifier", $identifier);
            }
        }
        return $identifier;
    }
}
