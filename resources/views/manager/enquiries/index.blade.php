@extends('manager.layout')
@section('section')
    <div class="py-2 container">
        <div class="d-flex py-3 my-2 px-2">
            <span><span class="text-h4 d-block">Manage Enquiries</span> <span class="d-block text-extra">Manage on product/ service enquiries made by customers</span></span>
            
        </div>
        <div class="py-1">

            <table class="table">
                <thead class="text-capitalize">
                    <th></th>
                    <th>title</th>
                    <th>user</th>
                    <th>enquiry date</th>
                    <th>action</th>
                    <th>enquiry type</th>
                </thead>
                <tbody>
                    @php $k = 1;
                    @endphp
                    @foreach(count($enquiries) > 0 ? $enquiries : collect([null, null, null, null, null, null, null, null, null, null, null]) as $enq)
                        <tr class="shadow-sm border-bottom bg-white">
                            <td>{{ $k++}}</td>
                            <td>
                                <span class="">
                                    <img style="height: 3rem; width: 3rem; border-radius: 0.5rem; border: 1px solid gray; margin: 0.4rem 0.7rem;" src="{{ asset('assets/admin/icons/icon-category-fashion.svg') }}">
                                    <span style="color: var(--color-darkblue)">{{ $enq->title??"enquiry title" }}</span>
                                </span>
                            </td>
                            <td> <span class="text-link d-block">{{ $enq->user->name ?? 'enq user' }}</span><span class="text-quote d-block mb-0"> {{ $enq->user->name ?? '+237 673998023' }} <span class="fa fa-phone px-2 py-1 rounded alert alert-light border">Call</span></span><span class="text-extra d-block mt-0 pt-0">{{ $enq->user->email ?? 'freddikamda@yahoo.com' }}</span></td>
                            <td>{{ \Carbon\Carbon::parse($enq->created_at??'12-06-2041T10:07:34')->format('d-m-Y') }}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('manager.enquiries.show', $enq->slug??'slug') }}" class="text-decoration-none button-tertiary mb-2"> <img src="{{ asset('assets/admin/icons/icon-edit.svg') }}" style="height: 1.1rem;"> view details</a> <br>
                                    <a href="{{ route('manager.enquiries.mail', $enq->slug??'slug') }}" class="text-decoration-none button-tertiary mb-2"> <img src="{{ asset('assets/admin/icons/icon-edit.svg') }}" style="height: 1.1rem;"> send email</a> <br>
                                    <a href="#" onclick="_prompt(`{{ route('manager.enquiries.delete', $enq->slug??'slug') }}`, 'Are you sure you intend to delete this item? This process cannot be undone.')" class="text-decoration-none button-tertiary"> <img src="{{ asset('assets/admin/icons/icon-trash.svg') }}" style="height: 1.1rem;"> Delete</a>
                                </div>
                            </td>
                            <td>{{ $enq->type ?? 'service' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection