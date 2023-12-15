@extends('b_admin.layout')
@section('section')

    <div class="py-2 container">
        <div class="d-flex justify-content-between py-3 my-2 px-2">
            <span><span class="text-h4 d-block text-capitalize">{{ $title??'' }} <span class="text-h6">({{ count($errands) }})</span></span> <span class="d-block text-extra">Manage all errands you have posted on Errandia</span></span>
            <span class="d-inlineblock">
                <div class="navbar">
                    <ul class="nav d-flex" id="myTab">
                        <li class="nav-item">
                            <a class="nav-link button-secondary" href="{{ route('business_admin.errands.create') }}" aria-expanded="false">
                                Run an errand
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link  button-secondary" href="{{ Request::url() }}?action=posted" aria-expanded="false">
                                Posted
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link  button-secondary" href="{{ Request::url() }}?action=recieved" aria-expanded="false">
                                Recieved
                            </a>
                        </li>

                    </ul>
                </div>
            </span>
        </div>
        <div class="py-1">

            <table class="table table-responsive">
                <thead class="text-capitalize">
                    <th></th>
                    <th>title</th>
                    <th>search location</th>
                    {{-- @if(!isset($shop)) <th>Branch</th> @endif --}}
                    <th>action</th>
                    @if($action == 'posted')<th>status</th>@endif
                </thead>
                <tbody>
                    @php $k = 1; @endphp
                    @foreach($errands as $err)
                        <tr class="border-bottom bg-white">
                            <td>{{ $k++}}</td>
                            <td>
                                <span class="">
                                    <a href="{{ route('business_admin.errands.show', $err->slug) }}"><span class="  d-block">{{ $err->title }}</span></a>
                                </span>
                            </td>
                            <td><a href="{{ route('business_admin.errands.show', $err->slug) }}"> <span class=" d-block">{{ ($err != null ? ($err->location()??'Location') : 'search location') }}</span></a></td>
                            {{-- @if(!isset($shop)) <td> <span class="text-link d-block">{{ ($err != null ? ($err->shop->name??'Shop') : 'Shop name') .' ('. ($err != null ? ($err->shop->location()??'Location') : 'Location') }})</span></td> @endif  --}}
                            <td>
                                <div class="dropdown">
                                    <button data-bs-toggle="dropdown" class="btn btn-xs btn-secondary dropdown-toggle" aria-expanded="false">
                                        <span class="ace-icon icon-only"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li class="dropdown-item"><a href="{{ route('business_admin.errands.show', $err->slug??'slug') }}" class="text-decoration-none mb-2"> <img src="{{ asset('assets/badmin/icon-view.svg') }}" style="height: 0.8rem;"> view details</a> <br></li>
                                        <li class="dropdown-item"><a href="{{ route('business_admin.errands.set_found', $err->slug??'slug') }}" class="text-decoration-none mb-2"> <img src="{{ asset('assets/badmin/icon-mark-check.svg') }}" style="height: 0.8rem;"> Mark as found</a></li>
                                        <li class="dropdown-item"><a href="#" onclick="_prompt(`{{ route('business_admin.errands.delete', $err->slug??'slug') }}`, 'Are you sure you intend to delete this item? This process cannot be undone.')" class="text-decoration-none mb-2"> <img src="{{ asset('assets/admin/icons/icon-trash.svg') }}" style="height: 0.8rem;"> Delete</a></li>
                                    </ul>
                                </div>
                            </td>
                            @if($action == 'published')
                                <td>@if ($err->status??null == 1)
                                    <span class="text-quote"><img class="mr-2" style="height: 1.2rem; width: 1.2rem; " src="{{ asset('assets/badmin/icon-check-circle.svg') }}"> Published</span>
                                @else
                                    <span class="text-quote"><img class="mr-2" style="height: 1.2rem; width: 1.2rem; " src="{{ asset('assets/badmin/icon-cancelled.svg') }}"> Unpublished</span>
                                @endif</td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection