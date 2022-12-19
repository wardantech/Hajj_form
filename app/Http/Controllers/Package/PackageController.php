<?php

namespace App\Http\Controllers\package;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PackageController extends Controller
{
    public function index()
    {
        try {
            $data = Package::all();
            if (request()->ajax()) {
                return DataTables::of($data)
                    ->addColumn('action', function ($data){


                        $edit_btn= '<span class="table-actions">
                                                <a href="'.route('package.edit', $data->id).'" title="Edit"><i class="ik ik-edit-2 f-16 mr-15 text-green"></i></a>
                                            </span>';

                        $del_btn= '<span class="table-actions">
                                                <a href="'.route('package.destroy', $data->id).'" title="Delete"><i class="ik ik-trash-2 f-16 text-red"></i></a>
                                            </span>';
                        return $edit_btn.' '.$del_btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
            return view('package.index');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }


    public function create()
    {
        return view('package.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'   => 'required|string',
            'amount' => 'required'
        ]);
        try{
            $package = new Package();
            $package->name = $request->name;
            $package->amount = $request->amount;
            $package->save();
            return redirect()->route('package.index')->with('success','Package Created successfully');
        }catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {

        $package = Package::findOrFail($id);
        return view('package.edit',compact('package'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'   => 'required|string',
            'amount' => 'required'
        ]);
        try{
            $package = Package::findOrFail($id);
            $package->name = $request->name;
            $package->amount = $request->amount;
            $package->Update();
            return redirect()->route('package.index')->with('success','package updated successfully');
        }catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try{
            $package = Package::findOrFail($id)->delete();
            return redirect()->back()->with('success','package deleted successfully');
        }catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
