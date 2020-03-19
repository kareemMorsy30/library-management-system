<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('category.index',['categories'=>Category::all()]);
    }

    public function showCategory()
    {
        $categories = Category::all();
        return view('User.libraryhome',compact('categories'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        
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
            'name'=>[
                'required',
                Rule::unique('categories')->where(function($query){
                    return $query->where('deleted_at',NULL);
                }),
            ]
        ]);
        $category = new Category();
        $category->name = $request->name;
        $category->save();
        
       
         return redirect()->route('category.index');
        // return redirect()->back()->with('message','name has added successfully!');

       
    }

 

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)

    {

       
        return view('category.edit',['category_id'=>$category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {

        $validator = Validator::make($request->all(), [
            'name'=>[
                        'required',
                        Rule::unique('categories')->where(function($query){
                            return $query->where('deleted_at',NULL);
                        })->ignore($category),
        ]]);

        if ($validator->fails()) {
           return redirect()->route('category.index')
            ->withErrors($validator, 'add');
        }
        
        $category->name = $request->name;
        $category->save();
       
        return \redirect()->route('category.index');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
          
        // $category= Category::find($id);
        $category->delete();
        foreach($category->books as $book)
        {
            $book->delete();
        }
        
        return redirect()->route('category.index');
    }
}