<h2>Ini Halaman detail Produk</h2>  
    Nama Produk : <b>{{$product_name}}</b><br>
    id : <b>{{ $id }}</b><br>
    color : <b>{{ $color }}</b><br>
    Stock : <b>{{ $stock }}</b><br>

    <hr/>
    @for ($i = 0; $i < 5; $i++)
        Data {{ $i }} <br />
    @endfor