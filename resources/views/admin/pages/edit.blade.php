@extends('layouts.admin')

@section('content')

<h2>Edit Page</h2>

<form method="POST"
    action="{{ route('admin.pages.update',$page->id) }}"
    enctype="multipart/form-data">

    @csrf
    @method('PUT')


    {{-- TITLE --}}

    <div class="mb-3">

        <label>Title</label>

        <input type="text"
            name="title"
            value="{{ $page->title }}"
            class="form-control">

    </div>



    {{-- DESCRIPTION --}}

    <div class="mb-3">

        <label>Description</label>

        <textarea name="description"
            id="editor"
            class="form-control">

        {{ $page->description }}

        </textarea>

    </div>

    <div class="mb-3">

        <label class="form-label">Other Description *</label>

        <textarea name="other_description"
            id="editor1"
            class="form-control"
            rows="6">{{ $page->other_description }}</textarea>

    </div>

    {{-- IMAGE --}}

    <div class="mb-3">

        <label>Image</label>

        <br>

        @if($page->image)

        <img src="{{ asset('storage/'.$page->image) }}"
            width="150">

        <br><br>

        @endif


        <input type="file" name="image">

    </div>



    {{-- SEO TITLE --}}

    <div class="mb-3">

        <label>SEO Title</label>

        <input type="text"
            name="seo_title"
            value="{{ $page->seo_title }}"
            class="form-control">

    </div>



    {{-- SEO DESCRIPTION --}}

    <div class="mb-3">

        <label>SEO Description</label>

        <textarea name="seo_description"
            class="form-control">

        {{ $page->seo_description }}

        </textarea>

    </div>



    {{-- SEO KEYWORDS --}}

    <div class="mb-3">

        <label>SEO Keywords</label>

        <input type="text"
            name="seo_keywords"
            value="{{ $page->seo_keywords }}"
            class="form-control">

    </div>



    {{-- SEO IMAGE --}}

    <div class="mb-3">

        <label>SEO Image</label>

        <br>

        @if($page->seo_image)

        <img src="{{ asset('storage/'.$page->seo_image) }}"
            width="150">

        <br><br>

        @endif

        <input type="file" name="seo_image">

    </div>

    <div class="mb-3">
        <label>Additional Image (Optional)</label>
        <input type="file" name="additional_image" class="form-control">
    </div>
    @if($page->additional_image)
    <img src="{{ asset('storage/'.$page->additional_image) }}" width="120">
    @endif
    {{-- STATUS --}}

    <div class="mb-3">

        <label>Status</label>

        <select name="status"
            class="form-control">

            <option value="1"
                {{ $page->status==1 ? 'selected':'' }}>
                Active
            </option>

            <option value="0"
                {{ $page->status==0 ? 'selected':'' }}>
                Inactive
            </option>

        </select>

    </div>



    <button class="btn btn-success">

        Update Page

    </button>


</form>



{{-- CKEDITOR --}}

<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>

<script>
    CKEDITOR.replace('editor');
    CKEDITOR.replace('editor1');
</script>



@endsection