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
                <div class="card hapus" id="gallery-card-{{ $gallery->id }}">
                    <div class="delete">
                        <span class="mdi--trash-outline" onclick="showPopup('{{ $gallery->id }}')"></span>
                    </div>
                    <img src="{{ asset('storage/' . $gallery->file_path) }}" alt="">
                    <div class="bottom">
                        {{ $gallery->keterangan }}
                    </div>
                </div>
                @endforeach
                
                <div id="popup" class="popup">
                    <p>Apakah anda yakin ingin menghapus gambar?</p>
                    <div class="tombol">
                        <a onclick="hidePopup()">Cancel</a>
                        <a onclick="confirmDelete()">Confirm</a>
                    </div>
                </div>
                <div id="popup-success" class="popup">
                    <p>Data berhasil di update</p>
                    <span class="qlementine-icons--success-16"></span>
                    <div class="tombol">
                        <a onclick="hidePopupSuccess()">OK</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var deleteGalleryId = null;

        // Menampilkan popup konfirmasi
        function showPopup(galleryId) {
            deleteGalleryId = galleryId; // Simpan ID gambar yang akan dihapus
            document.getElementById("popup").style.display = "block";
        }

        // Menyembunyikan popup
        function hidePopup() {
            document.getElementById("popup").style.display = "none";
        }

        // Menyembunyikan popup sukses
        function hidePopupSuccess() {
            document.getElementById("popup-success").style.display = "none";
        }

        // Konfirmasi hapus gambar
        function confirmDelete() {
            // Hapus gambar dengan menggunakan AJAX
            fetch(`/gallery/delete/${deleteGalleryId}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'  // Token CSRF Laravel
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Jika berhasil, sembunyikan popup konfirmasi dan tampilkan popup sukses
                    document.getElementById("popup").style.display = "none";
                    document.getElementById("popup-success").style.display = "block";
                    
                    // Hapus elemen gambar dari halaman
                    document.getElementById(`gallery-card-${deleteGalleryId}`).remove();
                } else {
                    alert('Gagal menghapus gambar!');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat menghapus gambar!');
            });
        }
    </script>
  </body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</html>