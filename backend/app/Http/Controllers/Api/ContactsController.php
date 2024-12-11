<?php

namespace App\Http\Controllers\Api;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\ContactResource;
use App\Http\Controllers\Api\BaseController;


     /**
     * @group Contact Management.
     */

class ContactsController extends BaseController
{
   /**
     * All Contact.
     */
    public function index(): JsonResponse
    {
        $contacts = Contact::all();
        return $this->sendResponse(['Contact'=> ContactResource::collection($contacts)], "Contact retrived successfuly");

    }

    /**
     * Store Contact.
     * @bodyParam clientId string The client id of the Contact.
     * @bodyParam contactPerson string The contact person of the Contact.
     * @bodyParam department string The department of the Contact.
     * @bodyParam designation string The designation of the Contact.
     * @bodyParam mobile1 string The mobile1 of the Contact.
     * @bodyParam mobile2 string The mobile2 of the Contact.
     * @bodyParam email string The email of the Contact.
     */
    public function store(Request $request): JsonResponse
    {
        $contact = new Contact();
        $contact->client_id = $request->input("clientId");
        $contact->contact_person = $request->input("contactPerson");
        $contact->department = $request->input("department");
        $contact->designation = $request->input("designation");
        $contact->mobile_1 = $request->input("mobile1");
        $contact->mobile_2 = $request->input("mobile2");
        $contact->email = $request->input("email");
        $contact->save();
        return $this->sendResponse(['Contact'=> new ContactResource($contact)], "Contact Stored successfuly");

    }
         
    /**
     * Show Contact.
     */
    public function show(string $id): JsonResponse
    {
        $contact = Contact::find($id);
        if(!$contact){
            return $this->sendError("Contact not found.", ['Error'=> "Contact not found"]);
        }
        return $this->sendResponse(['Contact'=> new ContactResource($contact)], "Contact retrived successfuly");

    }

    /**
     * Update Contact.
     * @bodyParam clientId string The client id of the Contact.
     * @bodyParam contactPerson string The contact person of the Contact.
     * @bodyParam department string The department of the Contact.
     * @bodyParam designation string The designation of the Contact.
     * @bodyParam mobile1 string The mobile1 of the Contact.
     * @bodyParam mobile2 string The mobile2 of the Contact.
     * @bodyParam email string The email of the Contact.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $contact = Contact::find($id);
        if(!$contact){
            return $this->sendError("Contact not found.", ['Error'=> "Contact not found"]);
        }

        $contact->client_id = $request->input("clientId");
        $contact->contact_person = $request->input("contactPerson");
        $contact->department = $request->input("department");
        $contact->designation = $request->input("designation");
        $contact->mobile_1 = $request->input("mobile1");
        $contact->mobile_2 = $request->input("mobile2");
        $contact->email = $request->input("email");
        $contact->save();
        return $this->sendResponse(['Contact'=> new ContactResource($contact)], "Contact Updated successfuly");
         
    }

    /**
     * Destroy Contact.
     */
    public function destroy(string $id): JsonResponse
    {
        $contact = Contact::find($id);
        if(!$contact){
            return $this->sendError("Contact not found.", ['Error'=> "Contact not found"]);
        }
         $contact->delete();
         return $this->sendResponse([], "Contact Deleted successfuly");
    }
}