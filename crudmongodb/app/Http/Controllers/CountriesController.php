<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Country;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class CountriesController extends Controller
{
    
    public $session;

    public function __construct()
    {
        $this->session = DB::getMongoClient()->startSession();
    }

    public function getCountryImageVoid()
    {
        return response()->file('/Volumes/DATOS/Projects/laravel/crudmongodb/crudmongodb/public/imgs/flags/default.png');
    }

    public function getCountryImage($image)
    {
        $path = '/Volumes/DATOS/Projects/laravel/crudmongodb/crudmongodb/public/imgs/flags/'.$image;
        $image = Storage::disk('countries_flags')->exists($image) == true  ? $path:'/Volumes/DATOS/Projects/laravel/crudmongodb/crudmongodb/public/imgs/flags/default.png';
        return response()->file($image);  
    }

    public function index()
    {
        
        $countries = Country::limit(11)->get();
        return view('backend.countries.index',['countries' => $countries]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.countries.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->session->startTransaction();
        $lastCountryId = Country::orderBy('id', 'desc')->first()->id;
        $country = new Country();
        $country->id = $lastCountryId+1;
        $country->abbreviation = $request->abbreviation;
        $country->name = $request->name;
        $country->phone_code = $request->phone_code;
        $country->flag = 'default.png';
        $country->save();
        $this->session->commitTransaction();
        Session::flash('message','El país '.$country->name.' se ha registrado éxitosamente !');
        return redirect(url('/admin/countries'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
