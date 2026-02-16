@extends('layouts.admin')

@section('title','Add Page')

@section('content')
<div class="container-fluid">

    <div class="card shadow">

        <div class="card-header bg-primary text-white">

            <h4 class="mb-0">Add Page</h4>

        </div>


        <div class="card-body">

            <form action="{{ route('admin.pages.store') }}"
                method="POST"
                enctype="multipart/form-data">

                @csrf


                {{-- TITLE --}}

                <div class="mb-3">

                    <label class="form-label">Title *</label>

                    <input type="text"
                        name="title"
                        class="form-control"
                        value="{{ old('title') }}">

                    @error('title')

                    <span class="text-danger">{{ $message }}</span>

                    @enderror

                </div>



                {{-- DESCRIPTION --}}

                <div class="mb-3">

                    <label class="form-label">Description *</label>

                    <textarea name="description"
                        id="editor"
                        class="form-control"
                        rows="6">{{ old('description') }}</textarea>

                </div>



                {{-- IMAGE --}}

                <div class="mb-3">

                    <label class="form-label">Page Image</label>

                    <input type="file"
                        name="image"
                        class="form-control"
                        onchange="previewImage(event)">


                    <img id="preview"
                        style="margin-top:10px;
max-height:100px;
display:none;">

                </div>



                <hr>

                <h5 class="mb-3 text-primary">

                    SEO Settings

                </h5>



                {{-- SEO TITLE --}}

                <div class="mb-3">

                    <label class="form-label">

                        SEO Title

                    </label>

                    <input type="text"
                        name="seo_title"
                        class="form-control"
                        value="{{ old('seo_title') }}">

                </div>



                {{-- SEO DESCRIPTION --}}

                <div class="mb-3">

                    <label class="form-label">

                        SEO Description

                    </label>

                    <textarea name="seo_description"
                        class="form-control"
                        rows="3">{{ old('seo_description') }}</textarea>

                </div>



                {{-- SEO KEYWORDS --}}

                <div class="mb-3">

                    <label class="form-label">

                        SEO Keywords

                    </label>

                    <input type="text"
                        name="seo_keywords"
                        class="form-control"
                        value="{{ old('seo_keywords') }}">

                </div>



                {{-- SEO IMAGE --}}

                <div class="mb-3">

                    <label class="form-label">

                        SEO Image

                    </label>

                    <input type="file"
                        name="seo_image"
                        class="form-control">

                </div>

                <div class="mb-3">
                    <label>Additional Image (Optional)</label>
                    <input type="file" name="additional_image" class="form-control">
                </div>

                {{-- STATUS --}}

                <div class="mb-4">

                    <label class="form-label">

                        Status

                    </label>

                    <select name="status"
                        class="form-control">

                        <option value="1">Active</option>

                        <option value="0">Inactive</option>

                    </select>

                </div>



                {{-- BUTTON --}}

                <button type="submit"
                    class="btn btn-success">

                    Save Page

                </button>


                <a href="{{ route('admin.pages.index') }}"
                    class="btn btn-secondary">

                    Cancel

                </a>



            </form>

        </div>

    </div>

</div>



<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>

<script>
    CKEDITOR.replace('editor', {

        height: 300,

        allowedContent: true,

        extraAllowedContent: '*(*);*{*}',

        removeButtons: '',

        removePlugins: 'elementspath',

        resize_enabled: true

    });
    CKEDITOR.dtd.$removeEmpty['span'] = false;
</script>

@endsection