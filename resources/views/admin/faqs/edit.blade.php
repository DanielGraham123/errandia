@extends('admin.layout')
@section('section')
    <div class="py-2">
        <div class="card">
            <div class="card-body p-3">
                <h5>Edit FAQ Item :: {{ $item->title }}</h5><hr>
                <form method="POST">
                    @csrf
                    <div class="my-2">
                        <label class="text-info d-block">Title</label>
                        <input class="form-control" name="title" placeholder="Enter title here" value="{{ old($item->title, 'title') }}">
                    </div>
                    <div class="my-2">
                        <label class="text-info d-block">Content</label>
                        <textarea class="form-control adv-editor" name="content" value="{{ old($item->content, 'content') }}" placeholder="Enter content here" id="quill_editor_1"></textarea>
                    </div>
                    <div class="my-2 d-flex justify-content-end">
                        <input type="submit" class="btn btn-primary btn-xs" value="save">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        new RichTextEditor('adv-editor')
    </script>
@endsection