<?php

namespace App\Http\Controllers;

use App\Models\Employees;
use App\Models\Manager;
use App\Models\Supermarket;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Reader;

class SupermarketController extends Controller
{
    public function index()
    {
        $Supermarket=Supermarket::orderBy('name', 'asc')->get();;

        return view('home', ['Supermarket' => $Supermarket]);
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

    public function addemployee()
    {
        return view('supermarket.employee');
    }

    public function destroy($id)
    {
        $StudentsModel1=Supermarket::findorfail($id);
        $StudentsModel1->delete();
        return redirect('/home');
    }


    public function importEmployees(Request $request)
    {
        $file = $request->file('csv_file');

        if ($file) {
            $filePath = $file->getRealPath();

            // Read the CSV file using a library like League/CSV
            $csv = Reader::createFromPath($filePath, 'r');
            $csv->setHeaderOffset(0);

            foreach ($csv as $row) {
                // Get the data from each row
                $employeeName = $row['name'];
                $employeeType = $row['type'];
                $managerId = $row['manager_id'];

                // Create or find the manager
                $manager = Manager::findOrCreate(['id' => $managerId], ['name' => '']);

                // Create the employee and associate it with the manager
                $employee = new Employees();
                $employee->name = $employeeName;
                $employee->type = $employeeType;
                $employee->manager()->associate($manager);
                $employee->save();
            }

            return redirect()->back()->with('success', 'Employees imported successfully.');
        }

        return redirect()->back()->with('error', 'Please provide a valid CSV file.');
    }

}
