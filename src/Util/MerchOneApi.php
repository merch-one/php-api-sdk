<?php

namespace MerchOne\PhpApiSdk\Util;

use MerchOne\PhpApiSdk\Exceptions\InvalidApiVersionException;
use ReflectionClass;
use Tightenco\Collect\Support\Collection;

final class MerchOneApi
{
    /**
     * Host URL for MerchOne API.
     */
    public const HOST = 'https://api.merchone.com/';

    /**
     * Available API versions.
     */
    public const VERSION_BETA = 'beta';

    /**
     * @param  string  $version
     * @param  string|null  $host
     * @return string
     *
     * @throws InvalidApiVersionException
     */
    public static function getBaseUrl(string $version = self::VERSION_BETA, string $host = null): string
    {
        $host = $host ?? self::HOST;

        if (substr($host, -1) !== '/') {
            $host .= '/';
        }

        return $host . self::getVersionPath($version);
    }

    /**
     * @param  string  $version
     * @return string
     *
     * @throws InvalidApiVersionException
     */
    public static function getVersionPath(string $version): string
    {
        self::validateVersion($version);

        return "api/{$version}/";
    }

    /**
     * @return array
     */
    public static function getVersions(): array
    {
        return self::getConstants()
            ->filter(
                static fn ($value, string $key): bool => strpos($key, 'VERSION') === 0
            )->values()->toArray();
    }

    /**
     * @param  string  $version
     * @return void
     *
     * @throws InvalidApiVersionException
     */
    private static function validateVersion(string $version): void
    {
        if (! in_array($version, self::getVersions(), true)) {
            throw new InvalidApiVersionException("Invalid API version: {$version}");
        }
    }

    /**
     * @return Collection
     */
    private static function getConstants(): Collection
    {
        return new Collection(
            (new ReflectionClass(self::class))->getConstants()
        );
    }
}
