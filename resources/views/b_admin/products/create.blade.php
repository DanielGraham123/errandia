@extends('b_admin.layout')
@section('section')
    {{-- <div class="container">
        <div class="table-header">
            Add New Product For {{ $shop->name }} <i class="text-body">({{ $shop->location() }})</i>
        </div>
        <form method="POST" enctype="multipart/form-data">
            @csrf
            <div class="py-1 my-5 py-5 px-5 border bg-white" style="border-radius: 1rem;">
                <span class="d-block mt-4" style="font-weight: 700;">Product Name *</span>
                <input class="my-2 form-control rounded" name="name" type="text" required value="{{ old('name') }}" placeholder="Product Name">
                <span class="d-block mt-4" style="font-weight: 700;">Unit Price *</span>
                <div class="input-group border rounded">
                    <select class="form-control w-25 rounded-left border-0" name="currency">
                        <option value="XAF" selected >XAF</option>
                        @foreach ($currencies??[] as $cur)
                            <option value="{{ $cur->name }}" {{ $cur->name == 'XAF' ? 'selected' : '' }}>{{ $cur->name }}</option>
                        @endforeach
                    </select>
                    <input class="form-control border-0 rounded-right" name="price" value="{{ old('price') }}" placeholder="price">
                </div>
                <span class="d-block mt-4" style="font-weight: 700;">Description</span>
                <textarea class="form-control rounded" name="description" rows='4' required>{{ old('description', '') }}</textarea>
                <span class="d-block mt-4" style="font-weight: 700;">Product Tags <span class="text-info">(related names separated by commas)</span></span>
                <input class="form-control rounded" name="tags" value="{{ old('tags') }}" placeholder="tags" required>
                <span class="d-block text-overline" style="font-weight: 700;">Enter terms related to your product</span>
                <span class="d-block mt-4" style="font-weight: 700;">Upload Default image *</span>
                <div class="d-flex flex-wrap justify-content-between" id="defaultImageContainer">
                    <div class="d-inlineblock">
                        <input type="file" accept="image/*" class="form-control rounded" name="image" onchange="defaultPreview(event)" required>
                        <span class="d-block text-overline" style="font-weight: 700;">This appear as the main image on the website</span>
                    </div>
                </div>
            </div>
            <span class="d-block my-4"><button class="button-primary" type="submit">NEXT</button></span>
        </form>
    </div> --}}
    
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-sm-8 m-auto">
                        <div class="card">
                            <div class="card-body" data-select2-id="select2-data-32-jycn">
                                <div class="card-header-2">
                                    <h5>Product Information</h5>
                                </div>

                                <form class="theme-form theme-form-2 mega-form" data-select2-id="select2-data-31-03rm">
                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Product
                                            Name</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text" placeholder="Product Name">
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="col-sm-3 col-form-label form-label-title">Product
                                            Type</label>
                                        <div class="col-sm-9">
                                            <select class="js-example-basic-single w-100 select2-hidden-accessible" name="state" data-select2-id="select2-data-1-ob8m" tabindex="-1" aria-hidden="true">
                                                <option disabled="">Static Menu</option>
                                                <option data-select2-id="select2-data-3-be5y">Simple</option>
                                                <option>Classified</option>
                                            </select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="select2-data-2-cwjq" style="width: 740.484px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-state-nk-container" aria-controls="select2-state-nk-container"><span class="select2-selection__rendered" id="select2-state-nk-container" role="textbox" aria-readonly="true" title="Simple">Simple</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="col-sm-3 col-form-label form-label-title">Category</label>
                                        <div class="col-sm-9">
                                            <select class="js-example-basic-single w-100 select2-hidden-accessible" name="state" data-select2-id="select2-data-4-radp" tabindex="-1" aria-hidden="true">
                                                <option disabled="">Category Menu</option>
                                                <option data-select2-id="select2-data-6-owrh">Electronics</option>
                                                <option>TV &amp; Appliances</option>
                                                <option>Home &amp; Furniture</option>
                                                <option>Another</option>
                                                <option>Baby &amp; Kids</option>
                                                <option>Health, Beauty &amp; Perfumes</option>
                                                <option>Uncategorized</option>
                                            </select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="select2-data-5-a69v" style="width: 740.484px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-state-7h-container" aria-controls="select2-state-7h-container"><span class="select2-selection__rendered" id="select2-state-7h-container" role="textbox" aria-readonly="true" title="Electronics">Electronics</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="col-sm-3 col-form-label form-label-title">Subcategory</label>
                                        <div class="col-sm-9">
                                            <select class="js-example-basic-single w-100 select2-hidden-accessible" name="state" data-select2-id="select2-data-7-10xb" tabindex="-1" aria-hidden="true">
                                                <option disabled="">Subcategory Menu</option>
                                                <option data-select2-id="select2-data-9-tozy">Ethnic Wear</option>
                                                <option>Ethnic Bottoms</option>
                                                <option>Women Western Wear</option>
                                                <option>Sandels</option>
                                                <option>Shoes</option>
                                                <option>Beauty &amp; Grooming</option>
                                            </select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="select2-data-8-dodb" style="width: 740.484px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-state-5m-container" aria-controls="select2-state-5m-container"><span class="select2-selection__rendered" id="select2-state-5m-container" role="textbox" aria-readonly="true" title="Ethnic Wear">Ethnic Wear</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="col-sm-3 col-form-label form-label-title">Brand</label>
                                        <div class="col-sm-9">
                                            <select class="js-example-basic-single w-100 select2-hidden-accessible" data-select2-id="select2-data-10-sisp" tabindex="-1" aria-hidden="true">
                                                <option disabled="">Brand Menu</option>
                                                <option value="puma" data-select2-id="select2-data-12-udso">Puma</option>
                                                <option value="hrx">HRX</option>
                                                <option value="roadster">Roadster</option>
                                                <option value="zara">Zara</option>
                                            </select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="select2-data-11-nei4" style="width: 740.484px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-2o7h-container" aria-controls="select2-2o7h-container"><span class="select2-selection__rendered" id="select2-2o7h-container" role="textbox" aria-readonly="true" title="Puma">Puma</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center" data-select2-id="select2-data-30-ep39">
                                        <label class="col-sm-3 col-form-label form-label-title">Unit</label>
                                        <div class="col-sm-9" data-select2-id="select2-data-29-23do">
                                            <select class="js-example-basic-single w-100 select2-hidden-accessible" data-select2-id="select2-data-13-c1jb" tabindex="-1" aria-hidden="true">
                                                <option disabled="" data-select2-id="select2-data-34-f0hb">Unit Menu</option>
                                                <option data-select2-id="select2-data-15-62wv">Kilogram</option>
                                                <option data-select2-id="select2-data-35-36mt">Pieces</option>
                                            </select><span class="select2 select2-container select2-container--default select2-container--below" dir="ltr" data-select2-id="select2-data-14-409b" style="width: 740.484px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-lu24-container" aria-controls="select2-lu24-container"><span class="select2-selection__rendered" id="select2-lu24-container" role="textbox" aria-readonly="true" title="Kilogram">Kilogram</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                                        </div>
                                    </div>
                                    <div class="mb-4 row align-items-center">
                                        <label class="col-sm-3 col-form-label form-label-title">Tags</label>
                                        <div class="col-sm-9">
                                            <div class="bs-example">
                                                <div class="bootstrap-tagsinput"> <span class="tag label label-info">m<span data-role="remove"></span></span> <input type="text" placeholder="Type tag &amp; hit enter" size="20"></div><input type="text" class="form-control" placeholder="Type tag &amp; hit enter" id="#inputTag" data-role="tagsinput" style="display: none;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-4 row align-items-center">
                                        <label class="col-sm-3 col-form-label form-label-title">Exchangeable</label>
                                        <div class="col-sm-9">
                                            <label class="switch">
                                                <input type="checkbox"><span class="switch-state"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="row align-items-center">
                                        <label class="col-sm-3 col-form-label form-label-title">Refundable</label>
                                        <div class="col-sm-9">
                                            <label class="switch">
                                                <input type="checkbox" checked=""><span class="switch-state"></span>
                                            </label>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="card-header-2">
                                    <h5>Description</h5>
                                </div>

                                <form class="theme-form theme-form-2 mega-form">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row">
                                                <label class="form-label-title col-sm-3 mb-0">Product
                                                    Description</label>
                                                <div class="col-sm-9">
                                                    <div id="editor" style="display: none;"></div><div class="ck ck-reset ck-editor ck-rounded-corners" role="application" dir="ltr" lang="en" aria-labelledby="ck-editor__label_e07957daf435e9ae80e89b7c024ba033a"><label class="ck ck-label ck-voice-label" id="ck-editor__label_e07957daf435e9ae80e89b7c024ba033a">Rich Text Editor</label><div class="ck ck-editor__top ck-reset_all" role="presentation"><div class="ck ck-sticky-panel"><div class="ck ck-sticky-panel__placeholder" style="display: none;"></div><div class="ck ck-sticky-panel__content"><div class="ck ck-toolbar ck-toolbar_grouping" role="toolbar" aria-label="Editor toolbar"><div class="ck ck-toolbar__items"><div class="ck ck-dropdown ck-heading-dropdown"><button class="ck ck-button ck-off ck-button_with-text ck-dropdown__button" type="button" tabindex="-1" aria-labelledby="ck-editor__aria-label_e5ce3ca925c083ac9b3d07602b6201090" aria-haspopup="true"><span class="ck ck-tooltip ck-tooltip_s"><span class="ck ck-tooltip__text">Heading</span></span><span class="ck ck-button__label" id="ck-editor__aria-label_e5ce3ca925c083ac9b3d07602b6201090">Paragraph</span><svg class="ck ck-icon ck-dropdown__arrow" viewBox="0 0 10 10"><path d="M.941 4.523a.75.75 0 1 1 1.06-1.06l3.006 3.005 3.005-3.005a.75.75 0 1 1 1.06 1.06l-3.549 3.55a.75.75 0 0 1-1.168-.136L.941 4.523z"></path></svg></button><div class="ck ck-reset ck-dropdown__panel ck-dropdown__panel_se"><ul class="ck ck-reset ck-list"><li class="ck ck-list__item"><button class="ck ck-button ck-heading_paragraph ck-on ck-button_with-text" type="button" tabindex="-1" aria-labelledby="ck-editor__aria-label_e1d1a1d477d8b8e729ad49b785d6cd024"><span class="ck ck-tooltip ck-tooltip_s ck-hidden"><span class="ck ck-tooltip__text"></span></span><span class="ck ck-button__label" id="ck-editor__aria-label_e1d1a1d477d8b8e729ad49b785d6cd024">Paragraph</span></button></li><li class="ck ck-list__item"><button class="ck ck-button ck-heading_heading1 ck-off ck-button_with-text" type="button" tabindex="-1" aria-labelledby="ck-editor__aria-label_e51eff64061a1c529f556ea13b46132e0"><span class="ck ck-tooltip ck-tooltip_s ck-hidden"><span class="ck ck-tooltip__text"></span></span><span class="ck ck-button__label" id="ck-editor__aria-label_e51eff64061a1c529f556ea13b46132e0">Heading 1</span></button></li><li class="ck ck-list__item"><button class="ck ck-button ck-heading_heading2 ck-off ck-button_with-text" type="button" tabindex="-1" aria-labelledby="ck-editor__aria-label_ebc2b5bd2b466187d005214afbaa0028f"><span class="ck ck-tooltip ck-tooltip_s ck-hidden"><span class="ck ck-tooltip__text"></span></span><span class="ck ck-button__label" id="ck-editor__aria-label_ebc2b5bd2b466187d005214afbaa0028f">Heading 2</span></button></li><li class="ck ck-list__item"><button class="ck ck-button ck-heading_heading3 ck-off ck-button_with-text" type="button" tabindex="-1" aria-labelledby="ck-editor__aria-label_eb6e54aba8ce0d5bdb3b52ade3810a07f"><span class="ck ck-tooltip ck-tooltip_s ck-hidden"><span class="ck ck-tooltip__text"></span></span><span class="ck ck-button__label" id="ck-editor__aria-label_eb6e54aba8ce0d5bdb3b52ade3810a07f">Heading 3</span></button></li></ul></div></div><span class="ck ck-toolbar__separator"></span><button class="ck ck-button ck-off" type="button" tabindex="-1" aria-labelledby="ck-editor__aria-label_e2464e706a64ca4de704666e0cbab62db" aria-pressed="false"><svg class="ck ck-icon ck-button__icon" viewBox="0 0 20 20"><path d="M10.187 17H5.773c-.637 0-1.092-.138-1.364-.415-.273-.277-.409-.718-.409-1.323V4.738c0-.617.14-1.062.419-1.332.279-.27.73-.406 1.354-.406h4.68c.69 0 1.288.041 1.793.124.506.083.96.242 1.36.478.341.197.644.447.906.75a3.262 3.262 0 0 1 .808 2.162c0 1.401-.722 2.426-2.167 3.075C15.05 10.175 16 11.315 16 13.01a3.756 3.756 0 0 1-2.296 3.504 6.1 6.1 0 0 1-1.517.377c-.571.073-1.238.11-2 .11zm-.217-6.217H7v4.087h3.069c1.977 0 2.965-.69 2.965-2.072 0-.707-.256-1.22-.768-1.537-.512-.319-1.277-.478-2.296-.478zM7 5.13v3.619h2.606c.729 0 1.292-.067 1.69-.2a1.6 1.6 0 0 0 .91-.765c.165-.267.247-.566.247-.897 0-.707-.26-1.176-.778-1.409-.519-.232-1.31-.348-2.375-.348H7z"></path></svg><span class="ck ck-tooltip ck-tooltip_s"><span class="ck ck-tooltip__text">Bold (Ctrl+B)</span></span><span class="ck ck-button__label" id="ck-editor__aria-label_e2464e706a64ca4de704666e0cbab62db">Bold</span></button><button class="ck ck-button ck-off" type="button" tabindex="-1" aria-labelledby="ck-editor__aria-label_e0f11d79f36ff83091177f81ec3b5a2f6" aria-pressed="false"><svg class="ck ck-icon ck-button__icon" viewBox="0 0 20 20"><path d="m9.586 14.633.021.004c-.036.335.095.655.393.962.082.083.173.15.274.201h1.474a.6.6 0 1 1 0 1.2H5.304a.6.6 0 0 1 0-1.2h1.15c.474-.07.809-.182 1.005-.334.157-.122.291-.32.404-.597l2.416-9.55a1.053 1.053 0 0 0-.281-.823 1.12 1.12 0 0 0-.442-.296H8.15a.6.6 0 0 1 0-1.2h6.443a.6.6 0 1 1 0 1.2h-1.195c-.376.056-.65.155-.823.296-.215.175-.423.439-.623.79l-2.366 9.347z"></path></svg><span class="ck ck-tooltip ck-tooltip_s"><span class="ck ck-tooltip__text">Italic (Ctrl+I)</span></span><span class="ck ck-button__label" id="ck-editor__aria-label_e0f11d79f36ff83091177f81ec3b5a2f6">Italic</span></button><button class="ck ck-button ck-off" type="button" tabindex="-1" aria-labelledby="ck-editor__aria-label_ec6bdbf521fce43677652e30edea98286" aria-pressed="false"><svg class="ck ck-icon ck-button__icon" viewBox="0 0 20 20"><path d="m11.077 15 .991-1.416a.75.75 0 1 1 1.229.86l-1.148 1.64a.748.748 0 0 1-.217.206 5.251 5.251 0 0 1-8.503-5.955.741.741 0 0 1 .12-.274l1.147-1.639a.75.75 0 1 1 1.228.86L4.933 10.7l.006.003a3.75 3.75 0 0 0 6.132 4.294l.006.004zm5.494-5.335a.748.748 0 0 1-.12.274l-1.147 1.639a.75.75 0 1 1-1.228-.86l.86-1.23a3.75 3.75 0 0 0-6.144-4.301l-.86 1.229a.75.75 0 0 1-1.229-.86l1.148-1.64a.748.748 0 0 1 .217-.206 5.251 5.251 0 0 1 8.503 5.955zm-4.563-2.532a.75.75 0 0 1 .184 1.045l-3.155 4.505a.75.75 0 1 1-1.229-.86l3.155-4.506a.75.75 0 0 1 1.045-.184z"></path></svg><span class="ck ck-tooltip ck-tooltip_s"><span class="ck ck-tooltip__text">Link (Ctrl+K)</span></span><span class="ck ck-button__label" id="ck-editor__aria-label_ec6bdbf521fce43677652e30edea98286">Link</span></button><button class="ck ck-button ck-off" type="button" tabindex="-1" aria-labelledby="ck-editor__aria-label_e3f6f236207db30607b08c43fcac9a7ba" aria-pressed="false"><svg class="ck ck-icon ck-button__icon" viewBox="0 0 20 20"><path d="M7 5.75c0 .414.336.75.75.75h9.5a.75.75 0 1 0 0-1.5h-9.5a.75.75 0 0 0-.75.75zm-6 0C1 4.784 1.777 4 2.75 4c.966 0 1.75.777 1.75 1.75 0 .966-.777 1.75-1.75 1.75C1.784 7.5 1 6.723 1 5.75zm6 9c0 .414.336.75.75.75h9.5a.75.75 0 1 0 0-1.5h-9.5a.75.75 0 0 0-.75.75zm-6 0c0-.966.777-1.75 1.75-1.75.966 0 1.75.777 1.75 1.75 0 .966-.777 1.75-1.75 1.75-.966 0-1.75-.777-1.75-1.75z"></path></svg><span class="ck ck-tooltip ck-tooltip_s"><span class="ck ck-tooltip__text">Bulleted List</span></span><span class="ck ck-button__label" id="ck-editor__aria-label_e3f6f236207db30607b08c43fcac9a7ba">Bulleted List</span></button><button class="ck ck-button ck-off" type="button" tabindex="-1" aria-labelledby="ck-editor__aria-label_ea3bfdcd58028e32afcf55c0175515a91" aria-pressed="false"><svg class="ck ck-icon ck-button__icon" viewBox="0 0 20 20"><path d="M7 5.75c0 .414.336.75.75.75h9.5a.75.75 0 1 0 0-1.5h-9.5a.75.75 0 0 0-.75.75zM3.5 3v5H2V3.7H1v-1h2.5V3zM.343 17.857l2.59-3.257H2.92a.6.6 0 1 0-1.04 0H.302a2 2 0 1 1 3.995 0h-.001c-.048.405-.16.734-.333.988-.175.254-.59.692-1.244 1.312H4.3v1h-4l.043-.043zM7 14.75a.75.75 0 0 1 .75-.75h9.5a.75.75 0 1 1 0 1.5h-9.5a.75.75 0 0 1-.75-.75z"></path></svg><span class="ck ck-tooltip ck-tooltip_s"><span class="ck ck-tooltip__text">Numbered List</span></span><span class="ck ck-button__label" id="ck-editor__aria-label_ea3bfdcd58028e32afcf55c0175515a91">Numbered List</span></button><span class="ck ck-toolbar__separator"></span><button class="ck ck-button ck-disabled ck-off" type="button" tabindex="-1" aria-labelledby="ck-editor__aria-label_ec2ff879df34bdca2538dc596acf35fe2" aria-disabled="true"><svg class="ck ck-icon ck-button__icon" viewBox="0 0 20 20"><path d="M2 3.75c0 .414.336.75.75.75h14.5a.75.75 0 1 0 0-1.5H2.75a.75.75 0 0 0-.75.75zm5 6c0 .414.336.75.75.75h9.5a.75.75 0 1 0 0-1.5h-9.5a.75.75 0 0 0-.75.75zM2.75 16.5h14.5a.75.75 0 1 0 0-1.5H2.75a.75.75 0 1 0 0 1.5zm1.618-9.55L.98 9.358a.4.4 0 0 0 .013.661l3.39 2.207A.4.4 0 0 0 5 11.892V7.275a.4.4 0 0 0-.632-.326z"></path></svg><span class="ck ck-tooltip ck-tooltip_s"><span class="ck ck-tooltip__text">Decrease indent</span></span><span class="ck ck-button__label" id="ck-editor__aria-label_ec2ff879df34bdca2538dc596acf35fe2">Decrease indent</span></button><button class="ck ck-button ck-disabled ck-off" type="button" tabindex="-1" aria-labelledby="ck-editor__aria-label_e8a1eac185ac539503d8d53d602b04f87" aria-disabled="true"><svg class="ck ck-icon ck-button__icon" viewBox="0 0 20 20"><path d="M2 3.75c0 .414.336.75.75.75h14.5a.75.75 0 1 0 0-1.5H2.75a.75.75 0 0 0-.75.75zm5 6c0 .414.336.75.75.75h9.5a.75.75 0 1 0 0-1.5h-9.5a.75.75 0 0 0-.75.75zM2.75 16.5h14.5a.75.75 0 1 0 0-1.5H2.75a.75.75 0 1 0 0 1.5zM1.632 6.95 5.02 9.358a.4.4 0 0 1-.013.661l-3.39 2.207A.4.4 0 0 1 1 11.892V7.275a.4.4 0 0 1 .632-.326z"></path></svg><span class="ck ck-tooltip ck-tooltip_s"><span class="ck ck-tooltip__text">Increase indent</span></span><span class="ck ck-button__label" id="ck-editor__aria-label_e8a1eac185ac539503d8d53d602b04f87">Increase indent</span></button><span class="ck ck-toolbar__separator"></span><span class="ck-file-dialog-button"><button class="ck ck-button ck-off" type="button" tabindex="-1" aria-labelledby="ck-editor__aria-label_e3417123d841794221ffb6b90bc7ccfec"><svg class="ck ck-icon ck-button__icon" viewBox="0 0 20 20"><path d="M6.91 10.54c.26-.23.64-.21.88.03l3.36 3.14 2.23-2.06a.64.64 0 0 1 .87 0l2.52 2.97V4.5H3.2v10.12l3.71-4.08zm10.27-7.51c.6 0 1.09.47 1.09 1.05v11.84c0 .59-.49 1.06-1.09 1.06H2.79c-.6 0-1.09-.47-1.09-1.06V4.08c0-.58.49-1.05 1.1-1.05h14.38zm-5.22 5.56a1.96 1.96 0 1 1 3.4-1.96 1.96 1.96 0 0 1-3.4 1.96z"></path></svg><span class="ck ck-tooltip ck-tooltip_s"><span class="ck ck-tooltip__text">Insert image</span></span><span class="ck ck-button__label" id="ck-editor__aria-label_e3417123d841794221ffb6b90bc7ccfec">Insert image</span></button><input class="ck-hidden" type="file" tabindex="-1" accept="image/jpeg,image/png,image/gif,image/bmp,image/webp,image/tiff" multiple="true"></span><button class="ck ck-button ck-off" type="button" tabindex="-1" aria-labelledby="ck-editor__aria-label_e321ac6d13117c71149f085e46c352343" aria-pressed="false"><svg class="ck ck-icon ck-button__icon" viewBox="0 0 20 20"><path d="M3 10.423a6.5 6.5 0 0 1 6.056-6.408l.038.67C6.448 5.423 5.354 7.663 5.22 10H9c.552 0 .5.432.5.986v4.511c0 .554-.448.503-1 .503h-5c-.552 0-.5-.449-.5-1.003v-4.574zm8 0a6.5 6.5 0 0 1 6.056-6.408l.038.67c-2.646.739-3.74 2.979-3.873 5.315H17c.552 0 .5.432.5.986v4.511c0 .554-.448.503-1 .503h-5c-.552 0-.5-.449-.5-1.003v-4.574z"></path></svg><span class="ck ck-tooltip ck-tooltip_s"><span class="ck ck-tooltip__text">Block quote</span></span><span class="ck ck-button__label" id="ck-editor__aria-label_e321ac6d13117c71149f085e46c352343">Block quote</span></button><div class="ck ck-dropdown"><button class="ck ck-button ck-off ck-dropdown__button" type="button" tabindex="-1" aria-labelledby="ck-editor__aria-label_e5b05b3e29ab423ed0c738689dcfdcb8a" aria-haspopup="true"><svg class="ck ck-icon ck-button__icon" viewBox="0 0 20 20"><path d="M3 6v3h4V6H3zm0 4v3h4v-3H3zm0 4v3h4v-3H3zm5 3h4v-3H8v3zm5 0h4v-3h-4v3zm4-4v-3h-4v3h4zm0-4V6h-4v3h4zm1.5 8a1.5 1.5 0 0 1-1.5 1.5H3A1.5 1.5 0 0 1 1.5 17V4c.222-.863 1.068-1.5 2-1.5h13c.932 0 1.778.637 2 1.5v13zM12 13v-3H8v3h4zm0-4V6H8v3h4z"></path></svg><span class="ck ck-tooltip ck-tooltip_s"><span class="ck ck-tooltip__text">Insert table</span></span><span class="ck ck-button__label" id="ck-editor__aria-label_e5b05b3e29ab423ed0c738689dcfdcb8a">Insert table</span><svg class="ck ck-icon ck-dropdown__arrow" viewBox="0 0 10 10"><path d="M.941 4.523a.75.75 0 1 1 1.06-1.06l3.006 3.005 3.005-3.005a.75.75 0 1 1 1.06 1.06l-3.549 3.55a.75.75 0 0 1-1.168-.136L.941 4.523z"></path></svg></button><div class="ck ck-reset ck-dropdown__panel ck-dropdown__panel_se"></div></div><div class="ck ck-dropdown"><button class="ck ck-button ck-off ck-dropdown__button" type="button" tabindex="-1" aria-labelledby="ck-editor__aria-label_e3a07c15d10d2deeeba7e0aeeed1d1ff6" aria-haspopup="true"><svg class="ck ck-icon ck-button__icon" viewBox="0 0 20 20"><path d="M18.68 3.03c.6 0 .59-.03.59.55v12.84c0 .59.01.56-.59.56H1.29c-.6 0-.59.03-.59-.56V3.58c0-.58-.01-.55.6-.55h17.38zM15.77 15V5H4.2v10h11.57zM2 4v1h1V4H2zm0 2v1h1V6H2zm0 2v1h1V8H2zm0 2v1h1v-1H2zm0 2v1h1v-1H2zm0 2v1h1v-1H2zM17 4v1h1V4h-1zm0 2v1h1V6h-1zm0 2v1h1V8h-1zm0 2v1h1v-1h-1zm0 2v1h1v-1h-1zm0 2v1h1v-1h-1zM7.5 7.177a.4.4 0 0 1 .593-.351l5.133 2.824a.4.4 0 0 1 0 .7l-5.133 2.824a.4.4 0 0 1-.593-.35V7.176v.001z"></path></svg><span class="ck ck-tooltip ck-tooltip_s"><span class="ck ck-tooltip__text">Insert media</span></span><span class="ck ck-button__label" id="ck-editor__aria-label_e3a07c15d10d2deeeba7e0aeeed1d1ff6">Insert media</span><svg class="ck ck-icon ck-dropdown__arrow" viewBox="0 0 10 10"><path d="M.941 4.523a.75.75 0 1 1 1.06-1.06l3.006 3.005 3.005-3.005a.75.75 0 1 1 1.06 1.06l-3.549 3.55a.75.75 0 0 1-1.168-.136L.941 4.523z"></path></svg></button><div class="ck ck-reset ck-dropdown__panel ck-dropdown__panel_se"><form class="ck ck-media-form ck-responsive-form" tabindex="-1"><div class="ck ck-labeled-field-view ck-labeled-field-view_empty"><div class="ck ck-labeled-field-view__input-wrapper"><input type="text" class="ck ck-input ck-input-text ck-input-text_empty" id="ck-labeled-field-view-ebf46fbb2953b26837e1fa28e7ba161b0" aria-describedby="ck-labeled-field-view-status-eb33e32672371be462d5a01378a0f8eb4"><label class="ck ck-label" id="ck-editor__label_ed8ba372c8ce226dfaf919f247b914946" for="ck-labeled-field-view-ebf46fbb2953b26837e1fa28e7ba161b0">Media URL</label></div><div class="ck ck-labeled-field-view__status" id="ck-labeled-field-view-status-eb33e32672371be462d5a01378a0f8eb4">Paste the media URL in the input.</div></div><button class="ck ck-button ck-disabled ck-off ck-button-save" type="submit" tabindex="-1" aria-labelledby="ck-editor__aria-label_ed794914082e576040853f51da4deac4b" aria-disabled="true"><svg class="ck ck-icon ck-button__icon" viewBox="0 0 20 20"><path d="M6.972 16.615a.997.997 0 0 1-.744-.292l-4.596-4.596a1 1 0 1 1 1.414-1.414l3.926 3.926 9.937-9.937a1 1 0 0 1 1.414 1.415L7.717 16.323a.997.997 0 0 1-.745.292z"></path></svg><span class="ck ck-tooltip ck-tooltip_s"><span class="ck ck-tooltip__text">Save</span></span><span class="ck ck-button__label" id="ck-editor__aria-label_ed794914082e576040853f51da4deac4b">Save</span></button><button class="ck ck-button ck-off ck-button-cancel" type="button" tabindex="-1" aria-labelledby="ck-editor__aria-label_ed87d4c978179b5b82306073e3ddf6318"><svg class="ck ck-icon ck-button__icon" viewBox="0 0 20 20"><path d="m11.591 10.177 4.243 4.242a1 1 0 0 1-1.415 1.415l-4.242-4.243-4.243 4.243a1 1 0 0 1-1.414-1.415l4.243-4.242L4.52 5.934A1 1 0 0 1 5.934 4.52l4.243 4.243 4.242-4.243a1 1 0 1 1 1.415 1.414l-4.243 4.243z"></path></svg><span class="ck ck-tooltip ck-tooltip_s"><span class="ck ck-tooltip__text">Cancel</span></span><span class="ck ck-button__label" id="ck-editor__aria-label_ed87d4c978179b5b82306073e3ddf6318">Cancel</span></button></form></div></div><button class="ck ck-button ck-disabled ck-off" type="button" tabindex="-1" aria-labelledby="ck-editor__aria-label_e7c10d18c4136576f135b186a7c3f01bb" aria-disabled="true"><svg class="ck ck-icon ck-button__icon" viewBox="0 0 20 20"><path d="m5.042 9.367 2.189 1.837a.75.75 0 0 1-.965 1.149l-3.788-3.18a.747.747 0 0 1-.21-.284.75.75 0 0 1 .17-.945L6.23 4.762a.75.75 0 1 1 .964 1.15L4.863 7.866h8.917A.75.75 0 0 1 14 7.9a4 4 0 1 1-1.477 7.718l.344-1.489a2.5 2.5 0 1 0 1.094-4.73l.008-.032H5.042z"></path></svg><span class="ck ck-tooltip ck-tooltip_s"><span class="ck ck-tooltip__text">Undo (Ctrl+Z)</span></span><span class="ck ck-button__label" id="ck-editor__aria-label_e7c10d18c4136576f135b186a7c3f01bb">Undo</span></button><button class="ck ck-button ck-disabled ck-off" type="button" tabindex="-1" aria-labelledby="ck-editor__aria-label_e949271fdb57672f2df64aa604d5a4cb4" aria-disabled="true"><svg class="ck ck-icon ck-button__icon" viewBox="0 0 20 20"><path d="m14.958 9.367-2.189 1.837a.75.75 0 0 0 .965 1.149l3.788-3.18a.747.747 0 0 0 .21-.284.75.75 0 0 0-.17-.945L13.77 4.762a.75.75 0 1 0-.964 1.15l2.331 1.955H6.22A.75.75 0 0 0 6 7.9a4 4 0 1 0 1.477 7.718l-.344-1.489A2.5 2.5 0 1 1 6.039 9.4l-.008-.032h8.927z"></path></svg><span class="ck ck-tooltip ck-tooltip_s"><span class="ck ck-tooltip__text">Redo (Ctrl+Y)</span></span><span class="ck ck-button__label" id="ck-editor__aria-label_e949271fdb57672f2df64aa604d5a4cb4">Redo</span></button></div></div></div></div></div><div class="ck ck-editor__main" role="presentation"><div class="ck-blurred ck ck-content ck-editor__editable ck-rounded-corners ck-editor__editable_inline" lang="en" dir="ltr" role="textbox" aria-label="Rich Text Editor, main" contenteditable="true"><p><br data-cke-filler="true"></p></div></div></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="card-header-2">
                                    <h5>Product Images</h5>
                                </div>

                                <form class="theme-form theme-form-2 mega-form">
                                    <div class="mb-4 row align-items-center">
                                        <label class="col-sm-3 col-form-label form-label-title">Images</label>
                                        <div class="col-sm-9">
                                            <input class="form-control form-choose" type="file" id="formFile" multiple="">
                                        </div>
                                    </div>

                                    <div class="row align-items-center">
                                        <label class="col-sm-3 col-form-label form-label-title">Thumbnail
                                            Image</label>
                                        <div class="col-sm-9">
                                            <input class="form-control form-choose" type="file" id="formFileMultiple1" multiple="">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="card-header-2">
                                    <h5>Product Videos</h5>
                                </div>

                                <form class="theme-form theme-form-2 mega-form">
                                    <div class="mb-4 row align-items-center">
                                        <label class="col-sm-3 col-form-label form-label-title">Video
                                            Provider</label>
                                        <div class="col-sm-9">
                                            <select class="js-example-basic-single w-100 select2-hidden-accessible" name="state" data-select2-id="select2-data-16-l2ex" tabindex="-1" aria-hidden="true">
                                                <option data-select2-id="select2-data-18-wqbi">Vimeo</option>
                                                <option>Youtube</option>
                                                <option>Dailymotion</option>
                                                <option>Vimeo</option>
                                            </select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="select2-data-17-6bbn" style="width: 740.484px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-state-n4-container" aria-controls="select2-state-n4-container"><span class="select2-selection__rendered" id="select2-state-n4-container" role="textbox" aria-readonly="true" title="Vimeo">Vimeo</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                                        </div>
                                    </div>

                                    <div class="row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Video
                                            Link</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text" placeholder="Video Link">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="card-header-2">
                                    <h5>Product variations</h5>
                                </div>

                                <form class="theme-form theme-form-2 mega-form">
                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Option
                                            Name</label>
                                        <div class="col-sm-9">
                                            <select class="js-example-basic-single w-100 select2-hidden-accessible" name="state" data-select2-id="select2-data-19-7cmu" tabindex="-1" aria-hidden="true">
                                                <option data-select2-id="select2-data-21-rnh9">Color</option>
                                                <option>Size</option>
                                                <option>Material</option>
                                                <option>Style</option>
                                            </select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="select2-data-20-ubyc" style="width: 740.484px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-state-oi-container" aria-controls="select2-state-oi-container"><span class="select2-selection__rendered" id="select2-state-oi-container" role="textbox" aria-readonly="true" title="Color">Color</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                                        </div>
                                    </div>

                                    <div class="row align-items-center">
                                        <label class="col-sm-3 col-form-label form-label-title">Option
                                            Value</label>
                                        <div class="col-sm-9">
                                            <div class="bs-example">
                                                <div class="bootstrap-tagsinput"><input type="text" placeholder="Type tag &amp; hit enter"></div><input type="text" class="form-control" placeholder="Type tag &amp; hit enter" id="#inputTag" data-role="tagsinput" style="display: none;">
                                            </div>
                                        </div>
                                    </div>
                                </form>

                                <a href="#" class="add-option"><i class="ri-add-line me-2"></i> Add Another
                                    Option</a>
                            </div>
                        </div>


                        <div class="card">
                            <div class="card-body">
                                <div class="card-header-2">
                                    <h5>Product Price</h5>
                                </div>

                                <form class="theme-form theme-form-2 mega-form">
                                    <div class="mb-4 row align-items-center">
                                        <label class="col-sm-3 form-label-title">price</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="number" placeholder="0">
                                        </div>
                                    </div>
                                    <div class="mb-4 row align-items-center">
                                        <label class="col-sm-3 form-label-title">Compare at
                                            price</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="number" placeholder="0">
                                        </div>
                                    </div>
                                    <div class="mb-4 row align-items-center">
                                        <label class="col-sm-3 form-label-title">Cost per item</label>
                                        <div class="col-sm-5">
                                            <input class="form-control" type="number" placeholder="0">
                                        </div>
                                        <div class="col-sm-2">
                                            <label>Margin:</label>
                                            <span>25%</span>
                                        </div>
                                        <div class="col-sm-2">
                                            <label>Profit:</label>
                                            <span>$5</span>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        let defaultPreview = function(event){
            let files = event.target.files[0];
            let url = URL.createObjectURL(files);
            let prevw = `<img style="width: 12rem; height: 12rem; border-radius: 0.6rem;" src="${url}">`;
            $('#defaultImageContainer').append(prevw);
        }
    </script>
@endsection