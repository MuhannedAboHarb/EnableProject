<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Dotenv\Validator;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

// use Illuminate\Http\Response;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = Category::all();
        return response()->view('cms.categories.index',['categories'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return response()->view('cms.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $validator=Valida2tor($request->all(),
        $validator=Validator($request->all(),[
            'name' => 'required|string|min:3|max:45',
            'description' => 'nullable|string|min:3|max:100',
            'status' => 'required|boolean',
        ]);
        if(! $validator->fails()){
            $category=new Category();
            $category->name =$request->input('name');
            $category->description=$request->input('description'); // هو اصلا بقبلها null حتى لو كانت 
            $category->status=$request->input('status');
            $isSaved = $category->save();
            return response()->json([
                'message'=>$isSaved ? 'Created Successfully' : 'Created Failed' 
            ],$isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST );
        }else{                          // هاتلي حقيبة الاخطاء هات اول خطأ
            return response()->json([
                'message'=>$validator->getMessageBag()->first()
        ],Response::HTTP_BAD_REQUEST); // راحت ع 400 واستقبلها في الكاش
        }
    }
 
    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
        return response()->view('cms.categories.edit',['category'=>$category]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
        $validator = Validator($request->all(), [
            'name'=> 'required|string|min:3|max:45',
            'description'=> 'nullable|string|min:3|max:100',
            'status'=> 'required|boolean'
        ]);

        if(! $validator->fails()){
            $category->name =$request->input('name');
            $category->description =$request->input('description');
            $category->status =$request->input('status');
            $isUpdated = $category ->save();
            return response()->json([
                'message'=>$isUpdated ? 'Update Successfully' : 'Update Failed' 
            ],$isUpdated ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST );
        }else{
                return response()->json(['message'=>$validator->getMessageBag()->first()
            ] , Response::HTTP_BAD_REQUEST);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
        $isDeleted = $category->delete();
         return response()->json(['icon'=>$isDeleted ? 'success' : 'error' ,
         'title'=>$isDeleted ? 'Deleted Successfully' :  'Deleted Failed'
        ] , $isDeleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }
}
 