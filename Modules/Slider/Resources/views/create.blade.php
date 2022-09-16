@extends('helep.admin.layout.master')
@section('page_title') @lang('admin.slider_add_title_msg') @endsection
@section('title') @lang('admin.slider_add_title_msg') @endsection
@section('content')
    <div class="">
        <div class="p-2 shadow-sm">
            <div class=" d-flex justify-content-between">
                <div class="d-flex flex-wrap"><a href="{{route('street')}}">
                        <button type="button" class="btn helep_btn_raise">
                            <i class="fa fa-arrow-left pr-1"></i>{{trans('admin.return_back_msg')}}</button>
                    </a></div>
                <div class="d-flex flex-wrap"></div>
                <div class="d-flex flex-wrap"></div>
            </div>
            <div class="clearfix"><br/></div>
            <form enctype="multipart/form-data" method="POST" action="{{route('save_slider')}}"
                  class="my-2 d-flex-column align-items-center px-sm-5">
                @csrf
                <div class="form-group w-100">
                    <h5 class="text-black-50 font-weight-bold  mb-2 p-2">Image</h5>
                    <div class="row">
                        <div class="col-md-8 ">
                            <div class="col-6 col-sm-3  mb-2">
                    <div for="photoreview-1" class="d-flex border radius-15  w-100 select-photo">
                      <div class="rounded-lg"> <img id="previewimage-1" height="100%" width="100%" class="d-none" src=""> </div>
                      <label for="photoreview-1" class="w-100 h-100 d-flex-column align-items-center justify-content-center text-center  font-20"> <span class="text-center font-20">+</span> </label>
                      <input onchange="previewReviewImage(this,'previewimage-1')" name="previewimage-1" class="d-none" id="photoreview-1" type="file">
                    </div>
                  </div>
                        </div>
                        <div class="col-md-4"></div>
                    </div>
                    
                    <h5 class="text-black-50 font-weight-bold  mb-2 p-2">Category </h5>
                    <div class="row">
                        <div class="col-md-8 ">
                    <select class="form-control" onchange="getSubCategoriesByCategory(this)" name="category"
                            id="category">
                        <option value="none">Select Category</option>

                        @foreach($categories as $category)
                            <option
                                value="{{$category->id}}" >{{$category->name}}</option>
                        @endforeach

                    </select>
						</div>
                     </div>
                    
                    <h5 class="text-black-50 font-weight-bold  mb-2 p-2">Sub Category </h5>
                    <div class="row">
                        <div class="col-md-8 ">
                    <select class="form-control" name="sub_category" id="sub_category">
                        <option value="">Select Sub Category</option>

                    </select>
                    </div>
                     </div>
                    <h5 class="text-black-50 font-weight-bold  mb-2 p-2">Caption </h5>
                    <div class="row">
                        <div class="col-md-8 ">
                            <div class="input-group border-with-radius mb-3">
                                <input value="" name="caption" type="text" class="form-control"
                                       placeholder="Caption">
                            </div>
                        </div>
                        <div class="col-md-4"></div>
                    </div>
                    
                    <h5 class="text-black-50 font-weight-bold  mb-2 p-2">Duration (Days)</h5>
                    <div class="row">
                        <div class="col-md-8 ">
                            <div class="input-group border-with-radius mb-3">
                                <input value="" name="duration" type="text" class="form-control"
                                       placeholder="Duration">
                            </div>
                        </div>
                        <div class="col-md-4"></div>
                    </div>
                    
                </div>
                <div class="align-self-start d-flex-column mb-2">
                    <button class="btn helep_btn_raise px-5 shadow w-100">{{trans('admin.add_slider_btn')}}</button>
                </div>
                <input id="counter" type="hidden" name="counter" value="0"/>
            </form>
        </div>
    </div>
@endsection

@section('js')

<script>
        $(function () {
            //set link indicator
            $("#sidebar_manage_slider").addClass('active');
			
        });
		var counter = 0;
		function previewReviewImage(obj, img_id) {
			var file = $("#" + obj.id).get(0).files[0];
			if (file) {
				var reader = new FileReader();
				reader.onload = function () {
					$('#' + img_id).removeClass('d-none');
					$("#" + img_id).attr("src", reader.result);
					counter++;
					$('#counter').val(counter);				
				}
				$('#' + obj.id).addClass('helep_round');
				
				reader.readAsDataURL(file);
			}
		}
		
		function getSubCategoriesByCategory(obj) {
                if (obj.id === "dialog_category") {
                    var category = $("#dialog_category").val();
                } else {
                    var category = $("#category").val();
                }
                if (category === "none") return;
                $("#sub_category").html("<option value='none'>Please Wait ....</option>");
                $.ajax({
                    datatype: "json",
                    type: 'get',
                    data: {
                        category: category
                    },
                    url: $("#baseUrl").val() + '/categories/subcategories/category',
                    success: function (response) {
                        var res = JSON.parse(response);
                        if (obj.id === "dialog_category") {
                            $("#sub_dialog_category").html(res.data);
                            $('#sub_dialog_category option[value="<?php echo $request['sub_category'];?>"]').attr("selected", "selected");
                        } else {
                            $("#sub_category").html(res.data);
                            $('#sub_category option[value="<?php echo $request['sub_category'];?>"]').attr("selected", "selected");
                        }
                    },
                    error: function () {
                        console.log("Eror getting response");
                    }
                });
            }
</script>
@endsection
