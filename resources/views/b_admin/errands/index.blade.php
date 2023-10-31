@extends('b_admin.layout')
@section('section')

    <div class="py-2 container">
        <div class="d-flex justify-content-between py-3 my-2 px-2">
            <span><span class="text-h4 d-block">Posted Errands <span class="text-h6">({{ count($errands) }})</span></span> <span class="d-block text-extra">Manage all errands you have posted on Errandia</span></span>
            <span class="d-inlineblock">
                <div class="tabbable">
                    <ul class="nav nav-tabs nav-right" id="myTab">
                        <li class="">
                            <a href="{{ route('business_admin.errands.create') }}" aria-expanded="false">
                                Run an errand
                            </a>
                        </li>

                        <li class="">
                            <a href="{{ Request::url() }}?action=posted" aria-expanded="false">
                                Posted
                            </a>
                        </li>

                        <li class="">
                            <a href="{{ Request::url() }}?action=recieved" aria-expanded="false">
                                Recieved
                            </a>
                        </li>

                    </ul>
                </div>
            </span>
        </div>
        <div class="py-1">

            <table class="table">
                <thead class="text-capitalize">
                    <th></th>
                    <th>title</th>
                    <th>search location</th>
                    {{-- @if(!isset($shop)) <th>Branch</th> @endif --}}
                    <th>action</th>
                    <th>status</th>
                </thead>
                <tbody>
                    @php $k = 1;
                    @endphp
                    @foreach(count($errands) > 0 ? $errands : collect([null, null, null, null, null, null]) as $err)
                        <tr class="border-bottom bg-white">
                            <td>{{ $k++}}</td>
                            <td>
                                <span class="">
                                    <span class="h-5 text-h6 d-block">{{ $err->title }}</span>
                                    <span style="color: var(--color-darkgray)">{{ $err->description??"description" }}</span>
                                </span>
                            </td>
                            <td> <span class="text-link d-block">{{ ($err != null ? ($err->location()??'Location') : 'search location') }}</span></td>
                            {{-- @if(!isset($shop)) <td> <span class="text-link d-block">{{ ($err != null ? ($err->shop->name??'Shop') : 'Shop name') .' ('. ($err != null ? ($err->shop->location()??'Location') : 'Location') }})</span></td> @endif  --}}
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('business_admin.errands.edit', $err->slug??'slug') }}" class="text-decoration-none mb-2"> <img src="{{ asset('assets/admin/icons/icon-edit.svg') }}" style="height: 1.1rem;"> edit</a> <br>
                                    <a href="{{ route('business_admin.errands.show', $err->slug??'slug') }}" class="text-decoration-none mb-2"> <img src="{{ asset('assets/badmin/icon-view.svg') }}" style="height: 1.1rem;"> view details</a> <br>
                                    <a href="{{ route('business_admin.errands.set_found', $err->slug??'slug') }}" class="text-decoration-none mb-2"> <img src="{{ asset('assets/badmin/icon-mark-check.svg') }}" style="height: 1.1rem;"> Mark as found</a> <br>
                                    <a href="#" onclick="_prompt(`{{ route('business_admin.errands.delete', $err->slug??'slug') }}`, 'Are you sure you intend to delete this item? This process cannot be undone.')" class="text-decoration-none mb-2"> <img src="{{ asset('assets/admin/icons/icon-trash.svg') }}" style="height: 1.1rem;"> Delete</a>
                                </div>
                            </td>
                            <td>@if ($err->status??null == 1)
                                <span class="text-quote"><img class="mr-2" style="height: 1.2rem; width: 1.2rem; " src="{{ asset('assets/badmin/icon-check-circle.svg') }}"> Published</span>
                            @else
                                <span class="text-quote"><img class="mr-2" style="height: 1.2rem; width: 1.2rem; " src="{{ asset('assets/badmin/icon-cancelled.svg') }}"> Unpublished</span>
                            @endif</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection