<?php

namespace App\Http\Controllers;

use App\Models\Contact;
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
        $contacts = $this->contactRepository->getPaginate(
            limit : 10,
            search : $request->search
        );

        $html = view('contact.list', compact('contacts'))->render();

        $pagination = $contacts->links('components.pagination')->render();

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

    public function destroy(Contact $contact)
    {
        $contact->delete();

        return response()->json([
            'success' => true,
            'message' => 'Contact deleted successfully',
        ]);
    }

    public function edit(Contact $contact)
    {
        return response()->json($contact);
    }

    public function update(Request $request, Contact $contact)
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

        $contact = $this->contactRepository->update($contact, $request->all());

        return response()->json([
            'success' => true,
            'message' => 'Contact updated successfully',
            'data' => $contact,
        ]);
    }
}
