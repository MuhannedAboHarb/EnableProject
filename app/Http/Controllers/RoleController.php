<?php

namespace App\Http\Controllers;

//use App\Models\Role;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Spatie\Permission\Models\Role;


class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = Role::all();
        return response()->view('cms.spatie.roles.index',['roles'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $guard = ['admin'=>'Admin',''=>'']; // بدل الانشاء في الفرونت برسلهم من هين 
        return response()->view('cms.spatie.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 
        $validator = Validator($request->all(),[
            'name'=> 'required|string|min:3|max:50',
            'guard'=> 'required|string|in:admin,broker', // change frontend
        ]);

        if(! $validator->fails()){
            $role =new Role();
            $role->name = $request->input('name');
            $role->guard_name = $request->input('guard');
            $isSaved = $role->save();
            return response()->json(['message'=>$isSaved ? 'Created Successfully' : 'Created Failed'
        ], $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST );
            
        }else {
            return response()->json([
                'message'=>$validator->getMessageBag()->first()
            ],Response::HTTP_BAD_REQUEST );
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        //
    }
}
