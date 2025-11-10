<?php

namespace App\Repositories\Interface;

interface ContactRepositoryInterface
{
    public function getPaginate(int $limit);

    public function create(array $data);
}