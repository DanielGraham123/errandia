@extends('b_admin.layout')
@section('section')
    <div class="py-2">
        <div class="d-flex justify-content-between py-3 my-2 px-2">
            <span><span class="text-h4 d-block">Shop Managers</span> <span class="d-block text-extra">assign people to manage your shops</span></span>
            <span>
                <a href="{{ route('business_admin.managers.create', $shop->slug) }}" class="button-primary py-2 px-4 text-white text-capitalize rounded"><span class="text-white fa fa-plus mx-2"></span>Add new manager</a>
            </span>
        </div>
        <div class="py-1 px-2 d-flex">

            <table class="table">
                <thead class="text-capitalize">
                    <th></th>
                    <th>name</th>
                    <th>shop location</th>
                    <th>phone</th>
                    <th>action</th>
                    <th>Created At</th>
                </thead>
                <tbody>
                    @php $k = 1;
                    @endphp
                    @foreach($managers as $manager)
                        <tr class="shadow-sm border-bottom bg-white">
                            <td>{{ $k++}}</td>
                            <td>
                                <span class="">{{ $manager->name }}</span>
                            </td>
                            <td>{{ $shop != null ? $shop->contactInfo->location() : '' }}</td>
                            <td>{{ $shop != null ? $shop->contactInfo->phone : '' }}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="#" onclick="_prompt(`{{ route('business_admin.managers.delete', [$shop->slug, $manager->id]) }}`, 'Are you sure you intend to delete this item? This process cannot be undone.')" class="text-decoration-none button-tertiary"> <img src="{{ asset('assets/admin/icons/icon-trash.svg') }}" style="height: 1.1rem;"> remove</a>
                                </div>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($manager->created_at)->format('d-m-Y @ H:i:s') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection