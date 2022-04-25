<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\Builder;
use App\Http\Controllers\Post;

class CategoryController extends Controller
{

    public function index()
    {
        $search = request()->query('search');
        if($search){
            // dd(request()->query('search'));
            $categories = Category::where('name', 'LIKE', "%{$search}%")->simplePaginate();
        }
        else{
            $categories = Category::simplePaginate();
        }

        return view('shop.admin.categories.listCategories')
            // ->with('categories', Category::all())
    
            ->with('categories', $categories);

        // $categories = Category::all();

        // return view("shop.admin.categories.listCategories", [
        //     'categories' => $categories,
        // ]);

        // The above information its the same as in here
        // return view("shop.admin.categories.listCategories", compact('categories', ));
    }
 
    public function create()
    {
        return view("shop.admin.categories.formAddCategory");

    }


    public function add(Request $request)
    {
        $name = $request->name;
        $created = now();
        $updated = now();


        DB::table('categories')->insert([
            'name' => $name,
            'created_at' => $created,
            'updated_at' => $updated
        ]);
        $categories = Category::all();
        return view("shop.admin.categories.listCategories", [
            'categories' => $categories,
        ]);
    }


    public function formEdit($category){
        if(DB::table('categories')->where('id',$category)){
            $table = DB::table('categories')->where('id',$category)->get();
        }
        return view("shop.admin.categories.formEditCategory", [
            'category' => $table,
        ]);
    }

    public function edit(Request $request)
    {
        if(DB::table('categories')->where('name',$request->name)){
            
            DB::table('categories')->where('name',$request->name)->update(['name'=>$request->newName]);
            $categories = Category::all();
            return view("shop.admin.categories.listCategories", [
                'categories' => $categories,
            ]);
        }

    }

    public function delete($category)
    {
        if(DB::table('categories')->where('id',$category)){
            DB::table('categories')->where('id',$category)->delete();
            return redirect(route("categories"));
        }
        else{
            $message = "The categories has not been found";
            return $message;
        }

    }
    public function dropDown()
    {
        $categories = Category::all();

        return view("login", [
            'categories' => $categories,
        ]);
    }
}
