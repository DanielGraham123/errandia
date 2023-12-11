@extends('b_admin.layout')
@section('section')
<form method="POST" enctype="multipart/form-data">
    @csrf
    <div class="d-flex">
        <div class="py-4 my-5 px-3 container shadow mx-auto" style="border-radius: 0.8rem;">
            <div class="text-h6 text-center text-uppercase my-3">Search User</div>
            <div class="mx-5 my-2">
                <div class="px-2 py-2">
                    <input type="search" oninput="searchUser(event)" class="form-control" placeholder="Search user by name or email">
                </div>
            </div>
            <div class="mx-5">
                <table class="table">
                    <thead class="text-capitalize">
                        <th>##</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Action</th>
                    </thead>
                    <tbody id="__users">

                    </tbody>
                </table>
            </div>
        </div>

    </div>
</form>
@endsection
@section('script')
    <script>
        let searchUser = function(event){
            let input = event.target.value;
            let url = "{{ route('searchUser') }}";
            $.ajax({
                method: 'get', url: url, data: {par: input},
                success: function(response){
                    console.log(response);
                    let users = response.users;
                    let html = '';
                    let counter  = 1;
                    users.forEach(user => {
                        html += `<tr>
                                <td>${counter++}</td>
                                <td>${user.name}</td>
                                <td>${user.email}</td>
                                <td><a class="button-primary" href="{{ route('business_admin.managers.send_request', ['shop_slug'=>$shop->slug, 'user_id'=>'__UID__']) }}">send request</a></td>
                            </tr>`.replace('__UID__', user.id); 
                    });
                    $('#__users').html(html);
                }
            });
        }
    </script>
@endsection