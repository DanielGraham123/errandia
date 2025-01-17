@extends('admin.layout')
@section('section')
    <div class="py-2">
        <div class="card">
            <div class="card-body p-3">
                <h5>Create New FAQ Item</h5><hr>
                <form method="POST">
                    @csrf
                    <div class="mt-4 d-flex justify-content-end">
                        <input type="submit" class="button-secondary" value="Publish">
                    </div>
                    <div class="my-2">
                        <label class="text-info d-block">Title</label>
                        <input class="form-control" name="title" placeholder="Enter title here" value="{{ old('title') }}">
                    </div>
                    <div class="my-2">
                        <label class="text-info d-block">Content</label>
                        <textarea class="form-control adv-editor" name="content" style="height: 13rem;" id="myeditorinstance">
                            {{ old('content') }}
                        </textarea>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
@endsection
{{-- @section('script')
    <script>
        $('#editor-form').on('submit', function(){
            $(this).preventDefault();
            $('#editor_field').val($('#quill_editor_1'));
            $(this).submit();
        })
    </script>
@endsection --}}