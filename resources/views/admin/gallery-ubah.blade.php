<!DOCTYPE html>
<html lang="en">
<head>  
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Nunito Sans' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/sidebar.css">
    <link rel="stylesheet" href="css/iconify.css">
    <link rel="stylesheet" href="css/gallery-ubah.css">
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
        <div class="buttons-gallery">
            <a href="">Add Image</a>
            <a href="{{ url('gallery-delete') }}">Delete Image</a>
        </div>
        <!-- Form Upload -->
        <form action="{{ route('gallery.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="upload-container" id="drop-zone">
                <div class="upload-icon">
                    <span class="line-md--upload-loop"></span>
                </div>
                <div class="text">
                    <label class="upload-text" for="file-upload">Click here</label> to upload or drop files here
                </div>
                <input type="file" id="file-upload" name="file" multiple class="hidden-input">
                <div class="preview-container" id="preview-container"></div>

              <!-- Popup Success -->
              <div id="popup-success" class="popup">
                  <p>Data berhasil di update</p>
                  <span style="margin-bottom: 40px;" class="qlementine-icons--success-16"></span>
                  <div class="tombol">
                      <a href="{{ url('gallery') }}" onclick="hidePopupSuccess()">OK</a>
                  </div>
              </div>
            </div>
            <label for="keterangan"> Tambah keterangan</label>
            <div class="input-group mb-3">
              <input type="text" name="keterangan" id="keterangan" class="form-control" placeholder="Enter some information" aria-label="User input" aria-describedby="button-addon2">
            </div>
            <div class="buttons-gallery bawah">
                <a href="{{ url('gallery') }}">Cancel</a>
                <button type="submit" class="btn btn-success" onclick="confirmUpdate()">Confirm</button>
            </div>
        </form>
    </div>
    <script>
        const dropZone = document.getElementById('drop-zone');
        const fileInput = document.getElementById('file-upload');
        const previewContainer = document.getElementById('preview-container');
    
        // Handle drag over
        dropZone.addEventListener('dragover', (event) => {
          event.preventDefault();
          dropZone.classList.add('dragover');
        });
    
        // Handle drag leave
        dropZone.addEventListener('dragleave', () => {
          dropZone.classList.remove('dragover');
        });
    
        // Handle drop
        dropZone.addEventListener('drop', (event) => {
          event.preventDefault();
          dropZone.classList.remove('dragover');
    
          const files = event.dataTransfer.files;
          displayFiles(files);
        });
    
        // Handle file input change
        fileInput.addEventListener('change', (event) => {
          const files = event.target.files;
          displayFiles(files);
        });
    
        // Function to display files
        function displayFiles(files) {
          previewContainer.innerHTML = ''; // Clear previous previews
    
          for (let i = 0; i < files.length; i++) {
            const file = files[i];
    
            // Create preview item
            const previewItem = document.createElement('div');
            previewItem.classList.add('file-preview');

            const fileIcon = document.createElement('div');
            fileIcon.classList.add('file-icon');

            // Membuat elemen <span> untuk ikon
            const iconSpan = document.createElement('span');
            iconSpan.classList.add('tdesign--image-filled');

            // Menambahkan <span> ke dalam fileIcon
            fileIcon.appendChild(iconSpan);

            // Menambahkan fileIcon ke previewItem
            previewItem.appendChild(fileIcon);

    
            // File name
            const fileName = document.createElement('span');
            fileName.classList.add('file-name');
            fileName.textContent = file.name;
    
            // File actions container
            const fileActions = document.createElement('div');
            fileActions.classList.add('file-actions');
    
            // Preview link
            const previewLink = document.createElement('span');
            previewLink.classList.add('preview-link');
            previewLink.textContent = 'Preview';
            previewLink.onclick = () => previewFile(file);
    
            // File size
            const fileSize = document.createElement('span');
            fileSize.classList.add('file-size');
            fileSize.textContent = `${(file.size / 1024 / 1024).toFixed(2)} MB`;
    
            // Remove link
            const removeFile = document.createElement('span');
            removeFile.classList.add('remove-file');
            removeFile.textContent = '✖';
            removeFile.onclick = () => previewItem.remove();
    
            // Append all elements to fileActions
            fileActions.appendChild(previewLink);
            fileActions.appendChild(fileSize);
            fileActions.appendChild(removeFile);
    
            // Append fileName and fileActions to previewItem
            previewItem.appendChild(fileName);
            previewItem.appendChild(fileActions);
    
            previewContainer.appendChild(previewItem);
          }
        }
    
        // Function to preview file (for images)
        function previewFile(file) {
          if (file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = (e) => {
              const imgWindow = window.open("");
              imgWindow.document.write(`<img src="${e.target.result}" style="max-width:100%;">`);
            };
            reader.readAsDataURL(file);
          } else {
            alert("Preview not available for this file type.");
          }
        }
    
        // Trigger file input when label is clicked
        dropZone.addEventListener('click', () => {
          fileInput.click();
        });
        // Menampilkan popup sukses setelah klik Confirm
function showPopup() {
    // Jika Anda ingin membuat pop-up konfirmasi untuk Cancel, Anda bisa menambahkan kode di sini.
    alert('Cancel clicked');
}

// Fungsi untuk konfirmasi update
function confirmUpdate() {
    // Menampilkan popup sukses setelah menekan confirm
    document.getElementById("popup-success").style.display = "block";
}

// Fungsi untuk menyembunyikan popup sukses
function hidePopupSuccess() {
    document.getElementById("popup-success").style.display = "none";
}

    </script>
  </body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</html>