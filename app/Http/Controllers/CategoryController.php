<?php
namespace App\Http\Controllers;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller{

 public function createCategory(Request $request){

     $category = Category::create($request->all());

     return response()->json($category);

 }

 public function updateCategory(Request $request, $id){

     $category  = Category::find($id);
     $category->title = $request->input('title');

     $category->save();

     return response()->json($category);
 }

 public function deleteCategory($id){
     $category  = Category::find($id);
     $category->delete();

     return response()->json('Removed successfully.');
 }

 public function index(){

     $category  = Category::all();

     return response()->json($category);

 }
}
?>
