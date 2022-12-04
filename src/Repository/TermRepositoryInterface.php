<?php

declare(strict_types=1);

namespace App\Repository;

interface TermRepositoryInterface
{
    public function findAllWithTranslations(): array;

    public function findForExport(?string $pack = null): iterable;
}
