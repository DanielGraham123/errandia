@extends('helep.admin.layout.master')
@section('page_title') @lang('shop.list_shops_title') @endsection
@section('title') @lang('shop.list_shops_title') @endsection
@section('content')
    <div class="p-5">
        <div class=" d-flex justify-content-between">
            <div class="d-flex flex-wrap"></div>
            <div class="d-flex flex-wrap"></div>
            <div class="d-flex flex-wrap"><a href="{{route('add_shop')}}">
                    <button type="button" class="btn helep_btn_raise">
                        <i class="fa fa-plus pr-1"></i>{{trans('shop.create_shop_page_title')}}</button>
                </a></div>
        </div>
        <br/><br/>
        <div class="row card-deck my-5">
        <table id="example" class="table table-striped table-bordered nowrap" style="width:100%">
        	<thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Category</th>
                <th>User Name</th>
                <th>Email ID</th>
                <th>Phone</th>
                <!--<th>Website</th>-->
                <th>Action</th>
            </tr>
            </thead>
    		<tbody>
            @foreach($shops as $shop)
            <tr>
                <td>{{$shop->id}}</td>
                <td style="white-space: normal">{{$shop->name}}</td>


                <td style="white-space: normal">
                    @if( sizeof($shop->categories))
                        @foreach($shop->categories as $key=>$category)
                            {{$category->name}}
                            @if($key < sizeof($shop->categories) -1)
                                {{','}}
                            @endif
                        @endforeach
                    @elseif($shop->category)
                        {{$shop->category->name}}
                    @endif
                </td>
                <td style="white-space: normal">{{$shop->user->name}}</td>
                <td style="white-space: normal">{{$shop->user->email}}</td>
                <td>{{$shop->user->tel}}</td>
               <!-- <td>{{$shop->shopContactInfo->website_link}}</td>-->
                <td>
                <a href="{{route('show_shop',['id'=>$shop->slug])}}" class="text-muted"><i class="fa fa-eye text-info"></i>&nbsp;{{trans('admin.view_msg')}}</a>
                <a href="{{route('edit_shop',['id'=>$shop->slug])}}" class="text-muted"><i class="fa fa-edit text-primary"></i>&nbsp;{{trans('admin.edit_msg')}}</a> <a href="{{route('delete_shop',['id'=>$shop->slug])}}" class="text-muted"><i class="fa fa-trash text-danger"></i>&nbsp;{{trans('admin.delete_msg')}}</a>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
        </div>
    </div>
@endsection
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.css">
@section('js')
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.js"></script>
    <script>
        $(function () {
            //set link indicator
            $("#admin_manage_shops").addClass('active');
        });
		$(document).ready( function () {
			$('#example').DataTable(
				{
				"order": [[ 0, "desc" ]]
				}
			);
		} );
    </script>
@endsection
