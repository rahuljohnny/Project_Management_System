<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */

    protected function create(array $data)
    {

        /*/&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
        if($data['image']) {
            $exploded = explode(',', $data['image']);
            $decoded = base64_decode($exploded[1]);
            if (str_contains($exploded[0], 'jpeg'))
                $extension = 'jpg';
            else
                $extension = 'png';

            $fileName = str_random() . '.' . $extension;
            $path = public_path() . '/' . $fileName;
            file_put_contents($path, $decoded);
        }

        *///TODO jjjjjjjjjjjjjjjjjjjjjjjjjjjjj



        $request = (object) $data; //converted array to object
        if($data['image'])
        {
            $fileName = $data['image']->getClientOriginalName();
            $fileName = str_random() . '_' .$fileName;
            //$data['image']->storeAs('images',$fileName);

            $data['image']->move('images', $fileName);
            //$data['image'] = $fileName;
        }
        else{
            return 'No file selected!';
        }


        session()->flash( //The js is not working as I...
            'message','Product is published!!'
        );


        return User::create([

            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'image' => $fileName,

            'first_name' => $data['first_name'],
            'middle_name' => $data['middle_name'],
            'last_name' => $data['last_name'],
            'city' => $data['email'],
            'role_id' => $data['role_id'],
            'image' => $fileName

        ]);





        return redirect('/');
    }
}
