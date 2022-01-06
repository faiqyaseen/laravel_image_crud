<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Edit Post</title>
</head>
<body>

    <section>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow mt-5">
                        <div class="card-header">
                           <h3 class="float-start">Edit Post</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('posts.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row my-3">
                                    <div class="col-md-3">
                                        <label class="col-form-label" for="title">Post Title</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" value="{{ old('title', $data->title) }}" name="title" id="title" placeholder="Post Title">
                                        @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row my-3">
                                    <div class="col-md-3">
                                        <label class="col-form-label" for="description">Post Description</label>
                                    </div>
                                    <div class="col-md-6">
                                        <textarea name="description" id="description" cols="30" rows="5" class="form-control">{{ old('description', $data->description) }}</textarea>
                                        @error('description')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row my-3">
                                    <div class="col-md-3">
                                        <label class="col-form-label" for="image">Post Image</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="file" onchange="previewPostImage(this)" class="form-control" name="image" id="image" placeholder="Post Image">
                                        <img id="postImg" class="mt-2" style="max-height: 150px; max-width: 150px;">
                                    </div>
                                </div>
                                <hr>
                                <div class="row my-3">
                                    <div class="col-md-3">
                                        <label class="col-form-label" for="description">Previous Image</label>
                                    </div>
                                    <div class="col-md-6">
                                        <img class="mt-2" src="{{ asset('images/post/'.$data->image) }}" style="max-height: 150px; max-width: 150px;">
                                    </div>
                                </div>
                                <div class="my-3">
                                    <button type="submit" class="btn btn-primary float-end me-2">Submit</button>
                                    <a href="{{ route('posts.index') }}" class="me-2 btn btn-secondary float-end">Cancel</a>
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
    
    <script>
        function previewPostImage () {
            var post_file = $("#image").get(0).files[0];
            if (post_file) {
                var reader = new FileReader();
                reader.onload = function () {
                    $('#postImg').attr("src", reader.result);
                }

                reader.readAsDataURL(post_file);
            }
        }
    </script>
</body>
</html>