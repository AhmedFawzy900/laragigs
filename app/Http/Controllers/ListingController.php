<?php

namespace App\Http\Controllers;

use App\Models\Listings;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    //show all listings
    public function index(Request $request)
    {
        return view('listings.index',[
            'listings' => Listings::latest()->filter(request(['tag','search']))->paginate(4),
        ]);
    }

    // show single listing
    public function show(Listings $listing){
        return view('listings.show', [
            'listing' => $listing,
        ]);
    }

    
    // show create form
    public function create(){
        return view('listings.create');
    }

    // store new listing
    public function store(Request $request){
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required', Rule::unique('listings', 'company')],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required',
        ]);
        
        if($request->hasFile('logo')){
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }
        $formFields['user_id'] = auth()->id();

        Listings::create($formFields);

        return redirect('/')->with('message', 'Listing created successfully!');
    }


    // show edit form
    public function edit(Listings $listing){
        return view('listings.edit', ['listing' => $listing]);
    }

    // update listing data
    public function update(Request $request, Listings $listing){
        // Make sure logged in user is owner
        if($listing->user_id != auth()->id()){
            abort(403, 'Unauthorized Action');
        }

        $formFields = $request->validate([
            'title' => 'required',
            'company' => 'required',
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required',
        ]);
        
        if($request->hasFile('logo')){
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }



        $listing->update($formFields);

        return redirect('/listings/' . $listing->id)->with('message', 'Listing created successfully!');
    }

    public function destroy(Listings $listing){
        // Make sure logged in user is owner
        if($listing->user_id != auth()->id()){
            abort(403, 'Unauthorized Action');
        }
        $listing->delete();
        return redirect('/')->with('message', 'Listing deleted successfully!');
    }

    // manage listings
    // Manage Listings
    public function manage() {
        $listings = auth()->user()->listings;
        return view('listings.manage', ['listings' => $listings]);
    }
}
