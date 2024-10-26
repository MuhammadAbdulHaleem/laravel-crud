<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <header>
        <nav class = "navbar bg-dark ">
            <h3 class="text-white w-100 text-center">Laravel Crud App</h3>
        </nav>
    </header>
    <div class="row d-flex justify-content-center my-3">
        <div class="col-md-5 d-flex justify-content-end">
            <a href="{{route('products.index')}}" class="btn btn-dark me-3">Back</a>
        </div>
    </div>
    <div class="container d-flex align-items-center justify-content-center">
        <div style="width:600px;" class="card p-3">
            <h2 class="text-center p-3">Create Product</h2>
            <form enctype="multipart/form-data" action="{{ route('products.store') }}" method="POST">
                @csrf
                <div class="pb-2 px-3">
                    <label class="form-label" for="name">Product Name</label>
                    <input class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}" type="text" id= "name" class = "name" name="name">
                    @error('name')
                        <p class="invalid-feedback">{{$message}}</p>
                    @enderror
                </div>
                <div class="pb-2 px-3">
                    <label class="form-label" for="sku">Product sku</label>
                    <input class="form-control @error('sku') is-invalid @enderror" value="{{old('sku')}}" type="text" id= "sku" class = "sku" name="sku">
                    @error('sku')
                        <p class="invalid-feedback">{{$message}}</p>
                    @enderror
                </div>
                <div class="pb-2 px-3">
                    <label class="form-label" for="price">Price</label>
                    <input class="form-control @error('price') is-invalid @enderror" value="{{old('price')}}" type="number" id= "price" class = "price" name="price">
                    @error('price')
                        <p class="invalid-feedback">{{$message}}</p>
                    @enderror
                </div>
                <div class="pb-2 px-3">
                    <label class="form-label" for="description">Price</label>
                    <textarea class="form-control" placeholder="Description" id="description" name="description" cols="30" rows="4"></textarea>
                </div>
                <div class="pb-3 px-3">
                    <label class="form-label" for="image">Image</label>
                    <input class="form-control" type="file" id= "image" class = "image" name="image">
                </div>
                <div class="text-center pb-2 px-3">
                    <button class="btn btn-primary w-100">Create</button>
                </div>
            </form>
        </div>
    </div>


    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>