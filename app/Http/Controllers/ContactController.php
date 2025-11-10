<?php

namespace App\Http\Controllers;

use App\Repositories\Interface\ContactRepositoryInterface;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    protected $contactRepository;

    public function __construct(ContactRepositoryInterface $contactRepository)
    {
        $this->contactRepository = $contactRepository;
    }

    public function index() {
        return view('contact.index');
    }

    public function ajaxList(Request $request) {
        $contacts = $this->contactRepository->getPaginate(10);

        $html = view('contact.list', compact('contacts'))->render();

        $pagination = $contacts->links()->render();

        return response()->json([
            'html' => $html,
            'pagination' => $pagination,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'gender' => 'required',
            // 'profile_image' => 'required',
            // 'document_file' => 'required',
            // 'contact_custom_fields' => 'required',
        ]);

        $contact = $this->contactRepository->create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Contact created successfully',
            'data' => $contact,
        ]);
    }
}
