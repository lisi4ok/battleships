<?php
/**
 * @package Battleships
 * @author  Zaio Klepoyshkov <master@lisi4ok.com>
 */

declare(strict_types=1);

namespace Battleships;

final class Player
{
    private array $fields = [];

    public function __construct(array $ships)
    {
        $this->setFields($ships);
    }

    public function getField(int $type, bool $stringified = false) : array|string
    {
        return $this->fields[$type]->get($stringified);
    }

    public function getFields() : array
    {
        return $this->fields;
    }

    public function setFields(array $ships) : self
    {
        $this->fields = [
            Field::VISIBLE => new Field($ships),
            Field::HIDDEN  => new Field,
        ];

        return $this;
    }
}