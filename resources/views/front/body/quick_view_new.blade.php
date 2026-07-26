<!-- Modal -->
<!-- Quick view -->
<div class="modal fade custom-modal" id="quickViewModal" tabindex="-1" aria-labelledby="quickViewModalLabel" aria-hidden="true">
    <div class="modal-dialog">
       <div class="modal-content">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="closeModal"></button>
          <div class="modal-body">
             <div class="row">
                <div class="col-md-6 col-sm-12 col-xs-12 mb-md-0 mb-sm-5">
                   <div class="detail-gallery quickview">
                      {{-- <span class="zoom-icon"><i class="fi-rs-search"></i></span> --}}
                      <img src=" " alt="product image" id="pimage" />                 
                   </div>
                   <!-- End Gallery -->
                </div>
                <div class="col-md-6 col-sm-12 col-xs-12">
                    <div class="detail-info pr-30 pl-30">
                   <h5 class="title-detail"><a href="" class="text-heading" id="pname"> </a></h5>
                   <br>
                   <div class="attr-detail attr-size mb-10" id="sizeArea">
                      <strong class="mr-10" style="width:60px;">Size : </strong>
                      <select class="form-control unicase-form-control" id="size" name="size">
                      </select>
                   </div>
                   <div class="attr-detail attr-size mb-10" id="colorArea">                     
                      <strong class="mr-10" style="width:60px;">Color : </strong>
                      <select class="form-control unicase-form-control" id="color" name="color">
                      </select>
                   </div>
                   <div class="clearfix product-price-cover">
                      <div class="product-price primary-color float-left">
                         <span class="current-price text-brand">Gh&nbsp;</span>
                         <span class="current-price text-brand" id="pprice"></span>
 
                         <span class="old-price font-md ml-15" id="hide_curreny">Gh&nbsp;</span>
                         <span class="old-price font-md ml-15" id="oldprice"></span>
                         
                      </div>
                   </div>
                   <div class="detail-extralink mb-10">
                       <div class="detail-qty border radius" style="border-radius: 20px; display: inline-flex; align-items: center; justify-content: space-between; border: 1px solid #e2e8f0; padding: 4px 8px; background: #fff; height: 44px; min-width: 110px; box-sizing: border-box;">
                           <a href="#" class="qty-up" style="background-color: #3bb77e; color: #ffffff; width: 28px; height: 28px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; font-weight: 800; font-size: 16px; line-height: 1; text-decoration: none; box-shadow: 0 2px 4px rgba(59, 183, 126, 0.25);">+</a>
                           <input type="text" name="qty" id="qty" class="qty-val" value="1" min="1" style="width: 32px; text-align: center; border: none; font-weight: 800; color: #253D4E; margin: 0; font-size: 15px; background: transparent;">
                           <a href="#" class="qty-down" style="background-color: #3bb77e; color: #ffffff; width: 28px; height: 28px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; font-weight: 800; font-size: 16px; line-height: 1; text-decoration: none; box-shadow: 0 2px 4px rgba(59, 183, 126, 0.25);">-</a>
                       </div>
                      <div class="product-extra-link2">
                         <input type="hidden" id="product_id">
                         <button type="submit" class="button button-add-to-cart" onclick="addToCart()"><i class="fi-rs-shopping-cart"></i></button>                     
                      </div>
                   </div>
                   <div class="row d-none d-lg-block">
                      <div class="col-md-6">
                         <div class="font-xs">
                            <ul>
                               <li class="mb-5">Brand: <span class="text-brand" id="pbrand"> </span></li>
                               <li class="mb-5">Category: <span class="text-brand" id="pcategory"> </span></li>
                               {{-- <li class="mb-5">Vendor:<span class="text-brand" id="pvendor_id"> </span></li> --}}
                            </ul>
                         </div>
                      </div>
                      <!-- // End col  -->
                      <div class="col-md-6">
                         <div class="font-xs">
                            <ul>
                               <li class="mb-5">Product Code : <span class="text-brand" id="pcode"> </span></li>
                               {{-- <li class="mb-5">Stock: 
                                  <span class="badge badge-pill badge-success" id="available" style="background:green; color: white;"> </span>
                                  <span class="badge badge-pill badge-danger" id="stockout" style="background:red; color: white;"> </span>
                               </li> --}}
                            </ul>
                         </div>
                      </div>
                      <!-- // End col  -->
                   </div>
                   <!-- // end row -->
                    </div>
                </div>
                <!-- Detail Info -->
             </div>
          </div>
       </div>
    </div>
 </div>


