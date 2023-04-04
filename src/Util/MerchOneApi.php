<?php

namespace MerchOne\PhpSdk\Util;

use MerchOne\PhpSdk\Exceptions\InvalidApiVersionException;
use ReflectionClass;
use Tightenco\Collect\Support\Collection;

final class MerchOneApi
{
    /**
     * Base URL for MerchOne API.
     */
    public const BASE_URL = 'https://api.merchone.com/';

    /**
     * Available API versions.
     */
    public const VERSION_BETA = 'beta';

    /**
     * @param  string  $version
     * @param  string|null  $baseUrl
     * @return string
     *
     * @throws InvalidApiVersionException
     */
    public static function getBaseUrl(string $version = self::VERSION_BETA, string $baseUrl = null): string
    {
        $baseUrl = $baseUrl ?? self::BASE_URL;

        if (substr($baseUrl, -1) !== '/') {
            $baseUrl .= '/';
        }

        return $baseUrl . self::getVersionPath($version);
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
