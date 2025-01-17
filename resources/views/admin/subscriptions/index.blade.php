@extends('admin.layout')
@section('section')
    <div class="py-2">
        <div class="d-flex justify-content-end py-3 px-2">
            <a href="{{ route('admin.plans.create') }}" class=" btn btn-primary bg-sm py-2 px-4 text-white text-capitalize rounded"><span class="text-white fa fa-plus mx-2"></span>Add Subscription Plan</a>
        </div>
        <div class="py-1 px-2 d-flex">


            <table class="table">
                <thead class="text-capitalize">
                    <th></th>
                    <th>title</th>
                    <th>decription</th>
                    <th>amount</th>
                    <th>action</th>
                </thead>
                <tbody>
                    @php $k = 1;
                    @endphp
                    @foreach($plans as $key => $plan)
                        <tr class="shadow-sm border-bottom">
                            <td>{{ $k++}}</td>
                            <td>{{ $plan->name??'' }}</td>
                            <td>{!! $plan->description??'' !!}</td>
                            <td>{{ $plan->amount??'' }}</td>
                            <td>
                                <a href="#" class="text-secondary"><img src="{{ asset('assets/admin/icons/icon-edit.svg') }}" style="height: 1.3rem; width: 1.3rem; margin-right: 1rem;"></a>
                            </td>
                        </tr>
                    @endforeach()
                </tbody>
            </table>
        </div>
    </div>
@endsection