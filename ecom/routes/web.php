<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\NestedSubCategoryController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\TaxController;
use App\Http\Controllers\Admin\ModalController;
use App\Http\Controllers\Admin\Product;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductAttributeController;
use App\Http\Controllers\Admin\ProductAttributeValueController;
use App\Http\Controllers\AjaxController;

use App\Http\Controllers\Front\FrontController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

    Route::get('/',[FrontController::class,'index']);
    Route::get('admin',[AdminController::class,'index']);
    Route::post('admin/auth',[AdminController::class,'login'])->name('admin.auth');
    Route::get('admin/updatePassword',[AdminController::class,'updatePassword']);
    Route::group(['middleware'=>'admin_auth'],function(){
    
    Route::get('admin/dashboard',[AdminController::class,'dashboard']);
    
    Route::get('admin/Category',[CategoryController::class,'index']);
    Route::get('admin/Category/Manage',[CategoryController::class,'manage_category']);
    Route::post('admin/Category/Insert',[CategoryController::class,'insert'])->name('category.insert');
    Route::get('admin/Category/Delete/{id}',[CategoryController::class,'delete']);
    Route::get('admin/Category/Manage/{id}',[CategoryController::class,'manage_category']);
    Route::get('admin/Category/{status}/{id}',[CategoryController::class,'status']);

    Route::get('admin/SubCategory',[SubCategoryController::class,'index']);
    Route::get('admin/SubCategory/Manage',[SubCategoryController::class,'manage_sub_category']);
    Route::post('admin/SubCategory/Insert',[SubCategoryController::class,'insert'])->name('sub_category.insert');
    Route::get('admin/SubCategory/Delete/{id}',[SubCategoryController::class,'delete']);
    Route::get('admin/SubCategory/Manage/{id}',[SubCategoryController::class,'manage_sub_category']);
    Route::get('admin/SubCategory/{status}/{id}',[SubCategoryController::class,'status']);

    Route::get('admin/NestedSubCategory',[NestedSubCategoryController::class,'index']);
    Route::get('admin/NestedSubCategory/Manage',[NestedSubCategoryController::class,'manage_nested_sub_category']);
    Route::post('admin/NestedSubCategory/Insert',[NestedSubCategoryController::class,'insert'])->name('nested_sub_category.insert');
    Route::get('admin/NestedSubCategory/Delete/{id}',[NestedSubCategoryController::class,'delete']);
    Route::get('admin/NestedSubCategory/Manage/{id}',[NestedSubCategoryController::class,'manage_nested_sub_category']);
    Route::get('admin/NestedSubCategory/{status}/{id}',[NestedSubCategoryController::class,'status']);

    Route::get('admin/Coupon',[CouponController::class,'index']);
    Route::get('admin/Coupon/Manage',[CouponController::class,'manage_coupon']);
    Route::post('admin/Coupon/Insert',[CouponController::class,'insert'])->name('coupon.insert');
    Route::get('admin/Coupon/Delete/{id}',[CouponController::class,'delete']);
    Route::get('admin/Coupon/Manage/{id}',[CouponController::class,'manage_coupon']);
    Route::get('admin/Coupon/{status}/{id}',[CouponController::class,'status']);

    Route::get('admin/Brand',[BrandController::class,'index']);
    Route::get('admin/Brand/Manage',[BrandController::class,'manage_brand']);
    Route::post('admin/Brand/Insert',[BrandController::class,'insert'])->name('brand.insert');
    Route::get('admin/Brand/Delete/{id}',[BrandController::class,'delete']);
    Route::get('admin/Brand/Manage/{id}',[BrandController::class,'manage_brand']);
    Route::get('admin/Brand/{status}/{id}',[BrandController::class,'status']);

    Route::get('admin/Size',[SizeController::class,'index']);
    Route::get('admin/Size/Manage',[SizeController::class,'manage_size']);
    Route::post('admin/Size/Insert',[SizeController::class,'insert'])->name('size.insert');
    Route::get('admin/Size/Delete/{id}',[SizeController::class,'delete']);
    Route::get('admin/Size/Manage/{id}',[SizeController::class,'manage_size']);
    Route::get('admin/Size/{status}/{id}',[SizeController::class,'status']);

    Route::get('admin/Color',[ColorController::class,'index']);
    Route::get('admin/Color/Manage',[ColorController::class,'manage_color']);
    Route::post('admin/Color/Insert',[ColorController::class,'insert'])->name('color.insert');
    Route::get('admin/Color/Delete/{id}',[ColorController::class,'delete']);
    Route::get('admin/Color/Manage/{id}',[ColorController::class,'manage_color']);
    Route::get('admin/Color/{status}/{id}',[ColorController::class,'status']);

    Route::get('admin/Modal',[ModalController::class,'index']);
    Route::get('admin/Modal/Manage',[ModalController::class,'manage_modal']);
    Route::post('admin/Modal/Insert',[ModalController::class,'insert'])->name('modal.insert');
    Route::get('admin/Modal/Delete/{id}',[ModalController::class,'delete']);
    Route::get('admin/Modal/Manage/{id}',[ModalController::class,'manage_modal']);
    Route::get('admin/Modal/{status}/{id}',[ModalController::class,'status']);

    Route::get('admin/Tax',[TaxController::class,'index']);
    Route::get('admin/Tax/Manage',[TaxController::class,'manage_tax']);
    Route::post('admin/Tax/Insert',[TaxController::class,'insert'])->name('tax.insert');
    Route::get('admin/Tax/Delete/{id}',[TaxController::class,'delete']);
    Route::get('admin/Tax/Manage/{id}',[TaxController::class,'manage_tax']);
    Route::get('admin/Tax/{status}/{id}',[TaxController::class,'status']);

    Route::get('admin/Product',[ProductController::class,'index']);
    Route::get('admin/Product/Manage',[ProductController::class,'manage_product']);
    Route::post('admin/Product/Insert',[ProductController::class,'insert'])->name('product.insert');
    Route::get('admin/Product/Delete/{id}',[ProductController::class,'delete']);
    Route::get('admin/Product/Manage/{id}',[ProductController::class,'manage_product']);
    Route::get('admin/Product/{status}/{id}',[ProductController::class,'status']);
    
    Route::get('admin/ProductAttribute',[ProductAttributeController::class,'index']);
    Route::get('admin/ProductAttribute/Manage',[ProductAttributeController::class,'manage_product_attribute']);
    Route::post('admin/ProductAttribute/Insert',[ProductAttributeController::class,'insert'])->name('product_attribute.insert');
    Route::get('admin/ProductAttribute/Delete/{id}',[ProductAttributeController::class,'delete']);
    Route::get('admin/ProductAttribute/{id}',[ProductAttributeController::class,'index']);
    Route::get('admin/ProductAttribute/{status}/{id}',[ProductAttributeController::class,'status']);

    Route::get('admin/ProductAttributeValue/{id}',[ProductAttributeValueController::class,'index']);
    
    Route::post('admin/ProductAttributeValue/Insert',[ProductAttributeValueController::class,'insert'])->name('product_attribute_value.insert');
    Route::get('admin/ProductAttributeValue/Delete/{id}',[ProductAttributeValueController::class,'delete']); 
    
    Route::get('admin/ProductAttributeValue/{status}/{id}',[ProductAttributeValueController::class,'status']);

    Route::any('ajax/subcategory',[AjaxController::class,'subcategory'])->name('ajax.subcategory');
    Route::any('ajax/nestedsubcategory',[AjaxController::class,'Nestedsubcategory'])->name('ajax.nestedsubcategory');
    Route::any('ajax/productattribute',[AjaxController::class,'ProductAttribute'])->name('ajax.productattribute');
    Route::any('ajax/choice',[AjaxController::class,'Choice'])->name('ajax.choice');
    Route::get('admin/Logout', function () {
        session()->forget('ADMIN_LOGIN');
        session()->forget('ADMIN_ID');
        return redirect('admin');
    });
});