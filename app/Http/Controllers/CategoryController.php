<?php
/**
 * Created by PhpStorm.
 * User: DityaRa
 * Date: 13/12/2018
 * Time: 12:57
 */

namespace App\Http\Controllers;


use App\Model\Categories;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function Store(Request $request){
        $category = new Categories();
        $category->name = $request->name;
        $category->desc = $request->description;
        $category->save();
        return response()->json([
            'success' => true
        ]);

    }

    public function getAllCategories(){
        return Categories::orderBy('id','desc')->get();
    }

}