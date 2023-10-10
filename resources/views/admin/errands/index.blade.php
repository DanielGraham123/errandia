@extends('admin.layout')
@section('section')
    <div class="py-2">
        <div class="py-1 px-2 d-flex">

            <table class="table">
                <thead class="text-capitalize">
                    <th></th>
                    <th>title</th>
                    <th>Posted By</th>
                    <th>Search location</th>
                    <th>status</th>
                    <th>action</th>
                </thead>
                <tbody>
                    @php $k = 1;
                    @endphp
                    @for($i = 0; $i <= 50; $i++)
                        <tr class="shadow-sm border-bottom">
                            <td>{{ $k++}}</td>
                            <td>
                                <div class="row bg-white">
                                    <span class="col-sm-2" style="hieght: 4rem; width: 4rem; border-radius: 0.5rem;">
                                        <img style="hieght: 4rem; width: 4rem; border-radius: 0.5rem;" src="{{ asset('assets/admin/images/admin-profile-pic.png') }}">
                                    </span>
                                    <div class="col-sm-10">
                                        <span class="d-block my-1 h5 text-primary">We need a rounded top PC</span>
                                        <span class="text-secondary d-block">Sunt aliquid et itaque tempore repudiandae. Quia expedita deserunt sapiente</span>
                                        <span class="d-block mt-4 h5 text-dark">Posted: 02 April 2023</span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="d-block text-info my-2">Dr. Pearline Cummings</span>
                                <span class="d-block my-2">Phone: +237 698752586</span>
                            </td>
                            <td>
                                Molyko, Buea, South West Region
                            </td>
                            <td>
                                Found/Pending/Cancelled
                            </td>
                            <td>
                                <a href="#" class="text-danger"><img src="{{ asset('assets/admin/icons/icon-trash.svg') }}" style="height: 1.3rem; width: 1.3rem; margin-right: 1rem;"> Delete</a>
                            </td>
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>
    </div>
@endsection