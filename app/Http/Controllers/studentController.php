<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentsModel;

class studentController extends Controller
{
    public function index()
    {
        $StudentsModel=StudentsModel::all();

        return view('home', ['StudentsModel' => $StudentsModel]);
    }
    public function create()
    {


        return view('supermarket.registerstudent');
    }


    public function store()
    {   $StudentsModel= new StudentsModel();
         $StudentsModel->name=request('name');
         $StudentsModel->regno=request('regno');
         $StudentsModel->Password=request('passWord');
         $StudentsModel->save();

        return redirect('/home')->with('mssg', 'thanks for registration');
    }

    public function destroy($id)
    {
         $StudentsModel1=StudentsModel::findorfail($id);
         $StudentsModel1->delete();
         return redirect('/home');
    }
}
