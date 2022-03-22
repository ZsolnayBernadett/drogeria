<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Perfume;

class PerfumeController extends Controller
{
    public function getPerfumes() {

        $perfumes = Perfume::all();

        return view( "/perfumes" );
    }

    public function newPerfume(Request $request) {

        if($request->isMethod("post")){

            $request->validate([
                "name" => "required",
                "type" => "required",
                "price" => "required"
            ], [
                "name.required" => "Név megadása kötelező",
                "type.required" => "Fajta megadása kötelező",
                "price.required" => "Ár megadása kötelező"
            ]);
        }

        return view( "new-perfume" );
    }

    public function storePerfume( Request $request ) {

        $perfume = new Perfume;

        $perfume->name = $request->name;
        $perfume->type = $request->type;
        $perfume->price = (int)$request->price;

        $perfume->save();

        return redirect( "/new-perfume" );
    }

    public function editPerfume( $id ) {

        $perfume = Perfume::find( $id );

        return view( "edit-perfume", [
            "perfume" => $perfume
        ]);
    }

    public function updatePerfume( Request $request ) {
        $perfume = Perfume::find($request[$id]);

        $perfume->name = $request["name"];
        $perfume->type = $request["type"];
        $perfume->price = $request["price"];

        $perfume->save();

        return redirect( "/perfumes" );
    }

    public function deletePerfume( $id ) {

        $perfume = Perfume::find( $id );
        $perfume->delete();

        return redirect( "/perfumes" );
    }
}
