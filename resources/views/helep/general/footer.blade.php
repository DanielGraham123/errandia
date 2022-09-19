@include('helep.general.components.loader')
</div>
<footer class="py-2">
    <div class="container py-sm-4">
        <div class="row my-1 pb-5 justify-content-between">
            <div class="col-md-4">
                <div class="text-capitalize"><span style="color: #fff">@lang('general.footer_menu_shops_title')</span>
                </div>
                <ul>
                    @foreach ($regions as $region)
                        <li><a href="{{route('regions_stores',['id' => $region->id])}}">{{ $region->name }}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="col-md-4  mb-2">
                <div class="text-capitalize">
                    <span style="color: #fff">@lang('general.footer_menu_main_title')</span></div>
                <ul>
                    <li>
                        <a href="{{route('show_page_content',['type'=>'about_page'])}}">@lang('general.footer_menu_about_title')</a>
                    </li>
                    <li>
                        <a href="{{route('show_page_content',['type'=>'help_center'])}}">@lang('general.footer_menu_help_center_title')</a>
                    </li>
                    <li>
                        <a href="{{route('show_page_content',['type'=>'policy_page'])}}">@lang('general.footer_menu_policy_title')</a>
                    </li>
                    <li>
                        <a href="{{route('show_page_content',['type'=>'disclaimer_page'])}}">@lang('general.footer_menu_disclaimer_title')</a>
                    </li>
                    <li>
                        <a href="{{route('show_page_content',['type'=>'report_page'])}}">@lang('general.footer_menu_report_abuse_title')</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-4  mb-2">
                <div class="text-uppercase"><a href="{{route('general_home')}}"
                                               style="color: #fff">@lang('general.footer_menu_home_title')</a></div>
                <ul>
                    @if(!auth()->check())
                        <li><a href="{{route('signup_page')}}">@lang('general.footer_menu_register_title')</a></li>
                    @endif
                    <li><a href="{{route('category_list_page')}}">@lang('general.footer_menu_category_title')</a></li>
                </ul>
            </div>
        </div>
        <div class="d-flex  justify-content-between flex-wrap  mt-2">
            <div class="d-flex flex-wrap"></div>
            <div class="d-flex flex-wrap ">
                <img class="footer-logo" src="{{asset('images/logo-1.png')}}">
                <div class="mx-sm-5 my-3 my-sm-0">Copyright © {{date('Y')}} Errandia All rights reserved.</div>
            </div>
            <div class="d-flex flex-wrap">
                <a class="p-1" href="#"><img class="footer-img" src="{{asset('images/asset-4.png')}}"></a>
                <a class="p-1" href="#"><img class="footer-img" src="{{asset('images/asset-5.png')}}"></a>
                <a class="p-1" href="#"><img class="footer-img" src="{{asset('images/asset-6.png')}}"></a>
                <a class="p-1" href="#"><img class="footer-img" src="{{asset('images/asset-3.png')}}"></a>
            </div>
        </div>
    </div>
</footer>

<script src="{{asset('js/plugins.min.js')}}"></script>
{{--<script src="{{asset('js/app.min.js')}}"></script>--}}
<script src="{{asset('js/helep.js')}}"></script>
<script src="{{asset('js/user-utilities.js')}}"></script>
<script>
    var QuoteImageCounter = 0;

    function previewProduct(obj, img_id) {
        var file = $("#" + obj.id).get(0).files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function () {
                $('#' + img_id).removeClass('d-none');
                $("#" + img_id).attr("src", reader.result);
                QuoteImageCounter++;
                $('#QuoteImageCounter').val(QuoteImageCounter);
            }
            $('#' + obj.id).addClass('helep_round');
            reader.readAsDataURL(file);
        }
    }

    function showCategoryList() {
        $("#categoryList").toggleClass("d-block d-sm-none");
        if ($("#headerMenu").hasClass("show")) {
            $("#headerMenu").removeClass("show");
        } else {
            $("#headerMenu").addClass("show");
        }

    }

    window.addEventListener('load',function (){
        const loadingSection = document.getElementById('loader-section');
        if(loadingSection){
            setTimeout(()=>{
                loadingSection.classList.add("d-none");

            },500)
        }
    })
</script>

@yield('js')
</body>
</html>
