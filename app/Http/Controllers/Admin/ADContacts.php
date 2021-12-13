<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contacts;

class ADContacts extends Controller
{
    public function index(){
        $contatcs = Contacts::all();
        return view('admin.contacts.all',['contacts'=>$contatcs]);
    }
    public function delete(Request $request , $id){
        Contacts::where('id',$id)->delete();
        return redirect('/admin/contacts')->with('success','Contact has been deleted!');
    }
}
