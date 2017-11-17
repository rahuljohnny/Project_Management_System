<div class="row container-fluid">

    <form method="POST" action="{{ route('comments.store') }}">
        {{csrf_field()}}

        <input type="hidden" name="commentable_type" value="App\Project">
        <input type="hidden" name="commentable_id" value="{{$project->id}}">


        <div class="form-group">
            <label for="comment-content"><h3>Comment</h3></label>
            <textarea placeholder="Enter description"
                      style="resize: vertical"
                      id="comment-content"
                      name="body"
                      rows="5" spellcheck="false"
                      class="form-control autosize-target text-left">
                    </textarea>

            <textarea placeholder="Enter Url or screenshots"
                      style="resize: horizontal"
                      id="comment-content"
                      name="url"
                      rows="2"  spellcheck="false"
                      class="form-control autosize-target text-left">

                    </textarea>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>

    {{--EOF Comment Form #############################################################################--}}

    {{--Uploaded Comments--}}

    @if($comments->first()) {{--If comment exists in this project--}}
        @include('partials.comments')
    @endif


</div>
