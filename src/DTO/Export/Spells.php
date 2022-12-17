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
            'path'      => 'system.learnedAt.subDomain',
            'converter' => 'learnedAt',
        ],
        'learnedAtBloodline' => [
            'path'      => 'system.learnedAt.bloodline',
            'converter' => 'learnedAt',
        ],
        'materials'          => 'system.materials.value',
        'subschool'          => 'system.subschool',
        'types'              => 'system.types',
    ];
    public iterable $entries;

    public function __construct(iterable $entries)
    {
        $this->entries = $entries;
    }
}
