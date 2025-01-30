<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use App\Models\User;
use Illuminate\Http\Request;

class PartnersController extends Controller
{

    public function testRegister()
    {
        $user = new User();
        $user->name = 'Nombre de prueba';
        $user->email = 'emailprueba3@gmail.com';
        $user->save();
        $partner = new Partner();
        $partner->first_name = 'Nombre de prueba';
        $partner->last_name = 'Apellido de prueba';
        $partner->save();
        echo 'Registro exitoso';
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
