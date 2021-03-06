<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <title>Edit Post</title>
</head>
<body>

    <section>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow mt-5">
                        <div class="card-header">
                           <h3 class="float-start">Edit Comment</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('comments.update', $data->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row my-3">
                                    <div class="col-md-3">
                                        <label class="col-form-label" for="title">Comment</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" value="{{ old('comment', $data->comment) }}" name="comment" id="comment" placeholder="Post Comment">
                                        @error('comment')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row my-3">
                                    <div class="col-md-3">
                                        <label class="col-form-label" for="comment">Post</label>
                                    </div>
                                    <div class="col-md-6">
                                        <select name="post_id" id="post_id" class="form-control">
                                            @foreach ($posts as $post)
                                                <option {{ $data->post_id == $post->id ? 'selected' : '' }} value="{{ $post->id }}">{{ $post->title }}</option>
                                            @endforeach
                                        </select>
                                        @error('post_id')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="my-3">
                                    <button type="submit" class="btn btn-primary float-end me-2">Submit</button>
                                    <a href="{{ route('comments.index') }}" class="me-2 btn btn-secondary float-end">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $('select').select2({
            maximumInputLength: 20
        });
    </script>
</body>
</html>