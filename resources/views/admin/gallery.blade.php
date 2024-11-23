<!DOCTYPE html>
<html lang="en">
<head>  
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Nunito Sans' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/sidebar.css">
    <link rel="stylesheet" href="css/gallery.css">
    <link rel="stylesheet" href="css/iconify.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Dashboard</title>
</head>
<body>
<x-sidebar />
@yield('content')   
    <div class="content">
        <div class="top-content">
            <h1>Gallery</h1>
            <div class="user"></div>
        </div>
        <div class="kiri">
            <div class="gallery-card">
                @foreach($galleries as $gallery)
                <div class="card">
                    <!-- Menampilkan gambar -->
                    <img src="{{ asset('storage/' . $gallery->file_path) }}" alt="Gambar Gallery">
                    <!-- Menampilkan keterangan -->
                    <div class="bottom">
                        {{ $gallery->keterangan }}
                    </div>
                </div>
                @endforeach
            </div>
            <a href="{{ url('gallery-ubah') }}">Ubah Data</a>
        </div>
    </div>
  </body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</html>