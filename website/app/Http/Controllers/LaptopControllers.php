<?php

namespace App\Http\Controllers;

use App\Models\Laptop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class LaptopControllers extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $laptopCache = Cache::remember('laptop', now()->addMinute(1), function() {
            $data = array();
            $dataDbs = Laptop::get();
            
            foreach ($dataDbs as $dataDb) {
                $data[] = array(
                    'id' => $dataDb->id,
                    'Brand' => $dataDb->Brand,
                    'Type' => $dataDb->Type,
                    'Price' => $dataDb->Price
                );
            };
            return $data;
        });
        return view ('laptop.index',compact('laptopCache'))->with('i', (request()->input('page', 1) -1) * 5);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('laptop.create');
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
            'Brand' => 'required',
            'Type' => 'required',
            'Price' => 'required',
        ]);
        Laptop::create($request->all());

        return redirect()->route('laptop.index')->with('succes','Data Berhasil di Input');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Laptop $laptop)
    {
        return view('laptop.show',compact('laptop'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Laptop $laptop)
    {
        return view('laptop.edit',compact('laptop'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Laptop $laptop)
    {
        $request->validate([
            'Brand' => 'required',
            'Type' => 'required',
            'Price' => 'required',
        ]);

        $laptop->update($request->all());

        return redirect()->route('laptop.index')->with('success','Laptop Berhasil di Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Laptop $laptop)
    {
        $laptop->delete();

        return redirect()->route('laptop.index')->with('success','Laptop Berhasil di Hapus');
    }
}
