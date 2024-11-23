<!DOCTYPE html>
<html lang="en">
<head>  
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Nunito Sans' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/sidebar.css">
    <link rel="stylesheet" href="css/iconify.css">
    <link rel="stylesheet" href="css/dashboard.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Ubah Listrik</title>
</head>
<body>
    <x-sidebar />
    @yield('content')  
    <div class="content">
        <div class="top-content">
            <h1>Data Listrik</h1>
            <div class="user"></div>
        </div>
        <div class="tabelll">
            <div class="table-listrik" id="tabel">
                <h1>Fill manually to update data..</h1>
                <form id="dataForm" action="{{ route('ubah-listrik.store') }}" method="POST">
                @csrf
                <table class="table table-bordered">
                    <thead class="table text-center">
                        <tr style="background-color: #3498DB; color: white;">
                            <th>No</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Daya Listrik (V)</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody class="table text-center">
                        @foreach($dataListriks as $index => $data)
                        <tr class="{{ $index % 2 == 0 ? '' : 'table-secondary' }}">
                            <td>{{ $index + 1 }}</td>
                            <td><input type="date" name="data[{{ $index }}][date]" value="{{ $data->date }}"></td>
                            <td><input type="time" name="data[{{ $index }}][time]" value="{{ $data->time }}"></td>
                            <td><input type="text" name="data[{{ $index }}][daya_listrik]" value="{{ $data->daya_listrik }}"></td>
                            <td>
                                <select name="data[{{ $index }}][status]" class="form-control">
                                    <option value="Updated" {{ $data->status == 'Updated' ? 'selected' : '' }}>Updated</option>
                                    <option value="Not Updated" {{ $data->status == 'Not Updated' ? 'selected' : '' }}>Not Updated</option>
                                </select>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="buttons">
                    <a href="{{ url('datalistrik') }}">Cancel</a>
                    <button class="tompel" type="button" onclick="submitForm()">Confirm</button>
                </div>
                @if (session('success'))
                    <div id="popup-success" class="popup" style="display: block;">
                        <p>{{ session('success') }}</p>
                        <span class="qlementine-icons--success-16"></span>
                        <div class="tombol">
                            <a style="margin-top: 40px;" href="{{ url('ubah-listrik') }}" onclick="hidePopupSuccess()">OK</a>
                        </div>
                    </div>
                @endif
                </form>
            </div>
        </div>
    </div>
    <script>
        // Fungsi untuk mengirim form dan menampilkan loading spinner
        function submitForm() {
            // Menampilkan loading spinner
                document.getElementById("dataForm").submit();

            // Menampilkan popup sukses
            document.getElementById("popup-success").style.display = "block";
        }

        // Fungsi untuk menyembunyikan popup sukses
        function hidePopupSuccess() {
            document.getElementById("popup-success").style.display = "none";
        }
    </script>
  </body>
</html>
