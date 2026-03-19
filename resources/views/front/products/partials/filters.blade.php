<form action="{{ $action }}" method="GET" class="row g-2 mb-4">
    <div class="col-lg-4 col-md-6">
        <input type="text" name="q" value="{{ request('q') }}" class="form-control" placeholder="Ürün ara...">
    </div>
    <div class="col-lg-3 col-md-6">
        <select name="category" class="form-control">
            <option value="">Tüm kategoriler</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->slug }}" @selected(request('category') === $cat->slug)>{{ $cat->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-lg-3 col-md-6">
        <select name="brand" class="form-control">
            <option value="">Tüm markalar</option>
            @foreach($brands as $brand)
                <option value="{{ $brand }}" @selected(request('brand') === $brand)>{{ $brand }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-lg-2 col-md-6 d-grid">
        <button class="btn-default">Filtrele</button>
    </div>
</form>

