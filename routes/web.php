<?php

use App\Http\Controllers\Back\DeliveryAreaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\RedirectIfAuthenticated;



// Route::get('/', function () {
//     return view('welcome');
// });

Route::namespace('App\Http\Controllers\Front')->group(function(){

    Route::controller(IndexController::class)->group(function(){

        Route::get('/', 'index');
        Route::get('product/details/{id}/{slug}', 'product_details');
        Route::post('get-product-price', 'get_product_price');
        Route::get('product/category/{id}/{slug}', 'cat_wise_product');
        Route::get('product/subcategory/{id}/{slug}', 'sub_cat_wise_product');
        Route::get('product/view/modal/{id}', 'product_view_ajax');
        Route::post('search', 'product_search')->name('product.search');
        Route::post('search-product', 'search_product');

        Route::get('about-us', 'about_us')->name('about_us');
        Route::get('privacy-policy', 'privacy_policy')->name('privacy_policy');
        Route::get('terms-conditions', 'terms_conditions')->name('terms_conditions');



        Route::get('user/confirm/{code}', 'confirm_user_account');
    });

    Route::controller(ShopController::class)->group(function(){
        Route::get('shop', 'shop_page')->name('shop.page');
        Route::post('shop/filter', 'shop_filter')->name('shop.filter');
    });

    // Route::get('/', 'IndexController@index');
    // Route::get('product/details/{id}/{slug}', 'IndexController@product_details');
    // Route::get('product/category/{id}/{slug}', 'IndexController@cat_wise_product');
    // Route::get('product/subcategory/{id}/{slug}', 'IndexController@sub_cat_wise_product');
    // Route::get('product/view/modal/{id}', 'IndexController@product_view_ajax');
    // Route::post('/search' , 'product_search')->name('product.search');

    // Route::post('cart/data/store/{id}', 'CartController@add_to_cart');
    // Route::get('product/mini/cart', 'CartController@add_mini_cart');
    // Route::get('minicart/product/remove/{rowId}', 'CartController@remove_mini_cart');
    // Route::post('details-cart/data/store/{id}', 'CartController@add_to_cart_details');

    // Route::post('coupon-apply', 'CartController@coupon_apply');
    // Route::get('coupon-calculation', 'CartController@coupon_calculation');
    // Route::get('coupon-remove', 'CartController@coupon_remove');
    // Route::get('checkout', 'CartController@checkout_create')->name('checkout');

    Route::controller(CartController::class)->group(function(){

        Route::post('coupon-apply', 'coupon_apply');
        Route::get('coupon-calculation', 'coupon_calculation');
        Route::get('coupon-remove', 'coupon_remove');
        Route::get('checkout', 'checkout_create')->name('checkout');

        Route::post('cart/data/store/{id}', 'add_to_cart');
        Route::get('product/mini/cart', 'add_mini_cart');
        Route::get('minicart/product/remove/{rowId}', 'remove_mini_cart');
        Route::post('details-cart/data/store/{id}', 'add_to_cart_details');

        Route::get('mycart', 'my_cart')->name('mycart');
        Route::get('get-cart-product', 'get_cart_product');
        Route::get('cart-remove/{rowId}', 'cart_remove');
        Route::get('cart-decrement/{rowId}', 'cart_decrement');
        Route::get('cart-increment/{rowId}', 'cart_increment');
        Route::get('cart-empty', 'cart_empty')->name('cart.empty');
    });

    Route::post('add-to-wishlist/{product_id}', 'WishListController@add_to_wish_list');
    Route::post('add-to-compare/{product_id}', 'CompareController@add_to_compare');

    // Route::get('login', 'UserController@login')->name('login');
    // Route::get('register', 'UserController@register')->name('register');
    // Route::post('user/register', 'UserController@user_register');
    // Route::post('user/login', 'UserController@user_login');

    // Route::get('user/confirm/{code}', 'UserController@confirm_user_account');

    // Route::group(['middleware'=>['auth']], function(){
    //     Route::get('dashboard', 'UserController@dashboard')->name('dashboard');
    //     Route::post('profile/update', 'UserController@user_profile_update')->name('user.profile.update');
    //     Route::post('password/update', 'UserController@user_password_update')->name('user.password.update');
    //     Route::get('logout', 'UserController@user_logout')->name('user.logout');
    // });

    // Route::match(['get', 'post'],'user-forgot-password', 'UserController@forgot_password')->name('forgot_password');

    // Route::get('page-contact', 'UserController@page_contact')->name('page_contact');

        // User All Route
    Route::middleware(['auth','role:user'])->group(function() {

        Route::controller(WishListController::class)->group(function(){
            Route::get('wishlist', 'all_wish_list')->name('wishlist');
            Route::get('get-wishlist-product', 'get_wish_list_product');
            Route::get('wishlist-remove/{id}', 'wish_list_remove');
        });

        Route::controller(CompareController::class)->group(function(){
            Route::get('compare', 'all_compare')->name('compare');
            Route::get('get-compare-product', 'get_compare_product');
            Route::get('compare-remove/{id}', 'compare_remove');
        });

        Route::controller(CheckOutController::class)->group(function(){
            Route::get('institution-get/ajax/{region_id}' , 'institution_get_ajax');
            Route::get('hall-get/ajax/{institution_id}' , 'hall_get_ajax');
            Route::post('checkout/store' , 'check_out_store')->name('checkout.store');
        });

        // Stripe All Route
        Route::controller(StripeController::class)->group(function(){
            Route::post('stripe/order', 'stripe_order')->name('stripe.order');
            // Route::post('cash/order', 'cash_order')->name('cash.order');
            Route::post('store/order', 'store_order')->name('store.order');
            Route::get('payment/callback', 'handleGatewayCallback');
        });

        // User Dashboard All Route
        Route::controller(UserController::class)->group(function(){

            Route::get('dashboard', 'dashboard')->name('dashboard');
            Route::post('profile/update', 'user_profile_update')->name('user.profile.update');
            Route::post('password/update', 'user_password_update')->name('user.password.update');
            Route::get('logout', 'user_logout')->name('user.logout');

            Route::get('user/order/page' , 'user_order_page')->name('user.order.page');
            Route::get('user/bookings', 'user_bookings')->name('user.bookings');
            Route::get('return/order/page' , 'return_order_page')->name('return.order.page');
            Route::get('user/track/order' , 'user_track_order')->name('user.track.order');
            Route::get('user/account/page' , 'user_account')->name('user.account.page');
            Route::get('user/change/password' , 'user_change_password')->name('user.change.password');

            Route::get('user/order_details/{order_id}' , 'user_order_details');
            Route::get('user/invoice_download/{order_id}' , 'user_order_invoice');
            Route::post('return/order/{order_id}' , 'return_order')->name('return.order');

            Route::post('order/tracking' , 'order_tracking')->name('order.tracking');
        });

        Route::controller(ReviewController::class)->group(function(){
            Route::post('store/review', 'store_review')->name('store.review');
        });

    }); // end group middleware

    Route::controller(FloatingFeatureController::class)->group(function() {
        Route::get('floating-panel/blogs', 'getBlogPosts');
        Route::get('floating-panel/expert-data', 'getExpertsData');
        Route::post('floating-panel/book-expert', 'bookExpert');
        Route::post('floating-panel/request-item', 'submitItemRequest');
        Route::get('floating-panel/item-requests', 'getItemRequests');
        Route::get('floating-panel/track-bookings', 'trackBookings');
        Route::get('floating-panel/affiliate-stats', 'getAffiliateStats');
        Route::post('floating-panel/affiliate-payout', 'requestAffiliatePayout');
    });

});

Route::prefix('/admin')->namespace('App\Http\Controllers\Back')->group(function(){
    Route::get('smart/login', 'AdminController@login')->middleware(RedirectIfAuthenticated::class)->name('admin.login');

    Route::middleware(['auth', 'role:admin'])->group(function () {

        Route::controller(AdminController::class)->group(function(){
            Route::get('dashboard', 'dashboard')->name('admin.dashboard');
            Route::get('profile', 'admin_profile')->name('admin.profile');
            Route::post('profile/update', 'admin_profile_update')->name('admin.profile.update');
            Route::get('change/password', 'admin_change_password')->name('admin.change.password');
            Route::post('update/password', 'admin_update_password')->name('admin.update.password');
            Route::get('logout', 'logout')->name('admin.logout');

            Route::post('mark-notification-as-read/{id}', 'mark_as_read');
            Route::post('mark-all-notification-as-read', 'mark_all_as_read');
            Route::get('delete/all/notifications', 'delete_all_notifications')->name('admin.delete.notifications');

            Route::get('all/users', 'all_admin')->name('all.admin');
            Route::get('add/user', 'add_admin')->name('add.admin');
            Route::post('store/user', 'admin_user_store')->name('admin.user.store');
            Route::get('edit/user/{id}', 'edit_admin_role')->name('edit.admin.role');
            Route::post('update/user/{id}', 'admin_user_update')->name('admin.user.update');
            Route::get('delete/user/{id}', 'delete_admin_role')->name('delete.admin.role');
        });

        Route::controller(BrandController::class)->group(function () {
            Route::get('all-brands', 'all_brands')->name('all.brands');
            Route::get('add-brand', 'add_brand')->name('add.brand');
            Route::post('store-brand', 'store_brand')->name('store.brand');
            Route::get('edit-brand/{id}', 'edit_brand')->name('edit.brand');
            Route::post('/update/brand', 'update_brand')->name('update.brand');
            Route::get('delete-brand/{id}', 'delete_brand')->name('delete.brand');
        });

        Route::controller(CategoryController::class)->group(function () {
            Route::get('all-category', 'all_categories')->name('all.categories');
            Route::get('add-category', 'add_category')->name('add.category');
            Route::post('store-category', 'store_category')->name('store.category');
            Route::get('edit-category/{id}', 'edit_category')->name('edit.category');
            Route::post('update-category', 'update_category')->name('update.category');
            Route::get('delete-category/{id}', 'delete_category')->name('delete.category');
        });

        Route::controller(SubCategoryController::class)->group(function () {
            Route::get('all-subcategory', 'all_subcategories')->name('all.subcategories');
            Route::get('add-subcategory', 'add_subcategory')->name('add.subcategory');
            Route::post('store-subcategory', 'store_subcategory')->name('store.subcategory');
            Route::get('edit-subcategory/{id}', 'edit_subcategory')->name('edit.subcategory');
            Route::post('update-subcategory', 'update_subcategory')->name('update.subcategory');
            Route::get('delete-subcategory/{id}', 'delete_subcategory')->name('delete.subcategory');
            Route::get('subcategory/ajax/{category_id}', 'get_sub_category');
        });

        Route::controller(ProductController::class)->group(function(){
            Route::get('all-products', 'all_products')->name('all.products');
            Route::get('add-product', 'add_product')->name('add.product');
            Route::post('store-product', 'store_product')->name('store.product');
            Route::get('edit-product/{id}', 'edit_product')->name('edit.product');
            Route::post('update-product', 'update_product')->name('update.product');
            Route::post('/update-product/thumbnail', 'update_product_thumbnail')->name('update.product.thumbnail');
            Route::post('update-product/multi-image', 'update_multi_image')->name('update.product.multi_image');
            Route::get('delete-product/multi-img/{id}', 'delete_multi_image')->name('delete.multi_image');
            Route::post('store-product/new-multi-image', 'store_new_multi_image')->name('store.new.multi_image');
            Route::get('product-inactive/{id}', 'product_inactive')->name('product.inactive');
            Route::get('product-active/{id}', 'product_active')->name('product.active');
            Route::get('delete-product/{id}', 'delete_product')->name('delete.product');

            // For Product Attributes
            Route::match(['get','post'], 'add-edit-attributes/{id}', 'add_edit_attributes')->name('add.product.attribute');
            Route::get('product-attribute-inactive/{id}', 'product_attribute_inactive')->name('product.attribute.inactive');
            Route::get('product-attribute-active/{id}', 'product_attribute_active')->name('product.attribute.active');
            Route::get('delete-product-attribute/{id}', 'delete_product_attribute')->name('delete.product.attribute');
            Route::post('edit-attribute/{id}', 'edit_attritube');
            // Route::post('update-attribute-status', 'update_attribute_status');

            // For Product Stock
            Route::get('product/stock', 'product_stock')->name('product.stock');

            // For Product Image Download
            Route::get('download-product-image/{id}', 'download_product_image')->name('download.product.image');
            Route::get('download-all-product-images', 'download_all_product_images')->name('download.all.product.images');

            // For Product Image Bulk Upload
            Route::get('bulk-upload-images', 'bulk_upload_images')->name('bulk.upload.images');
            Route::post('store-bulk-upload-images', 'store_bulk_upload_images')->name('store.bulk.upload.images');
        });

        Route::controller(SliderController::class)->group(function () {
            Route::get('all-slider', 'all_slider')->name('all.slider');
            Route::get('add-slider', 'add_slider')->name('add.slider');
            Route::post('store-slider', 'store_slider')->name('store.slider');
            Route::get('edit-slider/{id}', 'edit_slider')->name('edit.slider');
            Route::post('update-slider', 'update_slider')->name('update.slider');
            Route::get('delete-slider/{id}', 'delete_slider')->name('delete.slider');
        });

        Route::controller(BannerController::class)->group(function(){
            Route::get('all-banner', 'all_banner')->name('all.banner');
            Route::get('add-banner', 'add_banner')->name('add.banner');
            Route::post('store-banner', 'store_banner')->name('store.banner');
            Route::get('edit-banner/{id}', 'edit_banner')->name('edit.banner');
            Route::post('update-banner', 'update_banner')->name('update.banner');
            Route::get('delete-banner/{id}', 'delete_banner')->name('delete.banner');
        });

        Route::controller(CouponController::class)->group(function(){
            Route::get('all-coupon', 'all_coupon')->name('all.coupon');
            Route::get('add-coupon', 'add_coupon')->name('add.coupon');
            Route::post('store-coupon', 'store_coupon')->name('store.coupon');
            Route::get('edit-coupon/{id}', 'edit_coupon')->name('edit.coupon');
            Route::post('update-coupon', 'update_coupon')->name('update.coupon');
            Route::get('delete-coupon/{id}', 'delete_coupon')->name('delete.coupon');
        });

        Route::controller(DeliveryAreaController::class)->group(function(){
            Route::get('regions', 'all_region')->name('all.regions');
            Route::get('add-region', 'add_region')->name('add.region');
            Route::post('store-region', 'store_region')->name('store.region');
            Route::get('edit-region/{id}', 'edit_region')->name('edit.region');
            Route::post('update-region', 'update_region')->name('update.region');
            Route::get('delete-region/{id}', 'delete_region')->name('delete.region');
        });

        Route::controller(DeliveryAreaController::class)->group(function(){
            Route::get('institutions', 'all_institutions')->name('all.institutions');
            Route::get('add-institution', 'add_institution')->name('add.institution');
            Route::post('store-institution', 'store_institution')->name('store.institution');
            Route::get('edit-institution/{id}', 'edit_institution')->name('edit.institution');
            Route::post('update-institution', 'update_institution')->name('update.institution');
            Route::get('delete-institution/{id}', 'delete_institution')->name('delete.institution');
        });

        Route::controller(DeliveryAreaController::class)->group(function(){
            Route::get('halls', 'all_halls')->name('all.halls');
            Route::get('add-hall', 'add_hall')->name('add.hall');
            Route::post('store-hall', 'store_hall')->name('store.hall');
            Route::get('edit-hall/{id}', 'edit_hall')->name('edit.hall');
            Route::post('update-hall', 'update_hall')->name('update.hall');
            Route::get('delete-hall/{id}', 'delete_hall')->name('delete.hall');
            Route::get('institution/ajax/{region_id}', 'get_institution');
        });

        Route::controller(OrderController::class)->group(function(){
            Route::get('pending/order' , 'pending_order')->name('pending.order');
            Route::get('order/details/{order_id}' , 'admin_order_details')->name('admin.order.details');
            Route::get('confirmed/order' , 'admin_confirmed_order')->name('admin.confirmed.order');
            Route::get('processing/order' , 'admin_processing_order')->name('admin.processing.order');
            Route::get('admin/delivered/order' , 'admin_delivered_order')->name('admin.delivered.order');
            Route::get('pending/confirm/{order_id}' , 'pending_to_confirm')->name('pending-confirm');
            Route::get('confirm/processing/{order_id}' , 'confirm_to_process')->name('confirm-processing');
            Route::get('processing/delivered/{order_id}' , 'process_to_deliver')->name('processing-delivered');
            Route::get('invoice/download/{order_id}' , 'admin_invoice_download')->name('admin.invoice.download');
        });

        Route::controller(ReturnController::class)->group(function(){
            Route::get('return/request' , 'return_request')->name('return.request');
            Route::get('return/request/approved/{order_id}' , 'return_request_approved')->name('return.request.approved');
            Route::get('complete/return/request' , 'complete_return_request')->name('complete.return.request');

            Route::get('return/request/unapproved/{order_id}' , 'return_request_unapproved')->name('return.request.unapproved');
            Route::get('uncomplete/return/request' , 'uncomplete_return_request')->name('uncomplete.return.request');
        });

        Route::controller(ReportController::class)->group(function(){
            Route::get('report/view' , 'report_view')->name('report.view');
            Route::post('search/by/date' , 'search_by_date')->name('search-by-date');
            Route::post('search/by/month' , 'search_by_month')->name('search-by-month');
            Route::post('search/by/year' , 'search_by_year')->name('search-by-year');
            Route::get('order/by/user' , 'order_by_user')->name('order.by.user');
            Route::post('search/by/user' , 'search_by_user')->name('search-by-user');
        });

        Route::controller(ActiveUserController::class)->group(function(){
            Route::get('/all/clients' , 'all_user')->name('all.users');
            Route::get('/client/detail/{id}', 'client_detail')->name('admin.client.detail');
            // Route::get('/all/vendor' , 'all_vendor')->name('all-vendor');
        });

        Route::controller(ReviewController::class)->group(function(){
            Route::get('pending/review' , 'pending_review')->name('pending.review');
            Route::get('review/approve/{id}' , 'review_approve')->name('review.approve');
            Route::get('publish/review' , 'publish_review')->name('publish.review');
            Route::get('review/delete/{id}' , 'review_delete')->name('review.delete');
        });

        Route::controller(SiteSettingController::class)->group(function(){
            Route::get('site/setting' , 'site_setting')->name('site.setting');
            Route::post('site/setting/update' , 'site_setting_update')->name('site.setting.update');
            Route::get('seo/setting' , 'seo_setting')->name('seo.setting');
            Route::post('seo/setting/update', 'seo_setting_update')->name('seo.setting.update');
       });

        Route::controller(RoleController::class)->group(function(){
            Route::get('all/permission', 'all_permission')->name('all.permission');
            Route::get('add/permission', 'add_permission')->name('add.permission');
            Route::post('store/permission', 'store_permission')->name('store.permission');
            Route::get('edit/permission/{id}' , 'edit_permission')->name('edit.permission');
            Route::post('update/permission', 'update_permission')->name('update.permission');
            Route::get('delete/permission/{id}', 'delete_permission')->name('delete.permission');

            Route::get('all/roles', 'all_roles')->name('all.roles');
            Route::get('add/roles', 'add_roles')->name('add.roles');
            Route::post('store/roles', 'store_roles')->name('store.roles');
            Route::get('edit/roles/{id}', 'edit_roles')->name('edit.roles');
            Route::post('update/roles', 'update_roles')->name('update.roles');
            Route::get('delete/roles/{id}' , 'delete_roles')->name('delete.roles');

            Route::get('add/roles/permission', 'add_roles_permission')->name('add.roles.permission');
            Route::post('store/role/permission', 'role_permisssion_store')->name('role.permission.store');
            Route::get('all/roles/permission', 'all_roles_permission')->name('all.roles.permission');
            Route::get('edit/roles/permission/{id}', 'admin_roles_edit')->name('admin.edit.roles.permission');
            Route::post('update/roles/permission/{id}', 'admin_roles_update')->name('admin.roles.permission.update');
            Route::get('delete/roles/permission/{id}', 'admin_roles_delete')->name('admin.delete.roles.permission');
        });

        Route::controller(ExpertManagementController::class)->group(function () {
            // Categories
            Route::get('lifestyle/categories', 'categoriesList')->name('admin.lifestyle.categories');
            Route::get('lifestyle/categories/add', 'categoryAdd')->name('admin.lifestyle.categories.add');
            Route::post('lifestyle/categories/store', 'categoryStore')->name('admin.lifestyle.categories.store');
            Route::get('lifestyle/categories/edit/{id}', 'categoryEdit')->name('admin.lifestyle.categories.edit');
            Route::post('lifestyle/categories/update', 'categoryUpdate')->name('admin.lifestyle.categories.update');
            Route::get('lifestyle/categories/delete/{id}', 'categoryDelete')->name('admin.lifestyle.categories.delete');
            
            // Experts
            Route::get('lifestyle/experts', 'expertsList')->name('admin.lifestyle.experts');
            Route::get('lifestyle/experts/add', 'expertAdd')->name('admin.lifestyle.experts.add');
            Route::post('lifestyle/experts/store', 'expertStore')->name('admin.lifestyle.experts.store');
            Route::get('lifestyle/experts/edit/{id}', 'expertEdit')->name('admin.lifestyle.experts.edit');
            Route::post('lifestyle/experts/update', 'expertUpdate')->name('admin.lifestyle.experts.update');
            Route::get('lifestyle/experts/delete/{id}', 'expertDelete')->name('admin.lifestyle.experts.delete');

            // Health Tips
            Route::get('lifestyle/tips', 'tipsList')->name('admin.lifestyle.tips');
            Route::get('lifestyle/tips/add', 'tipAdd')->name('admin.lifestyle.tips.add');
            Route::post('lifestyle/tips/store', 'tipStore')->name('admin.lifestyle.tips.store');
            Route::get('lifestyle/tips/edit/{id}', 'tipEdit')->name('admin.lifestyle.tips.edit');
            Route::post('lifestyle/tips/update', 'tipUpdate')->name('admin.lifestyle.tips.update');
            Route::get('lifestyle/tips/delete/{id}', 'tipDelete')->name('admin.lifestyle.tips.delete');

            // Bookings
            Route::get('lifestyle/bookings', 'bookingsList')->name('admin.lifestyle.bookings');
            Route::post('lifestyle/bookings/status', 'bookingUpdateStatus')->name('admin.lifestyle.bookings.status');

            // Custom Item Requests
            Route::get('lifestyle/requests', 'itemRequestsList')->name('admin.lifestyle.requests');
            Route::post('lifestyle/requests/respond', 'itemRequestRespond')->name('admin.lifestyle.requests.respond');

            // Blog Posts
            Route::get('lifestyle/blogs', 'blogsList')->name('admin.lifestyle.blogs');
            Route::get('lifestyle/blogs/add', 'blogAdd')->name('admin.lifestyle.blogs.add');
            Route::post('lifestyle/blogs/store', 'blogStore')->name('admin.lifestyle.blogs.store');
            Route::get('lifestyle/blogs/edit/{id}', 'blogEdit')->name('admin.lifestyle.blogs.edit');
            Route::post('lifestyle/blogs/update', 'blogUpdate')->name('admin.lifestyle.blogs.update');
            Route::get('lifestyle/blogs/delete/{id}', 'blogDelete')->name('admin.lifestyle.blogs.delete');

            // Blog Categories
            Route::get('lifestyle/blog-categories', 'blogCategoriesList')->name('admin.lifestyle.blog_categories');
            Route::get('lifestyle/blog-categories/add', 'blogCategoryAdd')->name('admin.lifestyle.blog_categories.add');
            Route::post('lifestyle/blog-categories/store', 'blogCategoryStore')->name('admin.lifestyle.blog_categories.store');
            Route::get('lifestyle/blog-categories/edit/{id}', 'blogCategoryEdit')->name('admin.lifestyle.blog_categories.edit');
            Route::post('lifestyle/blog-categories/update', 'blogCategoryUpdate')->name('admin.lifestyle.blog_categories.update');
            Route::get('lifestyle/blog-categories/delete/{id}', 'blogCategoryDelete')->name('admin.lifestyle.blog_categories.delete');
        });

    });


});

Route::prefix('/expert')->namespace('App\Http\Controllers\Back')->group(function(){
    Route::middleware(['auth', 'role:expert'])->group(function () {
        Route::controller(ExpertDashboardController::class)->group(function(){
            Route::get('dashboard', 'dashboard')->name('expert.dashboard');
            Route::post('profile/update', 'updateProfile')->name('expert.profile.update');
            Route::get('bookings', 'bookings')->name('expert.bookings');
            Route::post('bookings/status', 'updateBookingStatus')->name('expert.bookings.status');
            Route::get('availability', 'availability')->name('expert.availability');
            Route::post('availability/update', 'updateAvailability')->name('expert.availability.update');
            Route::get('logout', 'logout')->name('expert.logout');
        });
    });
});

require __DIR__.'/auth.php';

if (config('app.env') === 'local') {
    Route::get('back/assets/images/{any}', function ($any) {
        return redirect('https://smartgroceries.org/back/assets/images/' . $any);
    })->where('any', '.*');

    Route::get('front/assets/imgs/{any}', function ($any) {
        return redirect('https://smartgroceries.org/front/assets/imgs/' . $any);
    })->where('any', '.*');
}

Route::get('/sync-assets-hostinger', function() {
    if (request('key') !== 'groceries_sync_2026') {
        return response('Unauthorized', 403);
    }

    $src = base_path('public');
    $dst = base_path('../public_html');

    if (!file_exists($dst)) {
        return "Error: Destination public_html directory not found at: " . $dst;
    }

    $syncCount = 0;
    $copyDirectory = function($src, $dst) use (&$copyDirectory, &$syncCount) {
        $dir = opendir($src);
        if (!$dir) return;
        @mkdir($dst, 0755, true);
        while (false !== ($file = readdir($dir))) {
            if ($file !== '.' && $file !== '..') {
                $srcFile = $src . '/' . $file;
                $dstFile = $dst . '/' . $file;
                if (is_dir($srcFile)) {
                    $copyDirectory($srcFile, $dstFile);
                } else {
                    if (copy($srcFile, $dstFile)) {
                        $syncCount++;
                    }
                }
            }
        }
        closedir($dir);
    };

    $copyDirectory($src, $dst);
    return "Sync completed! Copied " . $syncCount . " files to public_html.";
});


