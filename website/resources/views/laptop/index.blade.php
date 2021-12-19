@extends('template')

@section('content')
    <div class="row mt-5 mb-5">
        <div class="col-lg-12 margin-tb">
            <div class="float-left">
                <h2>Laptop</h2>
            </div>
            <div class="float-right">
                <a class="btn btn-success" href="{{ route('laptop.create') }}"> Input Laptop</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('succes'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th width="20px" class="text-center">No</th>
            <th>Brand</th>
            <th width="280px"class="text-center">Type</th>
            <th width="280px"class="text-center">Price</th>
            <th width="280px"class="text-center">Action</th>
        </tr>
        @foreach ($laptopCache as $laptopCaches)
        <tr>
            <td class="text-center">{{ ++$i }}</td>
            <td>{{ $laptopCaches['Brand'] }}</td>
            <td>{{ $laptopCaches['Type'] }}</td>
            <td>{{ $laptopCaches['Price'] }}</td>
            <td class="text-center">
                <form action="{{ route('laptop.destroy',$laptopCaches['id']) }}" method="POST">

                   <a class="btn btn-info btn-sm" href="{{ route('laptop.show',$laptopCaches['id']) }}">Show</a>

                    <a class="btn btn-primary btn-sm" href="{{ route('laptop.edit',$laptopCaches['id']) }}">Edit</a>

                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>

@endsection