<?php

namespace App\Http\Controllers\Client;

use App\Models\Package;
use Illuminate\Http\Request;
use App\Models\Client\Client;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $clients = Client::all();
            // if($request->has('phone')){
            //     $clients= Client::where('phone', 'like', "%{$request->phone}%")->get();

            // }else{
            //     $clients = Client::all();
            // }

            if (request()->ajax()) {
                return DataTables::of($clients)
                    ->addColumn('user_image', function ($clients) {
                        $result = '<img title="Icon" height="80px" width="80px" src="'.asset('upload/client').'/'.$clients->image.'" alt="Image">';
                        return $result;
                    })
                    ->addColumn('due', function ($clients){
                        $due= $clients->bill - $clients->paid;
                        return $due;
                    })
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
                    ->rawColumns(['user_image', 'due', 'action'])
                    ->make(true);
            }
            return view('client.index');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            $packages = Package::all();
            return view('client.create', compact('packages'));
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
            'image'          => 'mimes:jpeg,jpg,png,gif|required|max:10000',
            'passport'      => 'required|string',
            'phone'         => 'required|numeric|min:11||regex:/^([0-9\s\-\+\(\)]*)$/',
            'service_type'  => 'required',
            'package_id'    => 'required',
            'bill'          => 'required|numeric',
            'paid'          => 'required|numeric'
        ]);

        try {
            $data = new Client();
            $data->name         = $request->name;
            if (request()->has('image')) {
                $imageUploaded = request()->file('image');
                $imageName = time().'.'.$imageUploaded->getClientOriginalExtension();
                $imgFile = Image::make($imageUploaded->getRealPath());
                $imagePath = public_path('/upload/client/');
                $imgFile->resize(192, 192, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($imagePath.'/'.$imageName);
                // dd($imgFile);
                $imagePath = public_path('/uploads');
                // $imagePath = public_path('/upload/client/');
                $imageUploaded->move($imagePath, $imageName);
                $data->image        = $imageName;

            }
            $data->passport     = $request->passport;
            $data->phone        = $request->phone;
            $data->service_type = $request->service_type;
            $data->package_id   = $request->package_id;
            $data->bill         = $request->bill;
            $data->paid         = $request->paid;

            $data->save();

            return redirect(route('client.index'))->with('success', 'Created successfully');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $client = Client::with('packages')->find($id);
            return view('client.show', compact('client'));
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    public function showForClient($id)
    {
        try {
            $client = Client::with('packages')->find($id);
            return view('client.show_for_client', compact('client'));
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
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
            $packages = Package::all();
            $client= Client::find($id);
            return view('client.edit', compact('client', 'packages'));
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
        $request->validate([
            'name'          => 'required|string',
            'image'         => 'mimes:jpeg,jpg,png,gif|max:10000',
            'passport'      => 'required|string',
            'phone'         => 'required|numeric|min:11||regex:/^([0-9\s\-\+\(\)]*)$/',
            'service_type'  => 'required',
            'package_id'    => 'required',
            'bill'          => 'required|numeric',
            'paid'          => 'required|numeric'
        ]);

        try {
            $data = Client::find($id);
            $data->name         = $request->name;
            if (request()->has('image')) {
                $imageUploaded = request()->file('image');
                $imageName = time().'.'.$imageUploaded->getClientOriginalExtension();
                $imgFile = Image::make($imageUploaded->getRealPath());
                $imagePath = public_path('/upload/client/');
                $imgFile->resize(192, 192, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($imagePath.'/'.$imageName);
                // dd($imgFile);
                $imagePath = public_path('/uploads');
                // $imagePath = public_path('/upload/client/');
                $imageUploaded->move($imagePath, $imageName);
                $data->image        = $imageName;

            }
            $data->passport     = $request->passport;
            $data->phone        = $request->phone;
            $data->service_type = $request->service_type;
            $data->package_id   = $request->package_id;
            $data->bill         = $request->bill;
            $data->paid         = $request->paid;

            $data->save();

            return redirect(route('client.index'))->with('success', 'Updated successfully');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        if ($request->ajax()){
            try {
                $client= Client::findOrFail($id);
                // dd($client);
                $client->delete();
                return response()->json([
                    'success' => true,
                    'message' => 'Item Deleted Successfully.',
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => $e->getMessage(),
                ]);
            }
        }
    }

    public function search(Request $request){
        $clients= Client::where('phone', 'like', "%{$request->phone}%")->get();

        dd($clients);
    }

    public function PackageAmount(Request $request)
    {
        try{
            $amount = Package::where('id', $request->package_id)->get();
            return response()->json($amount);
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }
}
