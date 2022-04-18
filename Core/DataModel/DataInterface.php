<?php

namespace Core\DataModel;

interface DataInterface
{
    public function find(string $field, $value): ?array;
}