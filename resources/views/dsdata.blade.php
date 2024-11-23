<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Listrik</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        body {
            background-color: #f5f5f5;
            font-family: Arial, sans-serif;
        }
        .table-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .table th, .table td {
            text-align: center;
            vertical-align: middle;
        }
        .btn-primary {
            display: block;
            margin: 20px auto;
        }
    </style>
</head>
<body>
    <h1>Welcome to the DS Data Page</h1>
    <div class="table-container">
        <h3 class="text-center">Data Listrik</h3>
        
        <form id="dataForm" action="{{ route('data-listrik.store') }}" method="POST">
    @csrf
    <table class="table table-bordered">
        <thead>
            <tr class="bg-primary text-white">
                <th>No</th>
                <th>Date</th>
                <th>Time</th>
                <th>Daya Listrik</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dataListriks as $index => $data)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td><input type="date" name="data[{{ $index }}][date]" class="form-control" value="{{ $data->date }}"></td>
                <td><input type="time" name="data[{{ $index }}][time]" class="form-control" value="{{ $data->time }}"></td>
                <td><input type="text" name="data[{{ $index }}][daya_listrik]" class="form-control" value="{{ $data->daya_listrik }}"></td>
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
    <button type="submit" class="btn btn-primary">Simpan Data</button>
</form>

    </div>

    <!-- Modal Structure -->
    <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalLabel">Update Status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Data has been successfully updated!
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('dataForm').addEventListener('submit', function(e) {
            e.preventDefault(); // Prevent the default form submission

            // Simulate a form submission using AJAX (replace with your actual submission logic)
            $.ajax({
                url: this.action,
                method: this.method,
                data: $(this).serialize(),
                success: function(response) {
                    // Show the modal after successful submission
                    $('#updateModal').modal('show');
                },
                error: function(error) {
                    console.log("Error:", error);
                }
            });
        });
    </script>
</body>
</html>
