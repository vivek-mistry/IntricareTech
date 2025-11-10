<?php

namespace App\Repositories\Repository;

use App\Models\Contact;
use App\Repositories\Interface\ContactRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class ContactRepository implements ContactRepositoryInterface
{
    public function getPaginate(int $limit, ?string $search = null) : mixed
    {
        $entity = Contact::query();

        $entity->when($search, function($query) use ($search) {
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('phone', 'like', "%{$search}%")
                ->orWhere('gender', 'like', "%{$search}%");
        });

        $entity->orderBy('id', 'desc');

        return $entity->paginate($limit);
    }

    public function create(array $data) : mixed
    {
        return Contact::create($data);
    }

    public function update($contact, array $data) : mixed
    {
        return $contact->update($data);
    }
}
