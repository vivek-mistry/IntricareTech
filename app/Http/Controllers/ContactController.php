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

    public function index()
    {
        return view('contact.index');
    }

    public function ajaxList(Request $request)
    {
        $contacts = $this->contactRepository->getPaginate(limit: 10, search: $request->search);

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
        if ($request->has('field_name')) {
            foreach ($request->field_name as $key => $value) {
                $contactCustomFields[$request->field_value[$key]] = $value;
            }
        }

        $data['contact_custom_fields'] = $contactCustomFields;
        if ($request->hasFile('profile_image')) {
            $data['profile_image'] = FileUpload::upload(Contact::FOLDER_NAME, $request->file('profile_image'));
        }

        if ($request->hasFile('document_file')) {
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
        if ($request->has('field_name')) {
            foreach ($request->field_name as $key => $value) {
                $contactCustomFields[$request->field_value[$key]] = $value;
            }
        }

        $data['contact_custom_fields'] = $contactCustomFields;

        if ($request->hasFile('profile_image')) {
            $data['profile_image'] = FileUpload::upload(Contact::FOLDER_NAME, $request->file('profile_image'));
        }

        if ($request->hasFile('document_file')) {
            $data['document_file'] = FileUpload::upload(Contact::FOLDER_NAME, $request->file('document_file'));
        }

        $contact = $this->contactRepository->update($contact, $data);

        return response()->json([
            'success' => true,
            'message' => 'Contact updated successfully',
            'data' => $contact,
        ]);
    }

    public function dropdown($id)
    {
        $contacts = Contact::where('id', '!=', $id)->where('status', '=', 'active')->get();

        $html = '';
        foreach ($contacts as $contact) {
            $html .= "<option value='" . $contact->id . "'>" . $contact->name . '</option>';
        }

        return response()->json($html);
    }

    public function contactMerge(Request $request)
    {
        $request->validate([
            'master_contact_id' => 'required|exists:contacts,id',
            'slave_contact_id' => 'required|different:master_contact_id|exists:contacts,id',
        ]);

        $master = Contact::findOrFail($request->master_contact_id);
        $slave = Contact::findOrFail($request->slave_contact_id);

        // --- Backup full slave contact data ---
        $slave_backup = $slave->toArray();

        // --- Merge phone/email if different ---
        if ($slave->email && $slave->email !== $master->email) {
            // store multiple emails in custom fields to preserve
            $custom_fields = $master->contact_custom_fields ?? [];
            $custom_fields['extra_emails'][] = $slave->email;
            $master->contact_custom_fields = $custom_fields;
        }

        if ($slave->phone && $slave->phone !== $master->phone) {
            $custom_fields = $master->contact_custom_fields ?? [];
            $custom_fields['extra_phones'][] = $slave->phone;
            $master->contact_custom_fields = $custom_fields;
        }

        // --- Merge custom fields ---
        $master_fields = $master->contact_custom_fields ?? [];
        $slave_fields = $slave->contact_custom_fields ?? [];

        foreach ($slave_fields as $key => $value) {
            if (!array_key_exists($key, $master_fields)) {
                $master_fields[$key] = $value;
            } elseif ($master_fields[$key] !== $value) {
                // Append both values as array if they differ
                $master_fields[$key] = array_unique([$master_fields[$key], $value]);
            }
        }

        $master->contact_custom_fields = $master_fields;

        // --- Save updated master contact ---
        $master->save();

        // --- Mark slave as merged/inactive ---
        $slave->status = 'merged';
        // dd($slave->status);
        $slave->merged_into_id = $master->id;
        $slave->merged_data_backup = $slave_backup;
        $slave->save();

        return response()->json([
            'success' => true,
            'message' => 'Contacts merged successfully.',
            'master_contact_id' => $master->id,
            'slave_contact_id' => $slave->id,
        ]);
    }
}
