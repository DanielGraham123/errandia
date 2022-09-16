<div class="modal modal-primary" id="customSearchModal" tabindex="-1" role="dialog"
     aria-labelledby="customSearchModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg animated zoomIn animated-3x" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="customSearchModalLabel">Request Custom Product Quote</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="" method="POST" action="{{route('send_product_quote')}}"
                  enctype="multipart/form-data">
                <div class="modal-body">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-6 col-sm-3  mb-2">
                            <div for="photo-1" class="d-flex border radius-15  w-100 select-photo">
                                <div class="rounded-lg"><img id="preview-1" height="100%" width="100%"
                                                             class="d-none" src=""></div>
                                <label for="photo-1"
                                       class="w-100 h-100 d-flex-column align-items-center justify-content-center text-center  font-20">
                                    <span class="text-center font-20">+</span> </label>
                                <input onchange="previewProduct(this,'preview-1')" name="preview-1"
                                       class="d-none" id="photo-1" type="file">
                            </div>
                        </div>
                        <div class="col-6 col-sm-3  mb-2">
                            <div for="photo-2" class="d-flex border radius-15  w-100 select-photo">
                                <div class="rounded-lg"><img id="preview-2" height="100%" width="100%"
                                                             class="d-none" src=""></div>
                                <label for="photo-2"
                                       class="w-100 h-100 d-flex-column align-items-center justify-content-center text-center  font-20">
                                    <span class="text-center font-20">+</span> </label>
                                <input onchange="previewProduct(this,'preview-2')" name="preview-2"
                                       class="d-none"
                                       id="photo-2" type="file">
                            </div>
                        </div>
                        <div class="col-6 col-sm-3  mb-2">
                            <div for="photo-3" class="d-flex border radius-15  w-100 select-photo">
                                <div class="rounded-lg"><img class="d-none" height="100%" width="100%"
                                                             id="preview-3" src=""></div>
                                <label for="photo-3"
                                       class="w-100 h-100 d-flex-column align-items-center justify-content-center text-center  font-20">
                                    <span class="text-center font-20">+</span> </label>
                                <input onchange="previewProduct(this,'preview-3')" name="preview-3"
                                       class="d-none"
                                       id="photo-3" type="file">
                            </div>
                        </div>
                        <div class="col-6 col-sm-3  mb-2">
                            <div for="photo-4" class="d-flex border radius-15  w-100 select-photo">
                                <div class="rounded-lg"><img class="d-none" height="100%" width="100%"
                                                             id="preview-4" src=""></div>
                                <label for="photo-4"
                                       class="w-100 h-100 d-flex-column align-items-center justify-content-center text-center  font-20">
                                    <span class="text-center font-20">+</span> </label>
                                <input onchange="previewProduct(this,'preview-4')" name="preview-4"
                                       class="d-none"
                                       id="photo-4" type="file">
                            </div>
                        </div>

                        <input id="counter" type="hidden" name="counter" value="0"/>
                    </div>
                    <div class="form-group">
                        <input maxlength="150" type="text" class="form-control mb-2" name="Title" required
                               placeholder="Title"/>
                    </div>
{{--                    <div class="form-group">--}}
{{--                        <input type="text" class="form-control  mb-2" name="PhoneNumber" maxlength="9" required--}}
{{--                               placeholder="Phone Number"/>--}}
{{--                    </div>--}}
{{--                    <div class="form-group">--}}
{{--                        <select class="form-control mb-2" onchange="getSubCategoriesByCategory(this)"--}}
{{--                                name="dialog_category"--}}
{{--                                id="dialog_category">--}}
{{--                            <option value="none">Select Product Category</option>--}}
{{--                            @foreach($categories as $category)--}}
{{--                                <option--}}
{{--                                    value="{{$category->id}}">{{$category->name}}</option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}
{{--                    </div>--}}
                    <div class="form-group">
                        <select class="form-control mb-2 subCategory" name="dialogCategory" id="sub_dialog_category">
                            <option value="none">Select Product Category</option>
                            @foreach($categories as $category)
                                <option
                                    value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <select class="form-control region" name="region" id="region" onchange="getTownsByRegion(this)">
                            <option value="none">Filter By Region</option>
                            @foreach($regions as $region)
                                <option
                                    value="{{$region->id}}">{{$region->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <select class="form-control town" name="town" id="town" onchange="getCityByTown(this)">
                            <option value="none">Filter By Town</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select class="form-control street" name="street" id="street">
                            <option value="none">Filter By Street</option>
                        </select>
                    </div>
                    <div class="form-group">
                           <textarea class="form-control html-editor" rows="5" name="Description" required
                                     placeholder="Description"></textarea>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn helep_btn_raise text-uppercase"
                           value="Send Product Quote">
                    <input id="QuoteImageCounter" type="hidden" name="QuoteImageCounter" value="0"/>
                    {{--                    <input type="hidden" name="searchData" value="{{$keyword}}"/>--}}
                </div>
            </form>
        </div>
    </div>
</div>

