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
                        <input type="hidden" name="content" id="editor_field">
                        <div class="form-control adv-editor" style="height: 13rem;" id="quill_editor_1">
                            {{ old('content') }}
                        </div>
                    </div>
                </form>
                <div class="my-2">
                    <label class="text-info d-block">Content</label>
                    <textarea class="form-control adv-editor" name="content" value="{{ old('content') }}" placeholder="Enter content here" id="quill_editor_1"></textarea>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $('#editor-form').on('submit', function(){
            $(this).preventDefault();
            $('#editor_field').val($('#quill_editor_1'));
            $(this).submit();
        })
    </script>
@endsection