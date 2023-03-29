<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index() {

        $users = User::all();

        return view('welcome')->with('users', $users);
    }

    public function register() {
        return view('register');
    }

    public function store(Request $request) {  // Store user data

      // Form validation
      $rules = [
        'salutation'    => 'required_unless:user_type,!=,student',
        'first_name'    => 'required',
        'last_name'     => 'required',
        'email'         => 'required|email',
        'profile_photo' => 'nullable|mimes:jpeg,jpg'
      ];
      
      $messages = [
        'required'  => 'The :attribute field is required.',
        'unique'    => ':attribute is already used',
        'required_unless' => 'The :attribute field is required.'
      ];
      
      $request->validate($rules,$messages);

     return back()->with('success', 'Your form has been submitted.');

    }

    public function sendSms(Request $request) {  // Store user data

        // Form validation
        $this->validate($request, [
          'sender'      => 'required',
          'receiver'    => 'different:sender',
          'message'     => 'required',
          'message_type'=> 'required'
       ]);

        $sender = User::find($request->sender);
       
        $receiver = User::find($request->receiver);
       
        if(($sender->user_type == 'student' && $receiver->user_type == 'parent') || ($sender->user_type == 'parent' && $receiver->user_type == 'student')) {
            return back()->withErrors(["message_type" => "Student and Parents Can't send message to each other."])->withInput();
        }

        if($sender->user_type == 'teacher' && $request->message_type == 'manual') {
            return back()->withErrors(["message_type" => "Message type must be System when sender teacher."])->withInput();
        }
  
        if(($sender->user_type == 'student' || $sender->user_type == 'parent') && $request->message_type == 'system') {
            return back()->withErrors(["message_type" => "Message type must be manual when user is student or parent."])->withInput();
        }

        // Table data
        $messages['sender'] = $sender->full_name;   
        $messages['sender_profile'] = $sender->profile_photo;   
        $messages['sender_type'] = $sender->user_type;   
        $messages['receiver'] = $receiver->full_name;
        $messages['receiver_profile'] = $receiver->profile_photo;   
        $messages['receiver_type'] = $receiver->user_type;   
        $messages['message'] = $request->message;
        $messages['message_type'] = $request->message_type;
        $messages['send_at'] = date('Y-m-d H:i:s');

        return back()->with('success', 'Your Message has been submitted.')->with('messages', $messages);
  
      }
}
