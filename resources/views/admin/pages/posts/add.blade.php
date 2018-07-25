@extends('.admin.layouts.app')

@section('content')
    <div class="uk-flex uk-flex-center">
        <div class="uk-width-1-2@s uk-form-stacked uk-grid-small" uk-grid>
            @if($edit)
            <form action="/admin/posts/{{$post->id}}" method="POST" enctype="multipart/form-data">
            {{method_field('PATCH')}}
            @else
            <form action="/admin/posts" method="POST" enctype="multipart/form-data">
            @endif
                @csrf
                <div class="uk-grid">
                    <div class="uk-width-1-2@s">
                        <label class="uk-form-label" for="first-name">
                            Title
                        </label>
                        <div class="uk-form-controls">
                            <input
                                    class="uk-input"
                                    id="title"
                                    name="title"
                                    type="text"
                                    value="{{$edit?$post->title:''}}"
                                    placeholder="Title">
                        </div>
                    </div>
                    <div class="uk-width-1-2@s">
                        <label class="uk-form-label" for="last-name">
                            Tags
                        </label>
                        <div class="uk-form-controls">
                            <input
                                    class="uk-input"
                                    id="tags"
                                    name="tags"
                                    type="text"
                                    value="{{$edit?implode(',',$post->TagNames):''}}"
                                    placeholder="Separate tags by comma">
                        </div>
                        <p class="uk-text-bold uk-text-danger uk-text-right" style="font-size:12px;">Separate tags by ','(comma)</p>
                    </div>
                </div>
                <div class="uk-width-1-1@s">
                    <label class="uk-form-label" for="last-name">
                        Content
                    </label>
                    <div class="uk-form-controls">
                        <textarea
                                class="uk-textarea"
                                id="content"
                                name="content"
                                type="text"
                                style="min-height: 150px"
                                placeholder="Content">{{$edit?$post->content:''}}</textarea>
                    </div>
                </div>
                <div class="uk-grid uk-margin-top">
                    @if($edit)
                        @if(file_exists('storage/'.$post->image))
                            <div class="uk-width-1-4@s">
                                <img src="{{asset('storage/'.$post->image)}}">
                            </div>
                        @endif
                    @endif
                    <div class="uk-width-1-2@s">
                        <label class="uk-form-label" for="last-name">
                            Image
                        </label>
                        <div class="uk-form-controls">
                            <input type="file" name="image">
                        </div>
                        <p class="uk-text-bold uk-text-danger" style="font-size:12px;">Acceptable formats:'jpg', 'jpeg', 'png'</p>
                    </div>
                    <div class="{{$edit?'uk-width-1-4@s':'uk-width-1-2@s'}}">
                        <button type="submit" class="uk-button uk-button-primary uk-align-right uk-margin-top">
                            {{$edit?'Edit':'Create'}}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection