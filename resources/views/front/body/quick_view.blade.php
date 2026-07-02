<!-- Modal -->
<!-- Quick view -->
<div class="modal fade custom-modal" id="quickViewModal" tabindex="-1" aria-labelledby="quickViewModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" style="max-width: 760px !important; margin: 30px auto; top: auto !important; transform: none !important;">
      <div class="modal-content" style="border-radius: 24px; padding: 30px; border: 1px solid #f1f2f4; box-shadow: 0 25px 60px rgba(0, 0, 0, 0.08); border-top: 5px solid #3bb77e; position: relative;">
         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="closeModal" style="position: absolute; right: 20px; top: 20px; z-index: 99; cursor: pointer;"></button>
         <div class="modal-body" style="padding: 0;">
            <div class="row">
               <div class="col-md-5 col-sm-12 col-xs-12">
                  <div class="detail-gallery quickview" style="border: 1px solid #f1f2f4; border-radius: 16px; background: #fafbfc; overflow: hidden; display: flex; align-items: center; justify-content: center; height: 260px; margin-bottom: 20px;">
                     <img src=" " alt="product image" id="pimage" style="max-height: 100%; max-width: 100%; object-fit: contain; padding: 15px;" />
                  </div>
                  {{-- properties --}}
                  <div style="font-family: 'Inter', sans-serif; font-size: 13px; color: #7e7e7e; background: #f8f9fa; padding: 12px; border-radius: 12px; border: 1px solid #f1f2f4;">
                     <div style="margin-bottom: 6px; display: flex; justify-content: space-between;">
                        <span>Brand:</span>
                        <strong class="text-dark" id="pbrand"></strong>
                     </div>
                     <div style="margin-bottom: 6px; display: flex; justify-content: space-between;">
                        <span>Category:</span>
                        <strong class="text-dark" id="pcategory"></strong>
                     </div>
                     <div style="display: flex; justify-content: space-between;">
                        <span>Code:</span>
                        <strong class="text-dark" id="pcode"></strong>
                     </div>
                  </div>
               </div>
               
               <div class="col-md-7 col-sm-12 col-xs-12">
                  <div class="detail-info pl-20 pr-10" style="font-family: 'Outfit', sans-serif;">

                     {{-- stock availability --}}
                     <div class="mb-15">
                        <span class="badge badge-pill" id="available" style="background: rgba(46, 204, 113, 0.1); color: #2ecc71; padding: 6px 12px; font-size: 12px; font-weight: 700; border-radius: 30px; display: inline-block;"></span>
                        <span class="badge badge-pill" id="stockout" style="background: rgba(231, 76, 60, 0.1); color: #e74c3c; padding: 6px 12px; font-size: 12px; font-weight: 700; border-radius: 30px; display: inline-block;"></span>
                        <p class="in-stock text-brand mb-0 mt-5" id="call_us" style="font-size: 12px; font-weight: 600; color: #e74c3c;"></p>
                        <div class="total-qty-stock mt-2" style="font-size: 13px; color: #7e7e7e; font-family: 'Inter', sans-serif;">
                           Total Qty: <span id="quantity_stock" style="font-weight: 700; color: #253D4E;"></span> <span class="in-stock text-brand" id="total_stock" style="font-weight: 700;"></span>
                        </div>
                     </div>

                     {{-- product name --}}
                     <h3 class="title-detail" style="font-size: 22px; font-weight: 800; color: #253D4E; line-height: 1.3; margin: 0 0 15px;"><span id="pname"></span></h3>

                     {{-- sizes --}}
                     <input type="hidden" id="product_id">
                     <div class="attr-detail attr-size mb-15" id="sizeArea" style="display: flex; align-items: center; gap: 15px;">
                        <strong style="width: 70px; font-size: 14px; color: #253D4E;">Size:</strong>
                        <select class="form-control unicase-form-control size" id="getPrice_modal" name="size" style="border-radius: 8px; border: 1px solid #ececec; padding: 8px 12px; font-size: 14px; height: auto; flex: 1;"></select>
                     </div>

                     {{-- color --}}
                     <div class="attr-detail attr-size mb-20" id="colorArea" style="display: flex; align-items: center; gap: 15px;">
                        <strong style="width: 70px; font-size: 14px; color: #253D4E;">Variant:</strong>
                        <select class="form-control unicase-form-control" id="color" name="color" style="border-radius: 8px; border: 1px solid #ececec; padding: 8px 12px; font-size: 14px; height: auto; flex: 1;">
                        </select>
                     </div>

                     {{-- prices --}}
                     <div class="product-price-cover mb-20" style="background: #fdfaf3; border-radius: 12px; padding: 12px 18px; border: 1px solid #f9ebd1; display: inline-block; width: 100%;">
                        <div class="product-price primary-color d-flex align-items-baseline" style="gap: 10px; font-family: 'Inter', sans-serif;">
                           <span class="current-price text-brand" style="font-size: 28px; font-weight: 800; color: #3bb77e;">Gh&nbsp;<span id="pprice"></span></span>
                           <span class="old-price text-muted" style="text-decoration: line-through; font-size: 16px; font-weight: 500; display: inline-flex;"><span id="hide_curreny">Gh</span>&nbsp;<span id="oldprice"></span></span>
                        </div>
                     </div>

                     {{-- quantities & checkout action --}}
                     <div class="detail-extralink d-flex align-items-center mb-15" style="gap: 15px;">
                        <div class="detail-qty border radius" style="border-radius: 8px; display: inline-flex; align-items: center; border: 1px solid #ececec; padding: 8px 12px; background: #fff;">
                           <a href="#" class="qty-down" style="color: #7e7e7e; display: inline-flex; font-size: 14px;"><i class="fi-rs-angle-small-down"></i></a>
                           <input type="text" name="qty" id="qty" class="qty-val" value="1" min="1" style="width: 30px; text-align: center; border: none; font-weight: 700; color: #253D4E; margin: 0 5px; font-size: 14px;">
                           <a href="#" class="qty-up" style="color: #7e7e7e; display: inline-flex; font-size: 14px;"><i class="fi-rs-angle-small-up"></i></a>
                        </div>
                     </div>
                     <div id="modal-qty-stock" style="font-size: 13px; color: #e74c3c; font-weight: 600; margin-bottom: 15px;"></div>
                     
                     <div class="product-extra-link2 mt-15">
                        <button type="submit" class="btn" onclick="addToCart()" style="background-color: #3bb77e !important; border: none; color: #fff; padding: 12px 35px; font-family: 'Outfit', sans-serif; font-weight: 700; border-radius: 30px; font-size: 15px; display: inline-flex; align-items: center; gap: 8px; transition: all 0.3s ease; box-shadow: 0 8px 20px rgba(59, 183, 126, 0.25); cursor: pointer;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 12px 25px rgba(59, 183, 126, 0.35)';" onmouseout="this.style.transform='none'; this.style.boxShadow='0 8px 20px rgba(59, 183, 126, 0.25)';">
                           <i class="fi-rs-shopping-cart"></i> Add to cart
                        </button>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
