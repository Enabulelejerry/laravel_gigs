<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    
    // All listings
    public function index(Request $request){
    //  dd(request('tag'));
        return view('listings.index',[
            'heading' => 'Latest Listings',
            'listings' => Listing::latest()->filter(request(['tag','search']))->paginate(6)
        ]);
    }
 
    // Single Listing
    public function show(Listing $listing){
        return view('listings.show',[
            'listing' => $listing
         ]);
    }

    // show create form
    public function create(){
        return view('listings.create');
    }
  
    //Store Listing Data
    
    public function store(Request $request){
     $formFields = $request->validate([
       'title' => 'required',
       'company' => ['required', Rule::unique('listings','company')],
       'location' => 'required',
       'website' => 'required',
       'email' =>  ['required','email'],
       'tags' => 'required',
       'description' => 'required'
     ]);

     if($request->hasFile('logo')){
        $formFields['logo'] = $request->file('logo')->store('logos','public');
     }

     $formFields['user_id'] =Auth::user()->id;

     Listing::create($formFields);

     return redirect('/')->with('message','Listing created successfully!');
    }

  
    //update Listing Data
    
    public function update(Request $request,Listing $listing){
      
        // Make Sure logged in user is owner
        
        if($listing->user_id != auth()->id()){
            abort(403,'Unauthorized Action');
        }

     $formFields = $request->validate([
       'title' => 'required',
       'company' => ['required'],
       'location' => 'required',
       'website' => 'required',
       'email' =>  ['required','email'],
       'tags' => 'required',
       'description' => 'required'
     ]);

     if($request->hasFile('logo')){
        $formFields['logo'] = $request->file('logo')->store('logos','public');
     }

    

     $listing->update($formFields);

     return back()->with('message','Listing updated successfully!');
    }

    // show Edit Form
    public function edit(Listing $listing){
        return view('listings.edit',['listing' =>$listing]);
    }

   
     // delete Listing

     public function destroy(Listing $listing){
        if($listing->user_id != auth()->id()){
            abort(403,'Unauthorized Action');
        }
        $listing->delete();
        return redirect('/')->with('message','Listing deleted Successfully');
     }

     public function manage(){
        return view('listings.manage',['listings' => auth()->user()->listings()->get()]);
     }
    
}
