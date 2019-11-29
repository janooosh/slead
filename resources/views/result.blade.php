<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Slead</title>
</head>

<body>
    
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Slead Scraper</h1>
                <form method="post" action="{{route('scrape')}}">
                    @csrf
                    <div class="form-group">
                        <label for="url">Enter a URL</label>
                        <input type="text" class="form-control" id="url" name="url" aria-describedby="urlHelp" placeholder="Enter a url" value="{{$url}}">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
    @include('messages')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-borderless">
                    <thead>
                        <tr>
                            <th scope="col">URL</th>
                            <th scope="col">Tagmanager</th>
                            <th scope="col">Google Analytics</th>
                            <th scope="col">FB Pixel</th>
                            <th scope="col">CMS</th>
                            <th scope="col">CMS version</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($scrapes as $scrape)
                        <tr>
                            <td>{{$scrape->url}}</td>
                            <td>{{$scrape->gtm?'Yes':'No'}}</td>
                            <td>{{$scrape->ganalytics?'Yes':'No'}}</td>
                            <td>{{$scrape->fb_pixel?'Yes':'No'}}</td>
                            <td>{{$scrape->cms}}</td>
                            <td>{{$scrape->cms_version}}</td>
                            <td><a href="{{route('inspect',$scrape->id)}}" role="button" class="btn btn-success btn-small">Inspect</a></td>
                            <td><a href="{{route('delete',$scrape->id)}}" role="button" class="btn btn-danger btn-small">Delete</a></td>
                        </tr>
                        @endforeach
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>