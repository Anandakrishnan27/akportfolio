<body>
    <div class="container">
        <header>
            <h1><i class="fas fa-plus-circle"></i> Dynamic carousal form</h1>
            <p>Upload image and set status</p>
        </header>

        <div class="form-container">
            <form id="carousalForm" action="<?= base_url('carousal/save') ?>" method="post"
                enctype="multipart/form-data">
                <div class="form-group">
                    <label for="carousalimage">Carousal Image <span class="required">*</span></label>
                    <div class="image-upload" id="imageUpload">
                        <i class="fas fa-cloud-upload-alt"></i>
                        <p>Click to upload or drag and drop</p>
                        <p class="small">PNG, JPG, GIF up to 5MB</p>
                        <input type="file" id="carousalimage" name="carousalimage" class="file-input" accept="image/*"
                            required>
                    </div>
                    <div class="preview-container" id="imagePreview">
                        <img id="previewImage" src="" alt="Preview">
                    </div>
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <div class="checkbox-group">
                        <label class="checkbox-custom">
                            <input type="checkbox" id="carousalStatus" name="carousalStatus" checked>
                            <span class="checkmark"></span>
                            <span>Active (Uncheck to set as inactive)</span>
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="carousalCode">Carousal code<span class="required">*</span></label>
                    <div class="input-with-icon">
                        <i class="fas fa-tag"></i>
                        <input type="text" id="carousalCode" name="carousalCode" placeholder="Enter code" required>
                    </div>
                </div>

                <button type="submit" class="submit-btn">
                    <i class="fas fa-plus"></i> Insert Carousal
                </button>

                <div class="success-message" id="successMessage">
                    Carousal images inserted successfully!
                </div>
            </form>
        </div>
    </div>

    <script>
    </script>
</body>

</html>