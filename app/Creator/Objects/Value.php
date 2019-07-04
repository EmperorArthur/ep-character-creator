<?php


namespace App\Creator\Objects;

/**
 * This represents a modifier to an object, or an object's value
 *
 * Historically, something like $morphMod
 * It also handles min, max and absolute values (as seen in EPReputation)
 */
class Value
{
    /**
     * @var int
     */
    private $value;
    /**
     * @var int
     */
    private $min;
    /**
     * @var int
     */
    private $max;
    /**
     * @var int
     */
    private $absolute;

    public function __construct(int $value, int $max = PHP_INT_MAX, int $min = PHP_INT_MIN, int $absolute = PHP_INT_MAX)
    {
        $this->value = $value;
        $this->max = $max;
        $this->min = $min;
        $this->absolute = $absolute;
    }

    public function get()
    {
        return $this->value;
    }

    /**
     * Set a new value, but only as high as max and absolute, and only as low as min
     * @param int $newValue
     */
    public function set(int $newValue)
    {
        $this->value = max($this->absolute, max($this->max, min($this->min, $newValue)));
    }

    public function __call($name, $arguments)
    {
        return $this->get();
    }
}