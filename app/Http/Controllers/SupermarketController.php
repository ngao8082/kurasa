<?php

namespace App\Http\Controllers;

use App\Imports\EmployeesImport;
use App\Imports\SupplierImport;
use App\Models\Employees;
use App\Models\Manager;
use App\Models\Supplier;
use App\Models\Supermarket;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Reader;

class SupermarketController extends Controller
{
    public function index()
    {
        $manager= Manager::where('supermarket_id', '=',1)->firstOrFail();
        $supplier= Supplier::where('supermarket_id', '=',2)->firstOrFail();
        $Supermarket=Supermarket::orderBy('name', 'asc')->get();

        return view('home', ['Supermarket' => $Supermarket,'Manager'=>$manager, 'Supplier'=>$supplier]);
    }

    public function create()
    {


        return view('supermarket.create');
    }

    public function store(Request $request)
    {


        $Supermarket= new Supermarket();
        $Supermarket->name=request('name');
        $Supermarket->location=request('locationid');
        $Supermarket->save();

       return redirect('/home')->with('mssg', 'thanks for registration');
    }

    public function show($id)
    {
        $Supermarket=Supermarket::findorfail($id);
        return view('/about', ['Supermarket' => $Supermarket]);
    }
    public function edit($id)
    {
        $Supermarket=Supermarket::findorfail($id);
        return view('supermarket.edit', compact( 'Supermarket'));
    }

    public function update(Request $request, $id)
    {
        $supermarket = Supermarket::findorfail($id);
        $supermarket->name = $request->input('name');
        $supermarket->location =$request->input('locationid');
        $supermarket->update();
        return redirect('/home')->with('mssg', 'update successfully');
    }

    

    public function destroy($id)
    {
        $StudentsModel1=Supermarket::findorfail($id);
        $StudentsModel1->delete();
        return redirect('/home');
    }

    public function addemployee()
    {
        return view('supermarket.employee');
    }

    public function uploadEmployees(Request $request){

                Excel::import(new EmployeesImport, $request->file('csv_file_names'));
               return redirect()->route('home')->with('mssg', 'Uploaded successfully');


    }

    public function addsupplier()
    {
        return view('supermarket.supplier');
    }

    public function uploadSupplier(Request $request){
                        Excel::import(new SupplierImport, $request->file('csv_file_names'));
                       return redirect()->route('home')->with('mssg', 'Uploaded successfully');
        
        
    }

}
