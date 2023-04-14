<?php

namespace MerchOne\PhpApiSdk\Util;

use Composer\InstalledVersions;

final class PackageInfo
{
    /**
     * @var string
     */
    private string $name = 'PHP';

    /**
     * @var string
     */
    private string $version = 'unknown';

    public function __construct()
    {
        $this->boot();
    }

    /**
     * @return string
     */
    public function getVersionName(): string
    {
        return str_replace('merch-one/', '', $this->name) . '/' . $this->version;
    }

    /**
     * @return void
     */
    private function boot(): void
    {
        $name = $this->name;

        try {
            $this->name = $this->currentPackage();
            $this->version = InstalledVersions::getPrettyVersion($this->name);
        } catch (\Throwable $e) {
            $this->name = $name;
            $this->version = $this->getVersionFromComposerJson();
        }
    }

    /**
     * @return string
     * @noinspection JsonEncodingApiUsageInspection
     */
    private function getVersionFromComposerJson(): string
    {
        try {
            $json = json_decode(
                file_get_contents(__DIR__ . '/../../composer.json'),
                true
            );

            return $json['version'];
        } catch (\Throwable $e) {
            return 'unknown';
        }
    }

    /**
     * @return string
     */
    private function currentPackage(): string
    {
        if (InstalledVersions::isInstalled('merch-one/laravel-api-sdk')) {
            return 'merch-one/laravel-api-sdk';
        }

        return 'merch-one/php-api-sdk';
    }
}
