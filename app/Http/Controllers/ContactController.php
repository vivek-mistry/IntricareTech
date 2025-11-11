<?php

namespace App\Http\Controllers;

use App\Facades\FileUpload;
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

        $data = $request->all();

        $contactCustomFields = [];
        if($request->has('field_name')) {
            foreach ($request->field_name as $key => $value) {
                $contactCustomFields[$request->field_value[$key]] = $value;
            }
        }
        

        $data['contact_custom_fields'] = $contactCustomFields;
        if($request->hasFile('profile_image')) {
            $data['profile_image'] = FileUpload::upload(Contact::FOLDER_NAME, $request->file('profile_image'));
        }

        if($request->hasFile('document_file')) {
            $data['document_file'] = FileUpload::upload(Contact::FOLDER_NAME, $request->file('document_file'));
        }

        $contact = $this->contactRepository->create($data);

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

        $data = $request->all();

        $contactCustomFields = [];
        if($request->has('field_name')) {
            foreach ($request->field_name as $key => $value) {
                $contactCustomFields[$request->field_value[$key]] = $value;
            }
        }
        

        $data['contact_custom_fields'] = $contactCustomFields;

        if($request->hasFile('profile_image')) {
            $data['profile_image'] = FileUpload::upload(Contact::FOLDER_NAME, $request->file('profile_image'));
        }

        if($request->hasFile('document_file')) {
            $data['document_file'] = FileUpload::upload(Contact::FOLDER_NAME, $request->file('document_file'));
        }

        $contact = $this->contactRepository->update($contact, $data);

        return response()->json([
            'success' => true,
            'message' => 'Contact updated successfully',
            'data' => $contact,
        ]);
    }
}
