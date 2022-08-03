<?php

namespace App\DTO;

class Term
{
    public function __construct(
        public string $name,
        public string $description,
    ) {
    }
}
