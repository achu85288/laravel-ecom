<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller; 
use App\Models\Admin\product;
use App\Models\Admin\ProductVarient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(){
        $model = Product::all();
        return view('admin.product',['data'=>$model]);
    }
    public function manage_product($id=''){

        $data['category'] = DB::table('categories')->where('status','1')->get();
        $data['brand'] = DB::table('brands')->where('status','1')->get();
        $data['sub_category'] = DB::table('sub_categories')->where('status','1')->get();
        $data['nested_sub_category'] = DB::table('nested_sub_categories')->where('status','1')->get();
        $data['tax'] = DB::table('taxes')->where('status','1')->get();
        $data['color'] = DB::table('colors')->where('status','1')->get();
        $data['attribute'] = DB::table('product_attributes')->where('status','1')->get();
        return view('admin.manage_product',['data'=>$data]);
    }
    public function insert(Request $request){  
        $count=0;
        $request->validate([ 
            'category'=>'required',
            'image.*'=>"required|mimes:jpeg,jpg,png,webp",
            'attr_image.*'=>"required|mimes:jpeg,jpg,png,webp",
            'product_slug'=>'required|unique:products,product_slug,'.$request->input('product_id'), 
            "max_purchase_qty"=>"required",
            "unit_price"=>"required",
            "unit_mrp"=>"required",
            "current_stock"=>"required",
            "short_desc"=>"required",
            "long_desc"=>"required",
            "qty_warning"=>"required"
        ]);

        $model = new Product;

        $model->product_name = $request->input('product_name');        
        $model->product_slug = $request->input('product_slug');
        $model->category = $request->input('category');
        $model->sub_category = $request->input('sub_category')?$request->input('sub_category'):0;
        $model->nested_category = $request->input('nested_category')?$request->input('sub_category'):0;
        $model->brand = $request->input('brand')?$request->input('brand'):0;
        $model->modal = $request->input('modal')?$request->input('modal'):0;
        $model->unit = $request->input('unit')?$request->input('unit'):0;
        $model->max_purchase_qty = $request->input('max_purchase_qty')?$request->input('max_purchase_qty'):0;
        $model->barcode = $request->input('barcode')?$request->input('barcode'):0;

        $model->video_link = $request->input('video_link');
        $model->unit_price = $request->input('unit_price')?$request->input('unit_price'):0;
        $model->unit_mrp = $request->input('unit_mrp')?$request->input('unit_mrp'):0;
        $model->reward_point = $request->input('reward_point')?$request->input('reward_point'):0;
        $model->current_stock = $request->input('current_stock')?$request->input('current_stock'):0;
        $model->external_link = $request->input('external_link');
        $model->external_link_btn = $request->input('external_link_btn');

        $model->short_desc = $request->input('short_desc');
        $model->long_desc = $request->input('long_desc');
        $model->technical_specification = $request->input('technical_specification');
        $model->uses = $request->input('uses');
        $model->warranty = $request->input('warranty');
        $model->keywords = $request->input('keywords');

        $model->pdf = $request->input('pdf');
        $model->meta_title = $request->input('meta_title');
        $model->meta_description = $request->input('meta_description');
        $model->is_shipping = $request->input('is_shipping')?$request->input('is_shipping'):0;
        $model->qty_warning = $request->input('qty_warning')?$request->input('qty_warning'):0;
        $model->stock_visibility_state = $request->input('stock_visibility_state')?$request->input('stock_visibility_state'):0;

        $model->cod = $request->input('cod')?$request->input('cod'):0;
        $model->is_promo = $request->input('is_promo')?$request->input('is_promo'):0;
        $model->is_trending = $request->input('is_trending')?$request->input('is_trending'):0;
        $model->is_featured = $request->input('is_featured')?$request->input('is_featured'):0;
        $model->is_refundable = $request->input('is_refundable')?$request->input('is_refundable'):0;
        $model->todays_deal = $request->input('todays_deal')?$request->input('todays_deal'):0;

        $model->deal = $request->input('deal')?$request->input('deal'):0;
        $model->estimate_shipping_day = $request->input('estimate_shipping_day')?$request->input('estimate_shipping_day'):0;
        $model->tax_id = $request->input('tax_id')?$request->input('tax_id'):0;
        $model->tax_type = $request->input('tax_type')?$request->input('tax_type'):0;
        $model->is_discount = $request->input('is_discount')?$request->input('is_discount'):0;

        $attr_price = $request->input('attr_price');
        $attr_mrp = $request->input('attr_mrp');
        $attr_sku = $request->input('attr_sku');
        $attr_qty = $request->input('attr_qty');
        
        if($request->hasfile('thumbnail')){
            $thumbnail =$request->file('thumbnail');
            $ext = $thumbnail->extension();
            $thumbnail_name = date('YmdHis').'.'.$ext;
            $thumbnail->storeAs('/public/media/product/',$thumbnail_name);
            $model->thumbnail = $thumbnail_name;
        }
        

        $model->save();
        $product_id = 1;//$model->id;
        if($request->hasfile('product_image')){
            $product_image =$request->file('product_image');
            foreach($product_image as $product_img){
                $ext = $product_img->extension();
                $product_img_name = date('YmdHis').'.'.$ext;
                $product_img->storeAs('/public/media/product/',$product_img_name);
                
                DB::table('product_image')->insert([
                    'product_image'=>$product_img_name,
                    'product_id'=>$product_id
                ]);
            }
        }
        $is_shipping =$request->input('is_shipping');
        if($is_shipping == 1){
            $shipping_cost=$request->input('shipping_cost');
            $shipping_type=$request->input('shipping_type');
            DB::table('shipping')->insert([
                'shipping_cost'=>$shipping_cost,
                'shipping_type'=>$shipping_type,
                'product_id'=>$product_id
            ]);
        }
        $is_discount =$request->input('is_discount');
        if($is_discount == 1){
            $discount_type=$request->input('discount_type');
            $discount_value=$request->input('discount_value');
            $disc_type=$request->input('disc_type');
            if($discount_type  == 2){
                $start_dttm=$request->input('start_dttm');
                $end_dttm=$request->input('end_dttm');
            }else{
                $start_dttm='';
                $end_dttm='';
            }
            DB::table('discount')->insert([
                'discount_type'=>$discount_type,
                'discount_value'=>$discount_value,
                'disc_type'=>$disc_type,
                'product_id'=>$product_id,
                'start_dttm'=>$start_dttm,
                'end_dttm'=>$end_dttm
            ]);
        }

        $pro_attr = DB::table('product_attributes')->get();
        foreach($pro_attr as $attr){
            $clm_name =$attr->product_attribute_name;
            $clm_name = str_replace(' ','_',$clm_name);
            $clm_value[$clm_name]=  $request->input($clm_name);   
        }
              
        $varient = $request->input('color');
        if($varient !=''){
            foreach($varient as $vary){
                
                $attr_model = new ProductVarient;
                $attr_model->price = $attr_price[$count];   
                $attr_model->mrp = $attr_mrp[$count];   
                $attr_model->product_id = $product_id;   
                $attr_model->sku=$attr_sku[$count];    
                $attr_model->qty=$attr_qty[$count];           


                if($request->hasfile('attr_image')){
                    $attr_image =$request->file('attr_image');
                    //pr($attr_image);
                    $fname = $attr_image[$count]->getClientOriginalName();
                    $ext = explode('.',$fname);
                    $attr_image_name = date('YmdHis').'.'.$ext[1];
                    $attr_image[$count]->storeAs('/public/media/product/',$attr_image_name);
                    $attr_model->attr_image = $attr_image_name;
                }

                foreach($clm_value as $key => $val){
                    if($val !=''){
                        foreach($val as $value){
                            $attr_model->$key = $value;
                        }
                    } else{
                        $attr_model->$key = 0;
                    }                
                }
                $attr_model->save();
                $count++;
            }
        }
    }


    public function delete(Request $request,$id){
        $model=Product::find($id);
        $model->delete();
        $request->session()->flash('success','Data Removed.');
        return redirect('admin/Product');

    }

    public function status(Request $request , $status ,$id){
        $model = Product::find($id);
        $model->status = $status;
        $model->save();
        $request->session()->flash('success','Status Updated.');
        return redirect('admin/Product');
    }
}
