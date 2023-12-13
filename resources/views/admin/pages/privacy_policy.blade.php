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
                        <textarea class="form-control" name="content" id="basic-example" placeholder="Enter policy content"></textarea>
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
        
        tinymce.init({
        selector: 'textarea#basic-example',
        height: 500,
        menubar: false,
        plugins: [
            'advlist autolink lists link image charmap print preview anchor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table paste code help wordcount'
        ],
        toolbar: 'undo redo | formatselect | ' +
        'bold italic backcolor | alignleft aligncenter ' +
        'alignright alignjustify | bullist numlist outdent indent | ' +
        'removeformat | help',
        content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
        });


    </script>
@endsection