<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;


class ImagenController extends Controller
{
    public function store(Request $request)
    {
        //We install intervention.io
        //Here we get the file 
        $imagen = $request->file('file');

        //uuid() generates a unique identifier so that image names are not repeated
        $nombreImagen = Str::uuid() . "." . $imagen->extension();

        //Creates an instance of the image we received
        $imagenServidor = Image::make($imagen);
        //Resizes the image
        $imagenServidor->fit(1000,1000);

       $imagenPath = public_path('uploads') . '/' . $nombreImagen;
       //Once the image was proccessed, we save the image in the uploads directory
       $imagenServidor->save($imagenPath);


        return response()->json(['imagen' => $nombreImagen ]);
    }
}
