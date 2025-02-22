<?php
/**
 * Slim Framework (https://slimframework.com)
 *
 * @license https://github.com/slimphp/Slim/blob/3.x/LICENSE.md (MIT License)
 */

namespace Slim\Http;

use Slim\Collection;
use Slim\Interfaces\Http\HeadersInterface;

/**
 * This class represents a collection of HTTP headers
 * that is used in both the HTTP request and response objects.
 * It also enables header name case-insensitivity when
 * getting or setting a header value.
 *
 * Each HTTP header can have multiple values. This class
 * stores values into an array for each header name. When
 * you request a header value, you receive an array of values
 * for that header.
 */
class Headers extends Collection implements HeadersInterface
{
    /**
     * Special HTTP headers that do not have the "HTTP_" prefix
     *
     * @var array
     */
    protected static $special = [
        'CONTENT_TYPE' => 1,
        'CONTENT_LENGTH' => 1,
        'PHP_AUTH_USER' => 1,
        'PHP_AUTH_PW' => 1,
        'PHP_AUTH_DIGEST' => 1,
        'AUTH_TYPE' => 1,
    ];

    /**
     * Create new headers collection with data extracted from the application Environment object
     *
     * @param Environment $environment The Slim application Environment
     *
     * @return self
     */
    public static function createFromEnvironment(Environment $environment): Headers
    {
        $data = [];
        $environment = self::determineAuthorization($environment);
        foreach ($environment as $key => $value) {
            $key = strtoupper($key);
            if (isset(static::$special[$key]) || str_starts_with($key, 'HTTP_')) {
                if ($key !== 'HTTP_CONTENT_LENGTH') {
                    $data[$key] =  $value;
                }
            }
        }

        return new static($data);
    }

    /**
     * If HTTP_AUTHORIZATION does not exist tries to get it from getallheaders() when available.
     *
     * @param Environment $environment The Slim application Environment
     *
     * @return Environment
     */

    public static function determineAuthorization(Environment $environment): Environment
    {
        $authorization = $environment->get('HTTP_AUTHORIZATION');
        if (!empty($authorization) || !is_callable('getallheaders')) {
            return $environment;
        }

        $headers = getallheaders();
        if (!is_array($headers)) {
            return $environment;
        }

        $headers = array_change_key_case($headers, CASE_LOWER);
        if (isset($headers['authorization'])) {
            $environment->set('HTTP_AUTHORIZATION', $headers['authorization']);
        }

        return $environment;
    }

    /**
     * Return array of HTTP header names and values.
     * This method returns the _original_ header name as specified by the end user.
     *
     * @return array
     */
    public function all(): array
    {
        $all = parent::all();
        $out = [];
        foreach ($all as $key => $props) {
            $out[$props['originalKey']] = $props['value'];
        }

        return $out;
    }

    /**
     * Set HTTP header value
     *
     * This method sets a header value. It replaces
     * any values that may already exist for the header name.
     *
     * @param string       $key   The case-insensitive header name
     * @param array|string $value The header value
     */
    public function set($key, $value): void
    {
        if (!is_array($value)) {
            $value = [$value];
        }
        parent::set($this->normalizeKey($key), [
            'value' => $value,
            'originalKey' => $key
        ]);
    }

    /**
     * Get HTTP header value
     *
     * @param  string  $key     The case-insensitive header name
     * @param  mixed   $default The default value if key does not exist
     *
     * @return string[]
     */
    public function get($key, $default = null): array
    {
        if ($this->has($key)) {
            return parent::get($this->normalizeKey($key))['value'];
        }

        return $default;
    }

    /**
     * Get HTTP header key as originally specified
     *
     * @param string $key     The case-insensitive header name
     * @param mixed|null $default The default value if key does not exist
     *
     * @return string
     */
    public function getOriginalKey(string $key, mixed $default = null): mixed
    {
        if ($this->has($key)) {
            return parent::get($this->normalizeKey($key))['originalKey'];
        }

        return $default;
    }

    /**
     * {@inheritdoc}
     */
    public function add($key, $value): void
    {
        $oldValues = $this->get($key, []);
        $newValues = is_array($value) ? $value : [$value];
        $this->set($key, array_merge($oldValues, array_values($newValues)));
    }

    /**
     * Does this collection have a given header?
     *
     * @param  string $key The case-insensitive header name
     *
     * @return bool
     */
    public function has($key): bool
    {
        return parent::has($this->normalizeKey($key));
    }

    /**
     * Remove header from collection
     *
     * @param  string $key The case-insensitive header name
     */
    public function remove($key): void
    {
        parent::remove($this->normalizeKey($key));
    }

    /**
     * {@inheritdoc}
     */
    public function normalizeKey($key): string
    {
        $key = strtr(strtolower($key), '_', '-');
        if (str_starts_with($key, 'http-')) {
            $key = substr($key, 5);
        }

        return $key;
    }
}
