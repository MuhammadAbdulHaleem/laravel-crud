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

    <div class="row d-flex justify-content-center mt-3">
        <div class="col-md-10 d-flex justify-content-end">
            <a href="{{route('products.create')}}" class="btn btn-dark">Create</a>
        </div>
    </div>

    <div class="row d-flex justify-content-center">
        @if (Session::has('success'))
            <div class="col-md-10 alert mt-3 alert-success">{{Session::get('success')}}</div>
        @endif
    </div>

    <div class="row d-flex justify-content-center">
        <div class="card col-md-10 mt-2 p-0">
            <h2 class="text-center  bg-dark text-white m-0 p-2">Products</h2>
            <div class="card-body">
                <table class="table">
                    <tr>
                        <th>ID</th>
                        <th></th>
                        <th>Name</th>
                        <th>SKU</th>
                        <th>Price</th>
                        <th>Created at</th>
                        <th>Actions</th>
                    </tr>
                    @if($products->isNotEmpty())
                    @foreach($products as $product)
                    <tr>
                        <td>{{$product->id}}</td>
                        <td>
                            @if($product->image != "")
                            <img width="50" src="{{asset('uploads/products/' . $product->image)}}" alt="">
                            @endif
                        </td>
                        <td>{{$product -> name }}</td>
                        <td>{{$product -> sku }}</td>
                        <td>${{$product -> price }}</td>
                        <td>{{ \carbon\carbon::parse($product->created_at)->format('d M, Y') }}</td>
                        <td>
                            <a href="{{route('products.edit', $product->id)}}" class = "btn btn-primary">Edit</a>
                            <a href="#" onclick="deleteProduct({{$product -> id}});" class = "btn btn-danger">Delete</a>
                            <form id="delete-product-from-{{$product -> id}}" action="{{route('products.destroy', $product->id)}}" method="post">
                                @csrf
                                @method('delete')
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    @endif
                </table>
            </div>
        </div>
    </div>


    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>

<script>
    function deleteProduct(id){
        if(confirm("Are you sure to delete this product")){
            document.getElementById('delete-product-from-'+id).submit();
        }
    }
</script>