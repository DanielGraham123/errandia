@extends('admin.layout')
@section('section')
    <div class="py-2">
        <div class="d-flex justify-content-end py-3 px-2">
            <a href="{{ route('admin.categories.create') }}" class=" btn btn-primary bg-sm py-2 px-4 text-white text-capitalize rounded"><span class="text-white fa fa-plus mx-2"></span>Add new category</a>
        </div>
        <div class="py-1 px-2 d-flex">


            <table class="table">
                <thead class="text-capitalize">
                    <th></th>
                    <th>title</th>
                    <th>products</th>
                    <th>services</th>
                    <th>action</th>
                </thead>
                <tbody>
                    @php $k = 1;
                    @endphp
                    @foreach($categories as $key => $cat)
                        <tr class="shadow-sm border-bottom">
                            <td>{{ $k++}}</td>
                            <td>
                                <div class="row bg-white border-0">
                                    <span class="col-sm-2" style="hieght: 4rem; width: 4rem; border-radius: 0.5rem;">
                                        <img style="hieght: 4rem; width: 4rem; border-radius: 0.5rem;" src="{{ asset('assets/admin/icons/'.$cat->image_path.'.svg') }}">
                                    </span>
                                    <div class="col-sm-10">
                                        <span class="d-block my-1 h5 text-primary">{{ $cat->name }}</span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                89
                            </td>
                            <td>
                                12
                            </td>
                          
                            <td>
                                <a href="#" class="text-secondary"><img src="{{ asset('assets/admin/icons/icon-edit.svg') }}" style="height: 1.3rem; width: 1.3rem; margin-right: 1rem;"></a>
                                <a href="#" onclick="_prompt('url', 'Are you sure you intend to delete this item? This process cannot be undone.')" class="text-danger"><img src="{{ asset('assets/admin/icons/icon-trash.svg') }}" style="height: 1.3rem; width: 1.3rem; margin-right: 1rem;"></a>
                            </td>
                        </tr>
                    @endforeach()
                </tbody>
            </table>
        </div>
    </div>
@endsection