@extends('admin.layout')
@section('section')
    <div class="py-2">
        <div class="d-flex justify-content-end py-3 px-2">
            <a href="{{ route('admin.categories.sub_categories.create') }}" class=" btn btn-primary bg-sm py-2 px-4 text-white text-capitalize rounded"><span class="text-white fa fa-plus mx-2"></span>Add sub category</a>
        </div>
        <div class="py-1 px-2 d-flex">


            <table class="table">
                <thead class="text-capitalize">
                    <th></th>
                    <th>title</th>
                    <th>category</th>
                    <th>products</th>
                    <th>services</th>
                    <th>action</th>
                </thead>
                <tbody>
                    @php $k = 1;
                    @endphp
                    @foreach($sub_categories as $key => $cat)
                        <tr class="shadow-sm border-bottom">
                            <td>{{ $k++}}</td>
                            <td>{{ $cat->name??'' }}</td>
                            <td>{{ $cat->category->name??'' }}</td>
                            <td>
                                89
                            </td>
                            <td>
                                12
                            </td>
                          
                            <td>
                                <a href="#" class="text-secondary"><img src="{{ asset('assets/admin/icons/icon-edit.svg') }}" style="height: 1.3rem; width: 1.3rem; margin-right: 1rem;"></a>
                                <a href="#" class="text-danger"><img src="{{ asset('assets/admin/icons/icon-trash.svg') }}" style="height: 1.3rem; width: 1.3rem; margin-right: 1rem;"></a>
                            </td>
                        </tr>
                    @endforeach()
                </tbody>
            </table>
        </div>
    </div>
@endsection