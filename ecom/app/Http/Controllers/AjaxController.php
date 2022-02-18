<?php

namespace App\Http\Controllers;
use Response; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class AjaxController extends Controller
{
    public  function subcategory(Request $request){
        $html ="<option value=''>-Select-</option>"; 
        $data = $request->input('category');
        $result =  DB::table('sub_categories')->where('category_id',$data)->get();
        foreach($result as $sub_cat){
            $html .=   "<option value=$sub_cat->id>$sub_cat->sub_category_name</option>";
        }
        return Response::json($html);
    }

    public  function Nestedsubcategory(Request $request){
        $html ="<option value=''>-Select-</option>";
        $category = $request->input('category');
        $sub_category = $request->input('sub_category');
        $result =  DB::table('nested_sub_categories')->where(['category_id'=>$category,'sub_category_id'=>$sub_category])->get();
        foreach($result as $nested_sub_cat){
            $html .=   "<option value=$nested_sub_cat->id>$nested_sub_cat->nested_sub_category_name</option>";
        }
        return Response::json($html);
    }

    public  function ProductAttribute(Request $request){
        $attribute = $request->input('attribute');
        if(!empty($attribute)){
            $all_attr =  DB::table('product_attributes')->get();
            $result =  DB::table('product_attributes')->whereIn('id',$attribute)->get();
            $result2 =  DB::table('product_attribute_values')->get();

            $data = view('ajax',['result'=>$result,'result2'=>$result2,'all_attr'=>$all_attr])->render();
            return response()->json(['get_data'=>$data]);
        }
    }

    public  function Choice(Request $request){
        $choice = $request->input('choice');
        $price = $request->input('price');
        $mrp = $request->input('mrp');
        if(!empty($choice)){
            $data = view('admin.product.combination',['choice'=>$choice,'price'=>$price,'mrp'=>$mrp])->render();
            return response()->json(['get_choice'=>$data]);
        }
    }
}
?> 

