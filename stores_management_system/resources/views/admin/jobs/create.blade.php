@extends('layouts.admin')

@section('title', 'Create Job')

@section('content')

    <h1 class="mt-4">Create Job</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('admin.jobs.index') }}">Jobs</a></li>
        <li class="breadcrumb-item active">Create</li>
    </ol>

    <div class="container mt-4">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <form method="POST" action="{{ route('admin.jobs.store') }}" class="create-job-form">
                    @csrf

                    <div class="mb-3">
                        <label for="asset_code" class="form-label">Asset Code</label>
                        <div class="d-flex gap-2">
                            <input type="text" class="form-control" id="asset_code" name="asset_code" required>
                            <button type="button" onclick="startScanner()" class="btn btn-secondary btn-sm">Scan QR</button>
                        </div>
                        <div id="qr-reader" style="width:300px; display:none; margin-top:10px;"></div>
                    </div>

                    <div class="mb-3">
                        <label for="job_description" class="form-label">Fault Description</label>
                        <input type="text" class="form-control" id="job_description" name="job_description" required>
                    </div>

                    <div class="mb-3">
                        <label for="division" class="form-label">Division</label>
                        <input type="text" class="form-control" id="division" name="division" required>
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">Name / EPF</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>

                    <div class="mb-3">
                        <label for="contact" class="form-label">Contact</label>
                        <input type="text" class="form-control" id="contact" name="contact" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Save Job</button>
                </form>
            </div>
        </div>
    </div>

@endsection

{{-- Scripts --}}
@section('scripts')
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    <script>
        // Utility to detect if scanned result is a URL
        function isURL(value) {
            const pattern = new RegExp('^(https?:\\/\\/)', 'i');
            return pattern.test(value);
        }

        // Main QR scanner function
        function startScanner() {
            const qrReader = document.getElementById('qr-reader');
            qrReader.style.display = 'block';

            // Prevent multiple instances of the scanner
            if (!window.html5QrCode) {
                window.html5QrCode = new Html5Qrcode("qr-reader");
            }

            Html5Qrcode.getCameras().then(cameras => {
                if (cameras && cameras.length) {
                    window.html5QrCode.start(
                        cameras[0].id,
                        { fps: 10, qrbox: 250 },
                        qrCodeMessage => {
                            if (isURL(qrCodeMessage)) {
                                alert("❌ This QR code contains a link. Please scan a valid asset code.");
                            } else {
                                document.getElementById('asset_code').value = qrCodeMessage;
                            }

                            // Stop the scanner after scanning
                            window.html5QrCode.stop();
                            qrReader.style.display = 'none';
                        },
                        errorMessage => {
                            // Optional: console.log(errorMessage);
                        }
                    );
                }
            }).catch(err => {
                alert("❌ Camera not found or access denied.");
            });
        }
    </script>
@endsection


<style>
    .create-job-form .form-label {
        font-weight: 600;
    }

    .create-job-form input[type="text"] {
        padding: 10px;
        font-size: 15px;
    }

    .create-job-form .btn-primary {
        padding: 8px 20px;
        font-size: 16px;
        border-radius: 5px;
    }

    .create-job-form .btn-primary:hover {
        background-color: #0056b3;
    }

    .card {
        border-radius: 8px;
    }

    .breadcrumb {
        background: none;
        padding-left: 0;
    }
</style>
