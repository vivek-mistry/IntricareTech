<?php

namespace App\Repositories\Repository;

use App\Models\Contact;
use App\Repositories\Interface\ContactRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class ContactRepository implements ContactRepositoryInterface
{
    public function getPaginate(int $limit) : mixed
    {
        $entity = Contact::query();

        $entity->orderBy('id', 'desc');

        return $entity->paginate($limit);
    }

    public function create(array $data) : mixed
    {
        return Contact::create($data);
    }
}
