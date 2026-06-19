<?php

namespace App\Routing;

use Illuminate\Routing\UrlGenerator as BaseUrlGenerator;

class CustomUrlGenerator extends BaseUrlGenerator
{
    /**
     * In-memory cache for file_exists() results to avoid repeated stat calls.
     */
    private static array $fileExistsCache = [];

    /**
     * Cached environment check (null = not yet checked).
     */
    private static ?bool $isLocal = null;

    /**
     * Cached public path.
     */
    private static ?string $publicPath = null;

    /**
     * Generate the URL to an application asset.
     *
     * In local development, if an image asset is missing locally, we return the
     * production URL directly to avoid broken images on the frontend/admin.
     *
     * @param  string  $path
     * @param  bool|null  $secure
     * @return string
     */
    public function asset($path, $secure = null)
    {
        if ($this->isValidUrl($path)) {
            return $path;
        }

        // Cache the env check so we don't call config() hundreds of times
        if (self::$isLocal === null) {
            self::$isLocal = config('app.env') === 'local';
            self::$publicPath = public_path() . DIRECTORY_SEPARATOR;
        }

        if (self::$isLocal) {
            $cleanPath = ltrim($path, '/');

            // Check if it is a back/front asset image path
            if (str_starts_with($cleanPath, 'back/assets/images/') || str_starts_with($cleanPath, 'front/assets/imgs/')) {
                // Use cached file_exists result
                if (!isset(self::$fileExistsCache[$cleanPath])) {
                    self::$fileExistsCache[$cleanPath] = file_exists(self::$publicPath . str_replace('/', DIRECTORY_SEPARATOR, $cleanPath));
                }

                if (!self::$fileExistsCache[$cleanPath]) {
                    return 'https://smartgroceries.org/' . $cleanPath;
                }
            }
        }

        return parent::asset($path, $secure);
    }
}
