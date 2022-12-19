<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Models\Client\Client;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            // try {
                $clients = Client::all();

                if (request()->ajax()) {
                    return DataTables::of($clients)
                        ->addColumn('action', function ($clients){
                            $show_btn= '';
                            $edit_btn= '';
                            $del_btn= '';

                                $show_btn= '<span class="table-actions">
                                                <a href="' . route('client.show', $clients->id) . '" title="Show" ><i class="ik ik-maximize-2 f-16 mr-15 text-green"></i></a>
                                            </span>';

                                $edit_btn= '<span class="table-actions">
                                                <a href="'.route('client.edit', $clients->id).'" title="Edit"><i class="ik ik-edit-2 f-16 mr-15 text-green"></i></a>
                                            </span>';

                                $del_btn= '<span class="table-actions">
                                                <a style="cursor:pointer" type="submit" onclick="showDeleteConfirm(' . $clients->id . ')" title="Delete"><i class="ik ik-trash-2 f-16 text-red"></i></a>
                                            </span>';


                            return $show_btn.' '.$edit_btn.' '.$del_btn;
                        })
                        ->rawColumns(['action'])
                        ->make(true);
                }
            // } catch (\Exception $exception) {
            //     return redirect()->back()->with('error', $exception->getMessage());
            // }
            return view('client.index');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    public function clientsServerData(){

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            return view('client.create');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required|string',
            'image'         => 'required',
            'passport'      => 'required|string',
            'phone'         => 'required|numeric|min:11||regex:/^([0-9\s\-\+\(\)]*)$/',
            'service_type'  => 'required|numeric',
            'package_id'    => 'numeric',
            'bill'          => 'string',
            'paid'          => 'required'
        ]);

        // try {
            if (request()->has('image')) {
                $imageUploaded = request()->file('image');
                $imageName = time() . '.' . $imageUploaded->getClientOriginalExtension();
                $imagePath = public_path('/upload/client/');
                $imageUploaded->move($imagePath, $imageName);
            } else {
                $imageName = null;
            }

            $data = new Client();
            $data->name         = $request->name;
            $data->image        = $imageName;
            $data->passport     = $request->passport;
            $data->phone        = $request->phone;
            $data->service_type = $request->service_type;
            $data->package_id   = $request->package_id;
            $data->bill         = $request->bill;
            $data->paid         = $request->paid;
            $data->due          = 0;//$request->due;
            $data->save();

            return redirect(route('client.client-user.index'))->with('success', 'Created successfully');
        // } catch (\Exception $exception) {
        //     return redirect()->back()->with('error', $exception->getMessage());
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $client= Client::find($id);
            return view('client.edit', compact('client'));
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
