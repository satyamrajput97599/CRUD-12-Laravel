<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
  </head>
  <body>
    <div class="bg-dark text-center text-white py-3">
        <h1 class="h2">Laravel 12 CRUD</h1>
    </div>

    <div class="container">
        <div class="row">
            <div class="d-flex justify-content-end p-0 mt-3">
                <a href="{{ route('products.create') }}" class="btn btn-dark">Create</a>
            </div>

            @if (Session::has('success'))
               <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                    {{Session::get('success')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif

            @if (Session::has('error'))
               <div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
                    {{Session::get('error')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif

            <div class="card p-0 mt-3">
                <div class="card-header bg-dark text-white">
                    <h4 class="h4">Product</h4>
                </div>
                <div class="card-body shadow-lg">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>SKU</th>
                                <th>Price</th>
                                <th width="100">Status</th>
                                <th width="120" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($products->isNotEmpty())
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $product->id }}</td>
                                        <td>
                                            @if ($product->image)
                                                <img class="rounded" src="{{ asset('uploads/products/' . $product->image) }}" width="50" alt="">
                                            @else
                                                <img class="rounded" src="https://placehold.co/700x400" width="50" alt="">
                                            @endif
                                        </td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->sku }}</td>
                                        <td>${{ number_format($product->price, 2) }}</td>
                                        <td>
                                            @if ($product->status == 'Active')
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary btn-sm">Edit</a>

                                            <form action="{{ route('products.destroy', $product->id)}}" method="POST" class="d-inline" onsubmit="return confirm('Are You sure you want to delete this Products?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7" class="text-center">No Product Found</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
  </body>
</html>