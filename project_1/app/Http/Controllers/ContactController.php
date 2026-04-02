<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;
use RealRashid\SweetAlert\Facades\Alert;
class ContactController extends Controller
{

    public function display_contacts()
    {
       $contacts = Contact::all();
       return response()->json([
        'status' => 1,
        'message' => 'Contacts Displayed Successfully!',
        'data' => $contacts,
       ]);
    }

    public function index()
    {
        $contacts = Contact::all();
        return view('admin.manage_contact',compact('contacts'));
    }
 
   // Contact Form Page
    public function create()
    {
        return view('website.contact'); 
    }

    public function manage_contact()
    {
        $contacts = Contact::paginate(10);
        return view('admin.manage_contact',compact('contacts'));
    }

    // Form Submit
     public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email',
            'comment' => 'required|min:10',
        ]);

        // Save in database
        $table = new Contact();
        $table->name = $request->name;
        $table->email = $request->email;
        $table->comment = $request->comment;
        $table->save();
        Alert::success('Success', 'Message Sent Successfully');
        return redirect('/contact');
        return response()->json([
            'status' => 1,
            'message' => 'Contact Inserted Successfully!',
            'data' => $table,
        ]);
        Mail::to($email)->send(new ContactMail());
    }
    

    public function destroy($id)
    {
        $contact = Contact::find($id);
        $contact->delete();
        Alert::success('Success', 'Message Deleted Successfully');
        return back();
    }
}
