<?php

namespace App\DTO\Export;

class Spells
{
    public string $label = 'Sorts';
    public array $mapping = [
        'actions'            => [
            'path'      => 'system.actions',
            'converter' => 'actions',
        ],
        'description'        => 'system.shortDescription',
        'learnedAtClass'     => [
            'path'      => 'system.learnedAt.class',
            'converter' => 'learnedAt',
        ],
        'learnedAtDomain'    => [
            'path'      => 'system.learnedAt.domain',
            'converter' => 'learnedAt',
        ],
        'learnedAtSubdomain' => [
            'path'      => 'system.learnedAt.subdomain',
            'converter' => 'learnedAt',
        ],
        'learnedAtBloodline' => [
            'path'      => 'system.learnedAt.bloodline',
            'converter' => 'learnedAt',
        ],
        'materials'          => 'system.materials.value',
        'subschool'          => 'system.subschools',
        'types'              => 'system.types',
    ];
    public array $entries;

    public function __construct(array $entries)
    {
        $this->entries = $entries;
    }
}
