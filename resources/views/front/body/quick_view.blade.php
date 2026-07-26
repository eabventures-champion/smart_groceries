<!-- Modal -->
<!-- Quick view -->
<style>
@media (max-width: 767px) {
   #quickViewModal .modal-dialog {
      margin: 16px auto !important;
      width: calc(100% - 32px) !important;
      max-width: calc(100% - 32px) !important;
   }
   #quickViewModal .modal-content {
      padding: 20px 15px !important;
      border-radius: 20px !important;
   }
   #quickViewModal .quickview-columns-wrap {
      display: flex !important;
      flex-direction: row !important;
      gap: 10px !important;
      margin-bottom: 15px !important;
      align-items: stretch !important;
   }
   #quickViewModal .detail-gallery.quickview {
      flex: 1 1 50% !important;
      width: 50% !important;
      height: 145px !important;
      margin-bottom: 0 !important;
      border-radius: 12px !important;
   }
   #quickViewModal .detail-gallery.quickview img {
      max-height: 115px !important;
      padding: 8px !important;
   }
   #quickViewModal .quickview-info-wrap {
      flex: 1 1 50% !important;
      width: 50% !important;
      padding: 10px 12px !important;
      border-radius: 12px !important;
      gap: 6px !important;
      font-size: 11px !important;
      justify-content: center !important;
      box-sizing: border-box !important;
   }
   #quickViewModal .quickview-info-wrap strong {
      font-size: 11px !important;
      margin-bottom: 1px !important;
   }
   #quickViewModal .quickview-info-wrap span {
      font-size: 11px !important;
      line-height: 1.2 !important;
   }
   #quickViewModal .detail-info {
      padding-left: 0 !important;
      padding-right: 0 !important;
   }
   #quickViewModal .product-price-cover {
      padding: 8px 10px !important;
      min-height: auto !important;
      border-radius: 10px !important;
   }
   #quickViewModal .product-price {
      flex-wrap: wrap !important;
      justify-content: center !important;
      gap: 4px !important;
   }
   #quickViewModal .product-price .current-price {
      font-size: 20px !important;
      white-space: nowrap !important;
   }
   #quickViewModal .product-price .old-price {
      font-size: 13px !important;
      white-space: nowrap !important;
   }
}

/* Modern Appealing Dropdown Select Styling for Quick View Modal */
#quickViewModal select.form-control {
   appearance: none !important;
   -webkit-appearance: none !important;
   -moz-appearance: none !important;
   background-color: #f8fafc !important;
   background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%23253D4E' stroke-width='2.5' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='m6 9 6 6 6-6'/%3E%3C/svg%3E") !important;
   background-repeat: no-repeat !important;
   background-position: right 14px center !important;
   background-size: 14px 14px !important;
   border: 1.5px solid #e2e8f0 !important;
   border-radius: 10px !important;
   padding: 8px 36px 8px 14px !important;
   font-family: 'Outfit', 'Inter', sans-serif !important;
   font-size: 14px !important;
   font-weight: 600 !important;
   color: #253D4E !important;
   height: 44px !important;
   width: 100% !important;
   box-sizing: border-box !important;
   box-shadow: 0 2px 5px rgba(0, 0, 0, 0.02) !important;
   transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1) !important;
   cursor: pointer !important;
}

#quickViewModal select.form-control:hover {
   background-color: #ffffff !important;
   border-color: #3bb77e !important;
   box-shadow: 0 4px 12px rgba(59, 183, 126, 0.12) !important;
}

#quickViewModal select.form-control:focus {
   background-color: #ffffff !important;
   border-color: #3bb77e !important;
   box-shadow: 0 0 0 3px rgba(59, 183, 126, 0.2) !important;
   outline: none !important;
}

#quickViewModal select.form-control option {
   font-family: 'Outfit', 'Inter', sans-serif !important;
   font-size: 14px !important;
   font-weight: 500 !important;
   color: #253D4E !important;
   background: #ffffff !important;
   padding: 10px !important;
}
</style>
<div class="modal fade custom-modal" id="quickViewModal" tabindex="-1" aria-labelledby="quickViewModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" style="max-width: 760px !important; margin: 30px auto; top: auto !important; transform: none !important;">
      <div class="modal-content" style="border-radius: 24px; padding: 30px; border: 1px solid #f1f2f4; box-shadow: 0 25px 60px rgba(0, 0, 0, 0.08); border-top: 5px solid #3bb77e; position: relative;">
         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="closeModal" style="position: absolute; right: 20px; top: 20px; z-index: 99; cursor: pointer;"></button>
         <div class="modal-body" style="padding: 0;">
            <div class="row">
               <div class="col-md-5 col-sm-12 col-xs-12">
                  <div class="quickview-columns-wrap">
                     <div class="detail-gallery quickview" style="border: 1px solid #f1f2f4; border-radius: 16px; background: #fafbfc; overflow: hidden; display: flex; align-items: center; justify-content: center; height: 260px; margin-bottom: 20px;">
                        <img src=" " alt="product image" id="pimage" style="max-height: 100%; max-width: 100%; object-fit: contain; padding: 15px;" />
                     </div>
                      {{-- properties --}}
                      <div class="quickview-info-wrap" style="font-family: 'Inter', sans-serif; font-size: 13px; color: #7e7e7e; background: #f8f9fa; padding: 16px; border-radius: 12px; border: 1px solid #f1f2f4; width: 100%; display: flex; flex-direction: column; gap: 12px; text-align: left;">
                         <div>
                            <strong style="color: #253D4E; font-weight: 800; font-size: 13px; display: block; margin-bottom: 2px;">Brand:</strong>
                            <span id="pbrand" style="color: #7e7e7e; font-weight: 500; display: block;"></span>
                         </div>
                         <div>
                            <strong style="color: #253D4E; font-weight: 800; font-size: 13px; display: block; margin-bottom: 2px;">Category:</strong>
                            <span id="pcategory" style="color: #7e7e7e; font-weight: 500; display: block;"></span>
                         </div>
                         <div>
                            <strong style="color: #253D4E; font-weight: 800; font-size: 13px; display: block; margin-bottom: 2px;">Code:</strong>
                            <span id="pcode" style="color: #7e7e7e; font-weight: 500; display: block;"></span>
                         </div>
                      </div>
                  </div>
               </div>
               
               <div class="col-md-7 col-sm-12 col-xs-12">
                  <div class="detail-info pl-20 pr-10" style="font-family: 'Outfit', sans-serif;">

                     {{-- stock availability --}}
                     <div class="mb-15">
                        <span class="badge badge-pill" id="available" style="background: rgba(46, 204, 113, 0.1); color: #2ecc71; padding: 6px 12px; font-size: 12px; font-weight: 700; border-radius: 30px; display: none;"></span>
                        <span class="badge badge-pill" id="stockout" style="background: rgba(231, 76, 60, 0.1); color: #e74c3c; padding: 6px 12px; font-size: 12px; font-weight: 700; border-radius: 30px; display: none;"></span>
                        <p class="in-stock text-brand mb-0 mt-5" id="call_us" style="font-size: 12px; font-weight: 600; color: #e74c3c;"></p>
                        <div class="total-qty-stock mt-2" style="font-size: 13px; color: #7e7e7e; font-family: 'Inter', sans-serif;">
                           Total Qty: <span id="quantity_stock" style="font-weight: 700; color: #253D4E;"></span> <span class="in-stock text-brand" id="total_stock" style="font-weight: 700;"></span>
                        </div>
                     </div>

                     {{-- product name & in-stock badge --}}
                     <div class="product-title-stock-wrap d-flex align-items-center flex-wrap gap-3 mb-15">
                        <h3 class="title-detail mb-0" style="font-size: 22px; font-weight: 800; color: #253D4E; line-height: 1.3; margin: 0;"><span id="pname"></span></h3>
                        <div id="modal-qty-stock" style="font-size: 13px; color: #e74c3c; font-weight: 600; display: inline-flex; align-items: center; margin: 0;"></div>
                     </div>

                      {{-- sizes & variants side-by-side with price --}}
                      <input type="hidden" id="product_id">
                      <div class="quickview-attributes-price-wrap" style="display: flex; gap: 15px; align-items: stretch; margin-bottom: 20px;">
                         <!-- Selectors Column (Left) -->
                         <div class="quickview-attributes-col" style="flex: 1 1 50%; display: flex; flex-direction: column; justify-content: space-between; gap: 10px;">
                            {{-- sizes --}}
                            <div id="sizeArea" style="width: 100%;">
                               <select class="form-control unicase-form-control size" id="getPrice_modal" name="size" style="border-radius: 8px; border: 1px solid #ececec; padding: 8px 12px; font-size: 14px; height: 42px; width: 100%; box-sizing: border-box;"></select>
                            </div>

                            {{-- color --}}
                            <div id="colorArea" style="width: 100%;">
                               <select class="form-control unicase-form-control" id="color" name="color" style="border-radius: 8px; border: 1px solid #ececec; padding: 8px 12px; font-size: 14px; height: 42px; width: 100%; box-sizing: border-box;">
                               </select>
                            </div>

                            {{-- quantities --}}
                             <div class="detail-qty border radius" style="border-radius: 25px; display: flex; align-items: center; justify-content: space-between; border: 1.5px solid #e2e8f0; padding: 4px 10px; background: #fff; height: 44px; width: 100%; max-width: 100%; margin: 0; box-sizing: border-box; overflow: hidden;">
                                <a href="#" class="qty-up" style="background-color: #3bb77e; color: #ffffff; width: 26px; height: 26px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; font-weight: 800; font-size: 15px; line-height: 1; text-decoration: none; box-shadow: 0 2px 4px rgba(59, 183, 126, 0.2);">+</a>
                                <input type="text" name="qty" id="qty" class="qty-val" value="1" min="1" style="width: 28px; text-align: center; border: none; font-weight: 800; color: #253D4E; margin: 0; font-size: 14px; background: transparent; padding: 0;">
                                <a href="#" class="qty-down" style="background-color: #3bb77e; color: #ffffff; width: 26px; height: 26px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; font-weight: 800; font-size: 15px; line-height: 1; text-decoration: none; box-shadow: 0 2px 4px rgba(59, 183, 126, 0.2);">-</a>
                             </div>
                         </div>

                         <!-- Price Column (Right) -->
                         <div class="quickview-price-col" style="flex: 1 1 50%; display: flex; flex-direction: column; justify-content: space-between; gap: 10px;">
                            <div class="product-price-cover" style="background: #fdfaf3; border-radius: 12px; padding: 10px 14px; border: 1px solid #f9ebd1; width: 100%; flex: 1 1 auto; display: flex; flex-direction: column; justify-content: center; align-items: center; box-sizing: border-box; margin-bottom: 0 !important;">
                               <div class="product-price primary-color d-flex align-items-center justify-content-center" style="gap: 8px; font-family: 'Inter', sans-serif; flex-wrap: wrap;">
                                  <span class="current-price text-brand" style="font-size: 22px; font-weight: 800; color: #3bb77e; white-space: nowrap;">Gh&nbsp;<span id="pprice"></span></span>
                                  <span class="old-price text-muted" style="text-decoration: line-through; font-size: 14px; font-weight: 500; display: inline-flex; white-space: nowrap;"><span id="hide_curreny">Gh</span>&nbsp;<span id="oldprice"></span></span>
                               </div>
                            </div>

                            <div class="product-extra-link2" style="margin: 0; width: 100%;">
                               <button type="submit" class="btn w-100" onclick="addToCart()" style="background-color: #3bb77e !important; border: none; color: #fff; height: 44px; padding: 0 15px; font-family: 'Outfit', sans-serif; font-weight: 700; border-radius: 25px; font-size: 14px; display: inline-flex; align-items: center; justify-content: center; gap: 8px; transition: all 0.3s ease; box-shadow: 0 8px 20px rgba(59, 183, 126, 0.25); cursor: pointer;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 12px 25px rgba(59, 183, 126, 0.35)';" onmouseout="this.style.transform='none'; this.style.boxShadow='0 8px 20px rgba(59, 183, 126, 0.25)';">
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
   </div>
</div>
