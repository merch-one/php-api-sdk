<?php

/** @noinspection ALL */

namespace MerchOne\PhpSdk\Util;

use Tightenco\Collect\Support\Collection;
use Tightenco\Collect\Support\Enumerable;

/**
 * @method static self make(array|Enumerable $items = [])
 * @method self|string|int|bool|float|null first(callable $callback = null, $default = null)
 * @method self|mixed last(callable $callback = null, $default = null)(callable $callback = null, $default = null)
 */
class Data extends Collection
{
    /**
     * @param $items
     */
    public function __construct($items = [])
    {
        $items = $items ?? [];

        foreach ($items as $key => $value) {
            if (is_array($value)) {
                $value = new self($value);
            }

            if ($value instanceof Enumerable) {
                $value = new self($value->toArray());
            }

            $items[$key] = $value;
        }

        parent::__construct($items);
    }

    /**
     * Get the option by the given key.
     *
     * @param  string  $key
     * @return string|array|bool|float|int|object|null
     */
    public function __get($key)
    {
        return $this->get($key) ?? $this->get(Str::snake($key));
    }

    /**
     * @param  string  $name
     * @param  mixed  $value
     * @return void
     */
    public function __set(string $name, $value): void
    {
        $value = $this->isMakeable($value) ? self::make($value) : $value;
        $this->offsetSet($name, $value);
    }

    /**
     * Put an item in the collection by key.
     *
     * @param  mixed  $key
     * @param  mixed  $value
     * @return $this
     */
    public function put($key, $value): Data
    {
        $this->__set($key, $value);

        return $this;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return Collection::make($this->items)->toArray();
    }

    /**
     * @param  mixed  $value
     * @return bool
     */
    private function isMakeable($value): bool
    {
        return is_array($value) || $value instanceof Collection;
    }
}
