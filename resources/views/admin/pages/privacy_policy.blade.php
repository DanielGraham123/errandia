@extends('admin.layout')
@section('section')
    <div class="py-3">
        <form method="post">
            @csrf
            
            <div class="card p-3">
                <div class="card-body">
                    <div class="py-2">
                        <label>Title</label>
                        <input type="text" class="form-control" name="title" id="" placeholder="enter policy title">
                    </div>
                    <div class="py-2">
                        <label>Content</label>
                        <textarea class="form-control" name="content" id="text-editor1" placeholder="Enter policy content"></textarea>
                    </div>
                    <div class="pt-4 d-flex justify-content-end ">
                        <input type="submit" class="btn btn-xs btn-primary" value="save">
                    </div>
                </div>
            </div>
        </form>

        <div class="pt-3">
            <table class="table">
                <thead class="text-capitalize">
                    <th>#</th>
                    <th>Title</th>
                    <th>Content</th>
                </thead>
                <tbody>
                    @php
                        $k = 1;
                    @endphp
                    @foreach (\App\Models\PrivacyPolicy::orderBy('title')->get() as $polc)
                        <tr>
                            <td>{{ $k++ }}</td>
                            <td>{{ $polc->title }}</td>
                            <td>{!! $polc->content !!}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('script')
    <script>
        let editor1 = new RichTextEditor('#text-editor1');
    </script>
@endsection