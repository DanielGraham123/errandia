@extends('admin.layout')
@section('section')
    <div class="py-2">
        <div class="card">
            <div class="card-body p-3">
                <h5>Create New FAQ Item</h5><hr>
                <form method="POST">
                    @csrf
                    <div class="my-2">
                        <label class="text-info d-block">Title</label>
                        <input class="form-control" name="title" placeholder="Enter title here" value="{{ old('title') }}">
                    </div>
                    <div class="my-2">
                        <label class="text-info d-block">Content</label>
                        <textarea class=" adv-editor" name="content" value="{{ old('content') }}" placeholder="Enter content here" id="adv-editor"></textarea>
                    </div>
                    <div class="mt-4 d-flex justify-content-end">
                        <input type="submit" class="button-secondary" value="Publish">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        new RichTextEditor('.adv-editor')
    </script>
@endsection