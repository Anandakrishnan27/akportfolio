<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>profolio contact details</title>
    <style>
        #contactTable {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        #contactTable th {
            background-color: #f2f2f2;
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        #contactTable td {
            padding: 12px;
            border: 1px solid #ddd;
        }

        #contactTable tbody tr:hover {
            background-color: #f1f8ff;
        }

        /* ===== ACTION BUTTONS ===== */
        .action-btn {
            margin: 0 3px;
            padding: 6px 10px;
            font-size: 0.85rem;
            border: none;
            border-radius: 6px;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn-info.action-btn {
            background-color: #0d6efd;
            color: white;
        }

        .btn-info.action-btn:hover {
            background-color: #0b5ed7;
            transform: translateY(-2px);
            box-shadow: 0 2px 6px rgba(13, 110, 253, 0.3);
        }

        .btn-danger.action-btn {
            background-color: #dc3545;
            color: white;
        }

        .btn-danger.action-btn:hover {
            background-color: #bb2d3b;
            transform: translateY(-2px);
            box-shadow: 0 2px 6px rgba(220, 53, 69, 0.3);
        }

        .action-btn i {
            margin-right: 4px;
        }

        /* ===== MODAL STYLING ===== */
        .modal-content {
            border: none;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }

        .modal-header {
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            color: white;
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
            padding: 18px 24px;
        }

        .modal-title {
            font-weight: 600;
            font-size: 1.25rem;
        }

        .btn-close {
            filter: invert(1) grayscale(100%) brightness(200%);
            opacity: 0.8;
        }

        .btn-close:hover {
            opacity: 1;
        }

        .modal-body {
            padding: 24px;
            color: #333;
            line-height: 1.6;
        }

        .modal-body p {
            margin-bottom: 12px;
        }

        .modal-body strong {
            color: #2575fc;
            min-width: 80px;
            display: inline-block;
        }

        .modal-body #modal-message {
            display: block;
            background-color: #f8f9fa;
            padding: 10px;
            border-radius: 6px;
            margin-top: 6px;
            color: #212529;
            white-space: pre-wrap;
        }

        .modal-footer {
            padding: 16px 24px;
            border-top: none;
        }

        .btn-secondary {
            background-color: #6c757d;
            border: none;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }

        /* ===== RESPONSIVE FIX ===== */
        @media (max-width: 768px) {
            #contactTable thead {
                display: none;
            }

            #contactTable,
            #contactTable tbody,
            #contactTable tr,
            #contactTable td {
                display: block;
                width: 100%;
            }

            #contactTable tr {
                margin-bottom: 15px;
                background: #fff;
                border: 1px solid #eee;
                border-radius: 8px;
                padding: 12px;
            }

            #contactTable td {
                text-align: right;
                padding-left: 50%;
                position: relative;
            }

            #contactTable td:before {
                content: attr(data-label) ": ";
                position: absolute;
                left: 12px;
                width: 45%;
                font-weight: 600;
                color: #495057;
                text-align: left;
            }

            .action-cell {
                text-align: left !important;
            }

            .action-cell:before {
                display: none;
            }

        }
    </style>
    <!-- In <head> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<body>
    <table id="contactTable">
        <thead>
            <tr>
                <th>s.no</th>
                <th>Name</th>
                <th>Phone No</th>
                <th>Email</th>
                <th>Subject</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <!-- Data will be populated here dynamically from backend -->
        </tbody>
    </table>
</body>
<style>
    #contactModal .modal-dialog {
        max-width: 700px;
    }
</style>
<!-- Info Modal -->
<div class="modal fade" id="contactModal" tabindex="-1" aria-labelledby="contactModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="contactModalLabel">Contact Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Name:</strong> <span id="modal-name"></span></p>
                <p><strong>Phone:</strong> <span id="modal-phone"></span></p>
                <p><strong>Email:</strong> <span id="modal-email"></span></p>
                <p><strong>Subject:</strong> <span id="modal-subject"></span></p>
                <p><strong>Message:</strong> <br><span id="modal-message"></span></p>
                <p><small class="text-muted">Submitted on: <span id="modal-date"></span></small></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

</html>