<link href="{{asset('richtexteditor/rte_theme_default.css')}}" rel="stylesheet">

<textarea class="errandia_rich_text_editor" name="{{$textareaName}}">
    @if( isset($serverData)  && $serverData)
        {{$serverData}}
    @else
    {{@old($textareaName)}}
    @endif
</textarea>

<script src="{{asset("richtexteditor/rte.js")}}"></script>
<script src="{{asset("richtexteditor/plugins/all_plugins.js")}}"></script>

<script>
    let editor1 = new RichTextEditor(".errandia_rich_text_editor");
</script>
