@extends('.admin.layouts.app')

@section('content')
    <div style="padding-bottom: 100px">
        <div class="uk-inline uk-width-1-1">
            <table class="uk-table uk-table-striped uk-table-divider uk-table-small uk-table-justify uk-table-middle">
                <thead>
                <tr>
                    <th class="uk-table-expand" style="width:200px;">Image</th>
                    <th class="uk-table-expand">Title</th>
                    <th class="uk-text-right">
                        <a href="/admin/posts/create"
                                class="uk-button uk-button-default uk-button-small"
                                type="button">Add
                        </a>
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($posts as $post)
                <tr>
                    <td>
                        @if(file_exists('storage/'.$post->image))
                            <div class="uk-width-1-4@s">
                                <img src="{{asset('storage/'.$post->image)}}">
                            </div>
                        @else
                            <span class="uk-label uk-label-warning">IMAGE MISSING</span>
                        @endif
                    </td>
                    <td>{{$post->title}}</td>
                    <td class="uk-table-middle uk-text-right">
                        <a href="/admin/posts/{{$post->id}}/edit"
                                class="uk-button uk-button-second uk-button-small"
                                type="button">Edit
                        </a>
                        <form action="/admin/posts/{{$post->id}}" method="POST" style="display:inline-block">
                            {{method_field('DELETE')}}
                            @csrf
                            <button
                                    class="uk-button uk-button-danger uk-button-small"
                                    type="submit">Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
            @if($posts->count()==0)
                <h3 style="color:red;text-align:center;margin-top:20%;">No posts found.</h3>
            @endif
        </div>
    </div>
@endsection