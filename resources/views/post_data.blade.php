@foreach ($posts as $post)
<div class="col-md-9">
    <div class="card my-3">
        <div class="card-header">
            <h3><a href="">{{ $post->title }}</a></h3>
        </div>
        <div class="card-body">
            <p id="post-{{ $post->id }}">{{ Str::limit($post->description, 60) }}</p>
            <div class="mb-2">
                <button id="btn-{{ $post->id }}" onclick="readMore('{{ $post->description }}', {{ $post->id }})" class="btn btn-sm btn-success">Read More</button>
            </div>
            <img class="post_img" src="{{ asset('images/post/' . $post->image) }}"  style="width: 100%;" alt="">
        </div>
    </div>
</div>
@endforeach