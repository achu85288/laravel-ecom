<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->string('product_slug');
            $table->string('product_image')->default(NULL);
            $table->integer('category');
            $table->integer('sub_category')->default('0');
            $table->integer('nested_category')->default('0');
            $table->integer('brand')->default('0');
            $table->integer('model')->default('0');
            $table->text('short_desc')->default(NULL);
            $table->text('long_desc')->default(NULL);
            $table->text('keywords')->default(NULL);
            $table->text('technical_specification')->default(NULL);
            $table->text('uses')->default(NULL);
            $table->text('warranty')->default(NULL);
            $table->text('lead_time')->default(NULL);
            $table->integer('tax_id')->default('0');
            $table->integer('tax_type')->default(NULL);
            $table->integer('action')->default('0');
            $table->integer('is_refundable')->default('0');
            $table->integer('is_promo')->default('0');
            $table->integer('is_featured')->default('0');
            $table->integer('is_discount')->default('0');
            $table->integer('is_trending')->default('0');
            $table->integer('is_shipping')->default('0');
            $table->integer('status')->default('0');

            $table->text('terms')->default(NULL);
            $table->integer('reward_point')->default('0');
            $table->string('reward_expiry')->default(NULL);
            $table->string('barcode')->default(NULL);
            $table->integer('max_purchase_qty')->default('0');
            $table->string('pdf')->default(NULL);
            $table->string('meta_title')->default(NULL);
            $table->integer('shipping')->default('0');

            $table->integer('qty_warning')->default('0');
            $table->integer('stock_visibility_state')->default('0');
            $table->integer('cod')->default('0');
            $table->integer('estimate_shipping_day')->default('0');
            $table->string('external_link')->default(NULL);
            $table->string('external_link_btn')->default(NULL);
            $table->string('unit')->default('0');
            $table->string('video_link')->default(NULL);

            $table->string('thumbnail')->default(NULL);
            $table->integer('added_by')->default('0');
            $table->integer('role')->default('0');
            $table->integer('unit_price')->default('0');
            $table->integer('unit_mrp')->default('0');
            $table->string('meta_description')->default(NULL);
            $table->string('deal')->default('0');
            $table->string('label')->default(NULL);
            $table->integer('current_stock')->default('0');
             $table->integer('todays_deal')->default('0');
            $table->integer('modal')->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
