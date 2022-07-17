<?php

namespace Hotash;

use ArrayAccess;
use ArrayObject;
use Illuminate\Support\Arr;
use Illuminate\Support\Traits\Macroable;

class Ignorable implements ArrayAccess
{
    use Macroable {
        __call as macroCall;
    }

    public bool $skip;

    protected mixed $value;

    public function __construct(mixed $value, callable|bool $when = false)
    {
        $this->value = $value;
        $this->ignore($when);
    }

    public static function make(mixed $value, callable|bool $when = false): mixed
    {
        return new static($value, $when);
    }

    public function ignore(callable|bool $when = true): static
    {
        $this->skip = $this->shouldSkip($when);

        return $this;
    }

    public function discard(callable|bool $when = true): static
    {
        $this->skip = ! $this->shouldSkip($when);

        return $this;
    }

    public function shouldSkip(callable|bool $when): bool
    {
        return is_callable($when) ? $when() : $when;
    }

    public function dump(): static
    {
        dump($this->value);

        return $this;
    }

    public function dd()
    {
        dd($this->value);
    }

    public function __get(string $key)
    {
        if ($key === 'value') {
            return $this->value;
        }

        if ($this->skip) {
            return $this;
        }

        if (is_object($this->value)) {
            $this->value = $this->value->{$key};
        }

        return $this;
    }

    public function __isset($name)
    {
        if (is_object($this->value)) {
            return isset($this->value->{$name});
        }

        if (is_array($this->value) || $this->value instanceof ArrayObject) {
            return isset($this->value[$name]);
        }

        return false;
    }

    public function offsetExists($offset): bool
    {
        return Arr::accessible($this->value) && Arr::exists($this->value, $offset);
    }

    public function offsetGet($offset): static
    {
        $this->value = Arr::get($this->value, $offset);

        return $this;
    }

    public function offsetSet($offset, $value): void
    {
        if (Arr::accessible($this->value)) {
            $this->value[$offset] = $value;
        }
    }

    public function offsetUnset($offset): void
    {
        if (Arr::accessible($this->value)) {
            unset($this->value[$offset]);
        }
    }

    public function __call($method, $parameters)
    {
        if ($this->skip) {
            return $this;
        }

        if (static::hasMacro($method)) {
            $this->value = $this->macroCall($method, $parameters);
        }

        if (is_object($this->value)) {
            $this->value = $this->value->{$method}(...$parameters);
        }

        return $this;
    }
}
