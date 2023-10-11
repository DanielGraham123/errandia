@extends('admin.layout')
@section('section')
    <div class="py-2">
        <div class="d-flex justify-content-end py-3 px-2">
            <a href="{{ route('admin.products.create') }}" class=" btn btn-primary bg-sm py-2 px-4 text-white text-capitalize rounded"><span class="text-white fa fa-plus mx-2"></span>Add new Product</a>
        </div>
        <div class="py-1 px-2 d-flex">

            <table class="table">
                <thead class="text-capitalize">
                    <th></th>
                    <th>product title</th>
                    <th>Categories</th>
                    <th>business</th>
                    <th>Created</th>
                    <th>Price</th>
                    <th>action</th>
                </thead>
                <tbody>
                    @php $k = 1;
                    @endphp
                    @for($i = 0; $i <= 50; $i++)
                        <tr class="shadow-sm border-bottom">
                            <td>{{ $k++}}</td>
                            <td>
                                <div class="row bg-white border-0">
                                    <span class="col-sm-2">
                                        <img style="height: 5rem; width: 5rem;" src="{{ asset('assets/admin/images/admin-profile-pic.png') }}">
                                    </span>
                                    <div class="col-sm-10">
                                        <span class="d-block my-1 h5 my-2 text-dark">IPhone Pro Max</span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                Beauty, Hair
                            </td>
                            <td>
                                Gerson Emmerich
                            </td>
                            <td>
                                19th June 2020
                            </td>
                            <td>
                                XAF 110,0000
                            </td>
                            <td>
                                <div class="btn-group">
                                    <button data-toggle="dropdown" class="btn btn-xs btn-secondary dropdown-toggle" aria-expanded="false">
                                        <span class="ace-icon fa fa-caret-down icon-only"></span>
                                    </button>

                                    <ul class="dropdown-menu dropdown-light">
                                        <li class="list-item py-1 border-y"> <a href="{{ route('admin.products.show', 'business') }}" class="text-decoration-none text-secondary">view product</a></li>
                                        <li class="list-item py-1 border-y"> <a href="{{ route('admin.businesses.show', 'business') }}" class="text-decoration-none text-secondary">view business profile</a></li>
                                        <li class="list-item py-1 border-y"> <a href="#" class="text-decoration-none text-secondary">Delete</a></li>
                                    </ul>
                                </div>
                             </td>
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>
    </div>
@endsection