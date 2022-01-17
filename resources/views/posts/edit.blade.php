@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-header">
                        Edit Post
                    </div>

                    <div class="card-body">
                        <form action="{{ route('post.update', $post->id) }}" id="postUpdateForm" method="post">
                            @csrf
                            @method('put')
                        </form>

                        <div class="mb-3">
                            <lable class="form-label">Post Title</lable>
                            <input type="text" class="form-control @error('title')
                                is-invalid
                            @enderror" form="postUpdateForm" name="title" value="{{ old('title', $post->title) }}">
                            @error('title')
                                <span class="small text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Category --}}
                        <div class="mb-3">
                            <label for="" class="form-label">Select Category</label>
                            <select class="form-select @error('category') is-invalid @enderror" form="postUpdateForm" name="category">
                                @foreach(\App\Models\Category::all() as $category)
                                    <option value="{{ $category->id }}" {{ $category->id == old('category',$post->category_id) ? 'selected' : '' }}>{{ $category->title }}</option>
                                @endforeach
                            </select>
                            @error('category')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>

                          {{-- Tag --}}
                          <div class="mb-4">
                            <label for="" class="form-label">Select Tags</label>
                            <br>
                            @foreach (\App\Models\Tag::all() as $tag)
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" value="{{ $tag->id }}" name="tags[]" form="postUpdateForm" id="tag{{ $tag->id }}"  {{ in_array($tag->id, old('tags', $post->tags->pluck('id')->toArray())) ? "checked" : "" }}>
                                <label class="form-check-label" for="tag{{ $tag->id }}">
                                  {{ $tag->title }}
                                </label>
                            </div>
                            @endforeach

                            <br>

                            @error('tags')
                                <span class="small text-danger">{{ $message }}</span>
                            @enderror
                            @error('tags.*')
                                <span class="small text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Select Photo --}}
                        <div class="mb-3">
                            <div class="form-label">Select Photo</div>
                            <div class="border rounded p-2 d-flex" style="overflow-x: scroll">

                                <form action="{{ route('photo.store') }}" class="d-none" id="photoUploadForm" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="post_id" value="{{ $post->id }}"">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Select Photo</label>
                                        <input type="file" class="form-control @error('photos')
                                            is-invalid
                                        @enderror" id="photoInput" name="photos[]" multiple>
                                        @error('photos')
                                            <p class="text-danger small">{{ $message }}</p>
                                        @enderror
                                        @error('photos.*')
                                            <p class="text-danger small">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <button>Upload Photo</button>
                                </form>

                                <div class="border border-2 border-dark rounded-3 me-1 uploader-ui d-flex justify-content-center align-items-center px-3" id="photoUploadUi">
                                    <i class="fas fa-plus fa-2x"></i>
                                </div>

                                @forelse ($post->photos as $photo)
                                <div class="position-relative">
                                    <form action="{{ route('photo.destroy', $photo->id) }}" method="POST" class="position-absolute bottom-0">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash-alt fa-fw"></i>
                                        </button>
                                    </form>
                                    <a class="venobox" data-gall="img{{ $post->id }}" href="{{ asset('storage/photo/'.$photo->name) }}">
                                        <img src="{{ asset('storage/thumbnail/'.$photo->name) }}" class="me-2 rounded-3 shadow-sm" height="100" alt="image alt"/>
                                     </a>
                                </div>
                                @empty
                                 <p class="text-muted ms-2 py-4">No Photo</p>
                                @endforelse
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Post Description</label>
                            <textarea type="text" rows="10" form="postUpdateForm" class="form-control @error('description') is-invalid @enderror" name="description"> {{ old('description', $post->description) }}</textarea>
                            @error('description')
                                <span class="samll text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-5">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" form="postUpdateForm" required>
                                <label class="form-check-label" for="flexSwitchCheckDefault">Confirm</label>
                            </div>
                            <button form="postUpdateForm" class="btn btn-lg btn-primary">Update Post</button>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>

        let photoUploadForm = document.getElementById('photoUploadForm');
        let photoInput = document.getElementById('photoInput');
        let photoUploadUi = document.getElementById('photoUploadUi');

        photoUploadUi.addEventListener('click',function (){
            photoInput.click();
            console.log('click add ui')
        })

        photoInput.addEventListener('change',function (){
            photoUploadForm.submit();
        })
    </script>
@endsection
