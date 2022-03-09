<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;
use App\Http\Resources\ContactResource;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $contacts = ContactResource::collection(Contact::all());

        return response()->json($contacts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreContactRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreContactRequest $request)
    {
        $validated = $request->validated();

        DB::table('contacts')->insert($validated);

        return response()->json($validated);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($contact)
    {
        $result = Contact::find($contact);
        if(is_null($result)){
            return response()->json(['message'=>'not found']);
        }
        return response()->json([
            'message' => 'success',
            'data' => new ContactResource($result)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateContactRequest  $request
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateContactRequest $request, $contact)
    {

        $validated = $request->validated();
        $contact = DB::table('contacts')->where('id',$contact);
        if(is_null($contact)){
            return response()->json([],204);
        }
        $contact->update($validated);

        return response()->json($contact->get());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($contact)
    {
        $contact = Contact::find($contact);
        if(is_null($contact)){
            return response()->json(['message' => 'don0t kidding me ']);
        }
        $contact->delete();
        return response()->json(['message' => 'deletee']);
    }
}
