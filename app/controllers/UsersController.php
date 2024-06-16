<?php
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;

class UsersController extends \BaseController {

    public function index() {
        $users = User::all();
        return View::make('users.index', compact('users'));
    }
    
    public function getData() {
        $users = User::select(['id', 'name', 'email']);
        return Datatables::of($users)
            ->addColumn('actions', function ($user) {
                return '<a href="'.route('users.edit', $user->id).'">Edit</a>
                        <form action="'.route('users.destroy', $user->id).'" method="POST" style="display:inline;">
                            '.method_field('DELETE').'
                            '.csrf_field().'
                            <button type="submit">Delete</button>
                        </form>';
            })
            ->make(true);
    }
    

    public function create() {
        return View::make('users.create');
    }

    public function store() {
        $input = Input::all();
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ];
        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);

        return Redirect::route('users.index');
    }

    public function show($id) {
        $user = User::findOrFail($id);
        return View::make('users.show', compact('user'));
    }

    public function edit($id) {
        $user = User::findOrFail($id);
        return View::make('users.edit', compact('user'));
    }

    public function update($id) {
        $input = Input::all();
        $user = User::findOrFail($id);
    
        // Definición de reglas de validación
        $rules = array(
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'min:6' 
        );
    
        $messages = array(
            'password.min' => 'La contraseña debe tener al menos 6 caracteres.'
        );
    
        $validator = Validator::make($input, $rules, $messages);
    
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }
    
        $user->name = $input['name'];
        $user->email = $input['email'];
        
        if (!empty($input['password']) && strlen($input['password']) >= 6) {
            $user->password = Hash::make($input['password']);
        }
    
        $user->save();
    
        return Redirect::route('users.index');
    }
    

    public function destroy($id) {
        User::destroy($id);
        return Redirect::route('users.index');
    }
}
