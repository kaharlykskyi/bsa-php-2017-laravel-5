<?php

namespace App;

class AbstractEntity
{
    /**
     * @var array Field which can be filled with the fromArray function.
     */
    protected $fillable = [];

    /**
     * Fills the entity with data.
     *
     * @param array $data
     * @return \App\AbstractEntity
     */
    public function fromArray(array $data): AbstractEntity
    {
        if (empty($this->fillable)) {
            return $this;
        }

        foreach ($this->fillable as $field) {
            if (array_has($data, $field)) {
                $this->$field = $data[$field];
            } elseif (array_has($data, snake_case($field))) {
                $this->$field = $data[snake_case($field)];
            }
        }

        return $this;
    }

}