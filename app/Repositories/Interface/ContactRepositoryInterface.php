<?php

namespace App\Repositories\Interface;

interface ContactRepositoryInterface
{
    public function getPaginate(int $limit, ?string $search =null);

    public function create(array $data);
}