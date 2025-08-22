<?php
use App\Http\Controllers\BkashPaymentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductSubCategoryController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TempImagesController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ProductImageController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\DiscountCouponController;
use App\Http\Controllers\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
  return view('dashboard');
    
})->middleware(['auth', 'verified'])->name('dashboard');


//Admin All Route

Route::group(['prefix'=>'admin'],function(){
    //without Login
    Route::group(['middleware'=>'guest'],function(){

        Route::get('/login',[AdminController::class,'login'] )->name('admin.login');
        Route::get('/register',[AdminController::class,'register'] )->name('admin.register');
        Route::post('/store',[AdminController::class,'store'] )->name('admin.store');
    });

    //with Login

    Route::group(['middleware'=>'auth'],function(){

      Route::get('/dashboard',[AdminController::class,'index'] )->name('admin.index');
      Route::post('/logout',[AdminController::class,'logout'] )->name('admin.logout');
      Route::get('/change-password',[AdminController::class,'changePassword'] )->name('admin.changePassword');
      Route::post('/update-password',[AdminController::class,'updatePassword'] )->name('admin.updatePassword');
    //All Category Route

     Route::get('/category/create',[CategoryController::class,'create'] )->name('category.create');
     Route::post('/category/store',[CategoryController::class,'store'] )->name('category.store');
     Route::get('/category',[CategoryController::class,'index'] )->name('category.show');
     Route::get('/category/{id}/edit',[CategoryController::class,'edit'] )->name('category.edit');
     Route::put('/category/{id}/update',[CategoryController::class,'update'] )->name('category.update');
     Route::delete('/category/{id}/delete',[CategoryController::class,'destroy'] )->name('category.delete');
  //All SubCategory Route

     Route::get('/subcategory/create',[SubCategoryController::class,'create'] )->name('subcategory.create');
     Route::post('/subcategory/store',[SubCategoryController::class,'store'] )->name('subcategory.store');
     Route::get('/subcategory',[SubCategoryController::class,'index'] )->name('subcategory.index');
     Route::get('/subcategory/{id}/edit',[SubCategoryController::class,'edit'] )->name('subcategory.edit');
     Route::put('/subcategory/{id}/update',[SubCategoryController::class,'update'] )->name('subcategory.update');
     Route::delete('/subcategory/{id}/delete',[SubCategoryController::class,'destroy'] )->name('subcategory.delete');

    //All Brand Route

    Route::get('/brand/create',[BrandController::class,'create'] )->name('brand.create');
    Route::post('/brand/store',[BrandController::class,'store'] )->name('brand.store');
    Route::get('/brand',[BrandController::class,'show'] )->name('brand.index');
    Route::get('/brand/{id}/edit',[BrandController::class,'edit'] )->name('brand.edit');
    Route::put('/brand/{id}/update',[BrandController::class,'update'] )->name('brand.update');
    Route::delete('/brand/{id}/delete',[BrandController::class,'destroy'] )->name('brand.delete');

     //All Product Route
     Route::get('/product',[ProductController::class,'index'] )->name('product.index');
     Route::get('/product/create',[ProductController::class,'create'] )->name('product.create');
     Route::post('/product/store',[ProductController::class,'store'] )->name('product.store');
     Route::get('/product/{id}/edit',[ProductController::class,'edit'] )->name('product.edit');
     Route::put('/product/{id}/update',[ProductController::class,'update'] )->name('product.update');
     Route::delete('/product/{id}/delete',[ProductController::class,'destroy'] )->name('product.delete');
     Route::get('/get-products',[ProductController::class,'getProducts'] )->name('product.getProducts');
     Route::post('/product-images/update',[ProductImageController::class,'update'] )->name('product-images.update');
     Route::put('/product-images/delete',[ProductImageController::class,'destroy'] )->name('product-images.delete');
    //product Rating route
     Route::get('/product-ratings',[ProductController::class,'productRatings'] )->name('product.productRatings');
     Route::get('/change-ratings-status',[ProductController::class,'changeRatingStatus'] )->name('product.changeRatingStatus');

    //ProductSubController Route
      Route::post('/product/subcategories',[ProductSubCategoryController::class,'index'] )->name('productSubcategories.index');

    //tempImage route
      Route::post('/tempImage',[TempImagesController::class,'create'] )->name('temp-images.create');
      
    //All Pages Route
     Route::get('/pages',[PagesController::class,'index'] )->name('page.index');
     Route::get('/page/create',[PagesController::class,'create'] )->name('page.create');
     Route::post('/page/store',[PagesController::class,'store'] )->name('page.store');
     Route::get('/page/{id}/edit',[PagesController::class,'edit'] )->name('page.edit');
     Route::put('/page/{id}/update',[PagesController::class,'update'] )->name('page.update');
     Route::put('/page/{id}/delete',[PagesController::class,'destroy'] )->name('page.delete');
    //All User Route

     Route::get('/users',[UserController::class,'index'] )->name('user.index');
     Route::get('/user/create',[UserController::class,'create'] )->name('user.create');
     Route::post('/user/store',[UserController::class,'store'] )->name('user.store');
     Route::get('/user/{id}/edit',[UserController::class,'edit'] )->name('user.edit');
     Route::put('/user/{id}/update',[UserController::class,'update'] )->name('user.update');
     Route::delete('/user/{id}/delete',[UserController::class,'destroy'] )->name('user.delete');
   //All shipping Route
    Route::get('/shipping/create',[ShippingController::class,'create'] )->name('shipping.create');
    Route::post('/shipping/store',[ShippingController::class,'store'] )->name('shipping.store');
    Route::get('/shipping/{id}/edit',[ShippingController::class,'edit'] )->name('shipping.edit');
    Route::post('/shipping/{id}/update',[ShippingController::class,'update'] )->name('shipping.update');
    Route::delete('/shipping/{id}/delete',[ShippingController::class,'delete'] )->name('shipping.delete');

   //All Discount Route
   Route::get('/coupons',[DiscountCouponController::class,'index'] )->name('coupon.index');
   Route::get('/coupon/create',[DiscountCouponController::class,'create'] )->name('coupon.create');
   Route::post('/coupon/store',[DiscountCouponController::class,'store'] )->name('coupon.store');
   Route::get('/coupon/{id}/edit',[DiscountCouponController::class,'edit'] )->name('coupon.edit');
   Route::post('/coupon/{id}/update',[DiscountCouponController::class,'update'] )->name('coupon.update');
   Route::delete('/coupon/{id}/delete',[DiscountCouponController::class,'delete'] )->name('coupon.delete');

   //All Orders Route
   Route::get('/order-details',[OrderController::class,'index'] )->name('admin.orderDetails');
   Route::get('/order/{orderId}',[OrderController::class,'detail'] )->name('admin.order');
   Route::post('/orders-change-status/{orderId}',[OrderController::class,'changeOrderStatus'] )->name('orders.changeOrderStatus');
   Route::post('/send-order-email/{orderId}',[OrderController::class,'sendInvoiceEmail'] )->name('orders.sendInvoiceEmail');

    });

});

//All account Route

Route::group(['prefix'=>'account'],function(){

Route::group(['middleware'=>'guest'],function(){
     //Without Login
    Route::get('/register',[AuthController::class,'register'] )->name('account.register');
    Route::post('/store',[AuthController::class,'store'] )->name('account.store');
    
    Route::get('/login',[AuthController::class,'login'] )->name('account.login');
    Route::post('/login',[AuthController::class,'authenticate'] )->name('account.authenticate');
  
});

Route::group(['middleware'=>'auth'],function(){
    //With Login
      Route::get('/profile',[AuthController::class,'profile'] )->name('account.profile');
      Route::post('/profile-update',[AuthController::class,'profileUpdate'] )->name('account.profileUpdate');
      Route::post('/address-update',[AuthController::class,'addressUpdate'] )->name('account.addressUpdate');
      Route::get('/logout',[AuthController::class,'logout'] )->name('account.logout');
      Route::get('/my-orders',[AuthController::class,'orders'] )->name('account.order');
      Route::get('/order-details/{orderId}',[AuthController::class,'orderDetail'] )->name('account.orderDetail');
      Route::get('/my-wishlist',[AuthController::class,'wishlist'] )->name('account.wishlist');
      Route::post('/remove-wishlist-product',[AuthController::class,'removeWishlistProduct'] )->name('account.removeWishlistProduct');
      Route::get('/change-password',[AuthController::class,'changePassword'] )->name('account.changePassword');
      Route::post('/process/change-password',[AuthController::class,'processChangePassword'] )->name('account.processChangePassword');


});

});

//All home route
//Without Login

    Route::get('/',[HomeController::class,'index'] )->name('front.home');
    Route::get('/shop/{categorySlug?}/{subCategorySlug?}',[ShopController::class,'index'] )->name('front.shop');
    Route::get('/product/{slug}',[ShopController::class,'product'] )->name('front.product');
    Route::get('/cart',[CartController::class,'cart'] )->name('front.cart');
    Route::post('/add-to-cart',[CartController::class,'addToCart'] )->name('front.addToCart');
    Route::post('/update-cart',[CartController::class,'updateCart'] )->name('front.updateCart');
    Route::post('/delete-cart',[CartController::class,'deleteCart'] )->name('front.deleteCart');
    Route::get('/checkout',[CartController::class,'checkout'] )->name('front.checkout');
    Route::post('/processCheckout',[CartController::class,'processCheckout'] )->name('front.processCheckout');
    Route::get('/thankyou/{orderId}',[CartController::class,'thankYou'] )->name('front.thankYou');
    Route::post('/get-order-summary',[CartController::class,'getOrderSummary'] )->name('front.getOrderSummary');
    Route::post('/apply-discount',[CartController::class,'applyDiscount'] )->name('front.applyDiscount');
    Route::post('/remove-discount',[CartController::class,'removeCoupon'] )->name('front.removeDiscount');
   
    //Product Rating Route
    Route::post('/product-rating/{productId}',[ShopController::class,'productRatings'] )->name('front.productRatings');
     //Wishlist Route
    Route::post('/add-to-wishlist',[HomeController::class,'addToWishList'] )->name('front.addToWishList');

    Route::get('/page/{slug}',[HomeController::class,'page'] )->name('front.page');
    Route::get('/forgotPassword',[AuthController::class,'forgotPassword'] )->name('front.forgotPassword');
    Route::post('/forgotPassword',[AuthController::class,'processForgotPassword'] )->name('front.processForgotPassword');
    Route::get('/resetPassword/{token}',[AuthController::class,'resetPassword'] )->name('front.resetPassword');
    Route::post('/process-reset-password',[AuthController::class,'processResetPassword'] )->name('front.processResetPassword');
  
//slug route
Route::get('getSlug',function(Request $request){
    $slug="";
    if(!empty($request->title)){
        $slug=Str::slug($request->title);

    }

    return response()->json([
        'status'=>true,
        'slug'=> $slug
    ]);
})->name('getSlug');

// Payment gateway route

Route::get('/payment-gateway',[CartController::class,'paymentGateway'] )->name('payment.gateway');
Route::post('/update-aamarpay',[CartController::class,'updateAamarpay'] )->name('update.aamarpay');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
