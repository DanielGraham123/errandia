@extends('helep.general.master')

@section('content')
    <div class="py-5 container-lg">
        <div class="ml-lg-n2 mr-lg-n5">
            <div class="row card helep_alert_round">
                <div class=" card-body col-md-12">
                    @includeWhen($categories->count()>0,'helep.general.components.home_category_menu',['categories'=>$categories])

                    <div class="clearfix"></div>
                    <h4 class="text-black-50 font-weight-bold  pb-2 mb-2">
                        @lang('general.product_category_list_heading',['title'=>trans('general.components_popular_categories_title')])
                    </h4>
                    @include('generalmodule::components.product_list',['products'=>$products,'subCategories'=>$subCategories])
                </div>
            </div>
        </div>
    </div>
@endsection
