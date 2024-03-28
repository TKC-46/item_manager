<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.admins');
    }

    public function showEdit($id)
    {
        return view("admin.edit", ['id'=> $id]);
    }

    public function showAdd()
    {
        return view("admin.add");
    }

    public function add(Request $request)
    {
        dd($request->all());
    }

}