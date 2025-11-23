<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carousal Form</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #e4edf9 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            width: 100%;
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        header {
            background: linear-gradient(90deg, #4361ee 0%, #3a0ca3 100%);
            color: white;
            padding: 25px 30px;
            text-align: center;
        }

        header h1 {
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        header p {
            opacity: 0.9;
            font-size: 16px;
        }

        .form-container {
            padding: 30px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: 600;
            color: #2b2d42;
            font-size: 16px;
        }

        .required {
            color: #e63946;
        }

        .input-with-icon {
            position: relative;
        }

        .input-with-icon i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #4361ee;
        }

        input[type="text"],
        input[type="email"],
        textarea,
        select {
            width: 100%;
            padding: 14px 14px 14px 45px;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        textarea:focus,
        select:focus {
            border-color: #4361ee;
            outline: none;
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.2);
        }

        textarea {
            min-height: 120px;
            resize: vertical;
        }

        /* Image Upload Styling */
        .image-upload {
            border: 2px dashed #cbd5e1;
            border-radius: 10px;
            padding: 25px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            background-color: #f8fafc;
        }

        .image-upload:hover {
            border-color: #4361ee;
            background-color: #f0f4ff;
        }

        .image-upload i {
            font-size: 48px;
            color: #4361ee;
            margin-bottom: 15px;
        }

        .image-upload p {
            margin: 10px 0;
            color: #64748b;
        }

        .image-upload .file-input {
            display: none;
        }

        .preview-container {
            margin-top: 20px;
            display: none;
        }

        .preview-container img {
            max-width: 100%;
            max-height: 200px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Status Checkbox */
        .checkbox-group {
            display: flex;
            align-items: flex-start;
        }

        .checkbox-custom {
            position: relative;
            padding-left: 35px;
            cursor: pointer;
            font-size: 16px;
            user-select: none;
            line-height: 1.5;
        }

        .checkbox-custom input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
            height: 0;
            width: 0;
        }

        .checkmark {
            position: absolute;
            top: 0;
            left: 0;
            height: 24px;
            width: 24px;
            background-color: #f1f5f9;
            border: 2px solid #cbd5e1;
            border-radius: 6px;
            transition: all 0.2s ease;
        }

        .checkbox-custom:hover input~.checkmark {
            background-color: #f0f4ff;
            border-color: #4361ee;
        }

        .checkbox-custom input:checked~.checkmark {
            background-color: #4361ee;
            border-color: #4361ee;
        }

        .checkmark:after {
            content: "";
            position: absolute;
            display: none;
        }

        .checkbox-custom input:checked~.checkmark:after {
            display: block;
        }

        .checkbox-custom .checkmark:after {
            left: 7px;
            top: 3px;
            width: 6px;
            height: 12px;
            border: solid white;
            border-width: 0 2px 2px 0;
            transform: rotate(45deg);
        }

        /* Submit Button */
        .submit-btn {
            background: linear-gradient(90deg, #4361ee 0%, #3a0ca3 100%);
            color: white;
            border: none;
            padding: 16px 40px;
            font-size: 18px;
            font-weight: 600;
            border-radius: 10px;
            cursor: pointer;
            width: 100%;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(67, 97, 238, 0.3);
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(67, 97, 238, 0.4);
        }

        .submit-btn:active {
            transform: translateY(0);
        }

        /* Success Message */
        .success-message {
            display: none;
            background: #d1fae5;
            color: #065f46;
            padding: 15px;
            border-radius: 10px;
            margin-top: 20px;
            text-align: center;
            font-weight: 500;
        }

        /* Responsive Design */
        @media (max-width: 600px) {
            .form-container {
                padding: 20px;
            }

            header h1 {
                font-size: 24px;
            }

            input[type="text"],
            input[type="email"],
            textarea,
            select {
                padding: 12px 12px 12px 40px;
            }
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>