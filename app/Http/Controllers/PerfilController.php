<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        return view('perfil.index');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'username' => ['required', 'string', 'alpha_dash', 'unique:users,username,'.auth()->user()->id,'min:3', 'max:20', 'not_in:twitter,facebook,google'],
            'email' => 'required|email|unique:users,imagen,'.auth()->user()->id
        ]);

        if ($request->imagen) {
            //We install intervention.io
        //Here we get the file 
        $imagen = $request->file('imagen');

        //uuid() generates a unique identifier so that image names are not repeated
        $nombreImagen = Str::uuid() . "." . $imagen->extension();

        //Creates an instance of the image we received
        $imagenServidor = Image::make($imagen);
        //Resizes the image
        $imagenServidor->fit(1000,1000);

       $imagenPath = public_path('perfiles') . '/' . $nombreImagen;
       //Once the image was proccessed, we save the image in the uploads directory
       $imagenServidor->save($imagenPath);
        }

        //Save changes
        $usuario = User::find(auth()->user()->id);

        $usuario->username = Str::lower($request->username);
        $usuario->email = $request->email ?? auth()->user()->email;
        $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ?? null;

        if($request->oldpassword || $request->password) {
            $this->validate($request, [
                'oldpassword' => 'required|min:6',
                'password' => 'required|confirmed|min:6'
            ]);
 
            if (Hash::check($request->oldpassword, auth()->user()->password)) {
                $usuario->password = Hash::make($request->password) ?? auth()->user()->password;
                $usuario->save();
            } else {
                return back()->with('mensaje', 'The password you typed does not match with your current password.');
            }
        }

        $usuario->save();

        return redirect()->route('posts.index', $usuario->username);

    }
}
