<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Multiple Files</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        
        .container {
            max-width: 600px;
            width: 90%;
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            overflow: hidden;
            animation: slideIn 0.5s ease;
        }
        
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        
        .header h2 {
            margin: 0;
            font-size: 28px;
            font-weight: 600;
            letter-spacing: 1px;
        }
        
        .header p {
            margin: 10px 0 0;
            opacity: 0.9;
            font-size: 14px;
        }
        
        .upload-form {
            padding: 40px;
        }
        
        .file-upload-area {
            border: 2px dashed #cbd5e0;
            border-radius: 10px;
            padding: 40px 20px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            background: #f7fafc;
            margin-bottom: 20px;
            position: relative;
        }
        
        .file-upload-area:hover {
            border-color: #667eea;
            background: #f0f4ff;
        }
        
        .file-upload-area.dragover {
            border-color: #667eea;
            background: #e6ecff;
            transform: scale(1.02);
        }
        
        .upload-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 20px;
            background: #e2e8f0;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .upload-icon svg {
            width: 40px;
            height: 40px;
            fill: #4a5568;
        }
        
        .file-upload-area h3 {
            color: #2d3748;
            margin: 0 0 10px;
            font-size: 20px;
        }
        
        .file-upload-area p {
            color: #718096;
            margin: 0 0 5px;
            font-size: 14px;
        }
        
        .file-info {
            background: #e6ecff;
            border-radius: 8px;
            padding: 15px;
            margin-top: 15px;
            display: none;
        }
        
        .file-info.active {
            display: block;
        }
        
        .file-list {
            max-height: 200px;
            overflow-y: auto;
            text-align: left;
        }
        
        .file-item {
            background: white;
            padding: 10px;
            margin: 5px 0;
            border-radius: 5px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-left: 3px solid #667eea;
        }
        
        .file-name {
            font-size: 13px;
            color: #2d3748;
            font-weight: 500;
            word-break: break-all;
            flex: 1;
        }
        
        .file-size {
            font-size: 11px;
            color: #718096;
            margin-left: 10px;
            white-space: nowrap;
        }
        
        .file-remove {
            color: #fc8181;
            cursor: pointer;
            margin-left: 10px;
            font-weight: bold;
            font-size: 16px;
        }
        
        .file-remove:hover {
            color: #f56565;
        }
        
        .file-count {
            display: inline-block;
            background: #667eea;
            color: white;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 12px;
            margin-top: 10px;
        }
        
        .file-types {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin: 15px 0;
            justify-content: center;
        }
        
        .file-type-badge {
            background: #e2e8f0;
            color: #4a5568;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }
        
        .file-type-badge.pdf { background: #fc8181; color: white; }
        .file-type-badge.jpg { background: #68d391; color: white; }
        .file-type-badge.png { background: #63b3ed; color: white; }
        .file-type-badge.doc { background: #f6ad55; color: white; }
        
        .file-input {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
        }
        
        .upload-button {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
        
        .upload-button:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
        }
        
        .upload-button:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }
        
        .upload-button svg {
            width: 20px;
            height: 20px;
            fill: currentColor;
        }
        
        .loading-spinner {
            display: none;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255,255,255,0.3);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 1s ease-in-out infinite;
        }
        
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
        
        .upload-button.loading .loading-spinner {
            display: inline-block;
        }
        
        .upload-button.loading .button-text {
            display: none;
        }
        
        .alert {
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            display: none;
        }
        
        .alert.success {
            background: #c6f6d5;
            color: #22543d;
            border: 1px solid #9ae6b4;
            display: block;
        }
        
        .alert.error {
            background: #fed7d7;
            color: #742a2a;
            border: 1px solid #fc8181;
            display: block;
        }
        
        .progress-bar {
            width: 100%;
            height: 5px;
            background: #e2e8f0;
            border-radius: 5px;
            margin: 15px 0;
            overflow: hidden;
            display: none;
        }
        
        .progress-bar.active {
            display: block;
        }
        
        .progress-bar .progress {
            height: 100%;
            background: linear-gradient(90deg, #667eea, #764ba2);
            width: 0%;
            transition: width 0.3s ease;
        }
        
        .footer-links {
            text-align: center;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #e2e8f0;
        }
        
        .footer-links a {
            color: #667eea;
            text-decoration: none;
            font-size: 14px;
            margin: 0 10px;
        }
        
        .footer-links a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>📁 Upload Multiple Files</h2>
            <p>Select multiple files to upload</p>
        </div>
        
        <div class="upload-form">
            <!-- Alert Messages -->
            @if(session('success'))
                <div class="alert success">
                    ✅ {{ session('success') }}
                </div>
            @endif
            
            @if(session('error'))
                <div class="alert error">
                    ❌ {{ session('error') }}
                </div>
            @endif
            
            @if($errors->any())
                <div class="alert error">
                    ❌ {{ $errors->first() }}
                </div>
            @endif
            
            <form action="/upload-file" method="POST" enctype="multipart/form-data" id="uploadForm">
                @csrf
                
                <div class="file-upload-area" id="dropArea">
                    <div class="upload-icon">
                        <svg viewBox="0 0 24 24">
                            <path d="M19.35 10.04C18.67 6.59 15.64 4 12 4 9.11 4 6.6 5.64 5.35 8.04 2.34 8.36 0 10.91 0 14c0 3.31 2.69 6 6 6h13c2.76 0 5-2.24 5-5 0-2.64-2.05-4.78-4.65-4.96zM14 13v4h-4v-4H7l5-5 5 5h-3z"/>
                        </svg>
                    </div>
                    <h3>Drag & Drop files here</h3>
                    <p>or click to browse (multiple files allowed)</p>
                    
                    <div class="file-types">
                        <span class="file-type-badge pdf">PDF</span>
                        <span class="file-type-badge jpg">JPG</span>
                        <span class="file-type-badge png">PNG</span>
                        <span class="file-type-badge doc">DOC</span>
                    </div>
                    
                    <div class="file-info" id="fileInfo">
                        <div class="file-count" id="fileCount">0 files selected</div>
                        <div class="file-list" id="fileList"></div>
                    </div>
                    
                    <input type="file" name="files[]" id="fileInput" class="file-input" multiple accept=".pdf,.jpg,.jpeg,.png,.doc,.docx">
                </div>
                
                <div class="progress-bar" id="progressBar">
                    <div class="progress" id="progress"></div>
                </div>
                
                <button type="submit" class="upload-button" id="submitBtn">
                    <svg viewBox="0 0 24 24">
                        <path d="M19.35 10.04C18.67 6.59 15.64 4 12 4 9.11 4 6.6 5.64 5.35 8.04 2.34 8.36 0 10.91 0 14c0 3.31 2.69 6 6 6h13c2.76 0 5-2.24 5-5 0-2.64-2.05-4.78-4.65-4.96zM14 13v4h-4v-4H7l5-5 5 5h-3z"/>
                    </svg>
                    <span class="button-text">Upload Files</span>
                    <span class="loading-spinner"></span>
                </button>
            </form>
            
            <div class="footer-links">
                <a href="/">🏠 Home</a>
                <a href="/files">📋 View Files</a>
            </div>
        </div>
    </div>
    
    <script>
        const dropArea = document.getElementById('dropArea');
        const fileInput = document.getElementById('fileInput');
        const fileInfo = document.getElementById('fileInfo');
        const fileCount = document.getElementById('fileCount');
        const fileList = document.getElementById('fileList');
        const submitBtn = document.getElementById('submitBtn');
        const uploadForm = document.getElementById('uploadForm');
        const progressBar = document.getElementById('progressBar');
        const progress = document.getElementById('progress');
        
        // Prevent default drag behaviors
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropArea.addEventListener(eventName, preventDefaults, false);
            document.body.addEventListener(eventName, preventDefaults, false);
        });
        
        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }
        
        // Highlight drop area when dragging over
        ['dragenter', 'dragover'].forEach(eventName => {
            dropArea.addEventListener(eventName, highlight, false);
        });
        
        ['dragleave', 'drop'].forEach(eventName => {
            dropArea.addEventListener(eventName, unhighlight, false);
        });
        
        function highlight() {
            dropArea.classList.add('dragover');
        }
        
        function unhighlight() {
            dropArea.classList.remove('dragover');
        }
        
        // Handle dropped files
        dropArea.addEventListener('drop', handleDrop, false);
        
        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;
            
            if (files.length > 0) {
                fileInput.files = files;
                updateFileList(files);
            }
        }
        
        // Handle file selection via click
        fileInput.addEventListener('change', function() {
            if (this.files.length > 0) {
                updateFileList(this.files);
            } else {
                fileInfo.classList.remove('active');
            }
        });
        
        function updateFileList(files) {
            fileInfo.classList.add('active');
            fileCount.textContent = files.length + ' file' + (files.length > 1 ? 's' : '') + ' selected';
            
            let html = '';
            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                const size = formatFileSize(file.size);
                
                html += `
                    <div class="file-item" data-index="${i}">
                        <span class="file-name">${file.name}</span>
                        <span class="file-size">${size}</span>
                        <span class="file-remove" onclick="removeFile(${i})">✕</span>
                    </div>
                `;
            }
            
            fileList.innerHTML = html;
        }
        
        function formatFileSize(size) {
            if (size < 1024) {
                return size + ' B';
            } else if (size < 1024 * 1024) {
                return (size / 1024).toFixed(2) + ' KB';
            } else {
                return (size / (1024 * 1024)).toFixed(2) + ' MB';
            }
        }
        
        window.removeFile = function(index) {
            const dt = new DataTransfer();
            const files = fileInput.files;
            
            for (let i = 0; i < files.length; i++) {
                if (i !== index) {
                    dt.items.add(files[i]);
                }
            }
            
            fileInput.files = dt.files;
            
            if (fileInput.files.length > 0) {
                updateFileList(fileInput.files);
            } else {
                fileInfo.classList.remove('active');
            }
        };
        
        // Handle form submission with loading state
        uploadForm.addEventListener('submit', function(e) {
            if (!fileInput.files.length) {
                e.preventDefault();
                alert('Please select at least one file first!');
                return;
            }
            
            submitBtn.classList.add('loading');
            submitBtn.disabled = true;
            
            // Show progress bar (simulated)
            progressBar.classList.add('active');
            let width = 0;
            const interval = setInterval(() => {
                if (width >= 90) {
                    clearInterval(interval);
                } else {
                    width += 10;
                    progress.style.width = width + '%';
                }
            }, 100);
        });
    </script>
</body>
</html>