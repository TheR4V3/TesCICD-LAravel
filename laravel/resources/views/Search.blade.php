<!DOCTYPE html>
<html>

<head>
    <!--BOOTSTRAP 5--->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>Search Results</title>
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/search.css') }}">
    <link rel="stylesheet" href="./Dashboard.css">
    <link rel="stylesheet" href="./Component/NavBar.css">
</head>

<body>
    <!--NAVBAR-->
    @component('Component.Navbar')
    @endcomponent

    <!-- SEARCH BAR -->
    <div class="container mt-4">
        <form action="{{ route('artikel.search') }}" method="GET" class="d-flex">
            <input type="text" name="query" class="form-control me-2" placeholder="Search by Title" value="{{ request('query') }}">
            <button type="submit" class="btn btn-outline-success">Search</button>
        </form>
    </div>

    <!--SEARCH RESULTS CONTENT-->
    <div class="container" style="margin-top:50px;">
        @if(isset($prods) && count($prods) > 0)
            @foreach($prods as $d)
                <div class="card mt-5 mb-3">
                    <div class="row mb-2">
                        <div class="col-md-4">
                            <img src="{{ url('public/Image/'.$d->Image) }}" alt="Image" class="img-fluid">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                @if(session('username') == $d->Created_by || session('username') == 'ADMIN')
                                    @component('Component.CompTimeline', ['data' => $d, 'page' => 'artikel'])
                                    @endcomponent
                                @endif
                                <h5 class="card-title">{{ $d->Judul }}</h5>
                                <p class="card-text">{{ $d->Deskripsi }}</p>
                                <a href="/Artikel/{{ $d->id }}" class="btn btn-info">More</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <p>Hasil tidak ditemukan.</p>
        @endif
    </div>
</body>

<script src="/Default.js"></script>
<script>
    window.onload = function() {
        cekLogin();
        cekAdmin();
    };
</script>

</html>
