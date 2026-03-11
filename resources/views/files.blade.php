<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uploaded Files</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            margin: 0;
            padding: 20px;
            min-height: 100vh;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            padding: 30px;
        }
        
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }
        
        h2 {
            color: #2d3748;
            margin: 0;
            font-size: 28px;
            border-bottom: 3px solid #667eea;
            padding-bottom: 10px;
        }
        
        .stats {
            background: #f7fafc;
            padding: 15px 25px;
            border-radius: 10px;
            display: flex;
            gap: 20px;
        }
        
        .stat-item {
            text-align: center;
        }
        
        .stat-value {
            font-size: 24px;
            font-weight: bold;
            color: #667eea;
        }
        
        .stat-label {
            font-size: 12px;
            color: #718096;
            text-transform: uppercase;
        }
        
        .files-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 25px;
            margin-top: 20px;
        }
        
        .file-card {
            background: #f7fafc;
            border-radius: 15px;
            overflow: hidden;
            transition: all 0.3s ease;
            border: 1px solid #e2e8f0;
            position: relative;
        }
        
        .file-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(102, 126, 234, 0.2);
        }
        
        .file-preview {
            height: 180px;
            background: #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }
        
        .file-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .file-icon {
            width: 60px;
            height: 60px;
            background: #667eea;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .file-icon svg {
            width: 30px;
            height: 30px;
            fill: white;
        }
        
        .file-extension {
            position: absolute;
            top: 10px;
            right: 10px;
            background: rgba(0,0,0,0.7);
            color: white;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
        }
        
        .file-details {
            padding: 20px;
        }
        
        .file-name {
            font-size: 16px;
            font-weight: 600;
            color: #2d3748;
            margin: 0 0 10px;
            word-break: break-all;
            line-height: 1.4;
        }
        
        .file-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 15px;
            font-size: 13px;
            color: #718096;
        }
        
        .file-meta span {
            display: flex;
            align-items: center;
            gap: 5px;
        }
        
        .file-actions {
            display: flex;
            gap: 10px;
            margin-top: 15px;
            flex-wrap: wrap;
        }
        
        .btn {
            flex: 1;
            padding: 10px;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            text-decoration: none;
            text-align: center;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
        }
        
        .btn-view {
            background: #667eea;
            color: white;
        }
        
        .btn-view:hover {
            background: #5a67d8;
            transform: translateY(-2px);
        }
        
        .btn-download {
            background: #48bb78;
            color: white;
        }
        
        .btn-download:hover {
            background: #38a169;
            transform: translateY(-2px);
        }
        
        .btn-delete {
            background: #f56565;
            color: white;
        }
        
        .btn-delete:hover {
            background: #e53e3e;
            transform: translateY(-2px);
        }
        
        .btn-back {
            background: #718096;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            transition: all 0.3s ease;
        }
        
        .btn-back:hover {
            background: #4a5568;
            transform: translateY(-2px);
        }
        
        .no-files {
            text-align: center;
            color: #718096;
            padding: 60px 20px;
            background: #f7fafc;
            border-radius: 15px;
            font-size: 16px;
        }
        
        .no-files svg {
            width: 80px;
            height: 80px;
            fill: #cbd5e0;
            margin-bottom: 20px;
        }
        
        .success-message {
            background: #c6f6d5;
            color: #22543d;
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            animation: slideDown 0.3s ease;
        }
        
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .footer {
            margin-top: 30px;
            text-align: center;
        }
        
        /* File type specific styles */
        .file-preview.pdf { background: #fc8181; }
        .file-preview.doc { background: #f6ad55; }
        .file-preview.jpg { background: #68d391; }
        .file-preview.png { background: #63b3ed; }
        
        @media (max-width: 768px) {
            .files-grid {
                grid-template-columns: 1fr;
            }
            
            .header {
                flex-direction: column;
                gap: 15px;
            }
            
            .stats {
                width: 100%;
                justify-content: space-around;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        @if(session('success'))
            <div class="success-message">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M20 6L9 17l-5-5" stroke="currentColor" stroke-linecap="round"/>
                </svg>
                {{ session('success') }}
            </div>
        @endif
        
        <div class="header">
            <h2>📁 Uploaded Files</h2>
            
            @php
                $totalSize = $files->sum('file_size');
                $imageCount = $files->filter(function($file) {
                    return in_array(strtolower($file->extension), ['jpg', 'jpeg', 'png', 'gif']);
                })->count();
            @endphp
            
            <div class="stats">
                <div class="stat-item">
                    <div class="stat-value">{{ $files->count() }}</div>
                    <div class="stat-label">Total Files</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value">
                        @if($totalSize < 1024)
                            {{ $totalSize }} B
                        @elseif($totalSize < 1024 * 1024)
                            {{ round($totalSize / 1024, 2) }} KB
                        @else
                            {{ round($totalSize / (1024 * 1024), 2) }} MB
                        @endif
                    </div>
                    <div class="stat-label">Total Size</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value">{{ $imageCount }}</div>
                    <div class="stat-label">Images</div>
                </div>
            </div>
        </div>
        
        @if($files->isEmpty())
            <div class="no-files">
                <svg viewBox="0 0 24 24">
                    <path d="M19.35 10.04C18.67 6.59 15.64 4 12 4 9.11 4 6.6 5.64 5.35 8.04 2.34 8.36 0 10.91 0 14c0 3.31 2.69 6 6 6h13c2.76 0 5-2.24 5-5 0-2.64-2.05-4.78-4.65-4.96z"/>
                </svg>
                <h3>No files uploaded yet</h3>
                <p>Get started by uploading your first file</p>
                <a href="/upload" class="btn-back" style="margin-top: 20px;">📤 Upload Files</a>
            </div>
        @else
            <div class="files-grid">
                @foreach($files as $file)
                    @php
                        $extension = strtolower($file->extension);
                        $isImage = in_array($extension, ['jpg', 'jpeg', 'png', 'gif']);
                        $filePath = asset('storage/' . $file->filepath);
                    @endphp
                    
                    <div class="file-card">
                        <div class="file-preview {{ $extension }}">
                            @if($isImage)
                                <img src="{{ $filePath }}" alt="{{ $file->filename }}">
                            @else
                                <div class="file-icon">
                                    @if($extension == 'pdf')
                                        <svg viewBox="0 0 24 24">
                                            <path d="M20 2H8c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm-8.5 7.5c0 .8-.7 1.5-1.5 1.5H8V9h2v2h.5v-2h1c.3 0 .5-.2.5-.5V8c0-.3-.2-.5-.5-.5h-2V7h2.5c.3 0 .5.2.5.5v2zm2 2L11 7h1.5l1.5 3.5L15.5 7H17l-2.5 4.5v3h-1.5v-3z"/>
                                        </svg>
                                    @elseif(in_array($extension, ['doc', 'docx']))
                                        <svg viewBox="0 0 24 24">
                                            <path d="M14 2H6c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z"/>
                                        </svg>
                                    @else
                                        <svg viewBox="0 0 24 24">
                                            <path d="M14 2H6c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V8l-6-6zm2 18H6V4h7v5h5v11z"/>
                                        </svg>
                                    @endif
                                </div>
                            @endif
                            <span class="file-extension">{{ $extension }}</span>
                        </div>
                        
                        <div class="file-details">
                            <h3 class="file-name">{{ $file->filename }}</h3>
                            
                            <div class="file-meta">
                                <span>📅 {{ $file->created_at->format('M d, Y') }}</span>
                                <span>🕒 {{ $file->created_at->format('h:i A') }}</span>
                                <span>
                                    @if($file->file_size < 1024)
                                        {{ $file->file_size }} B
                                    @elseif($file->file_size < 1024 * 1024)
                                        {{ round($file->file_size / 1024, 2) }} KB
                                    @else
                                        {{ round($file->file_size / (1024 * 1024), 2) }} MB
                                    @endif
                                </span>
                                <span>📥 {{ $file->download_count ?? 0 }} downloads</span>
                            </div>
                            
                            <div class="file-actions">
                                <a href="{{ asset('storage/'.$file->filepath) }}" target="_blank" class="btn btn-view">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" stroke-width="2"/>
                                        <circle cx="12" cy="12" r="3" stroke-width="2"/>
                                    </svg>
                                    View
                                </a>
                                
                                <a href="/download/{{ $file->id }}" class="btn btn-download">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" stroke-width="2"/>
                                        <polyline points="7 10 12 15 17 10" stroke-width="2"/>
                                        <line x1="12" y1="15" x2="12" y2="3" stroke-width="2"/>
                                    </svg>
                                    Download
                                </a>
                                
                                <form action="/delete/{{ $file->id }}" method="POST" style="flex:1;" onsubmit="return confirm('Are you sure you want to delete this file?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-delete" style="width:100%;">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                            <polyline points="3 6 5 6 21 6" stroke-width="2"/>
                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" stroke-width="2"/>
                                        </svg>
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
        
        <div class="footer">
            <a href="/upload" class="btn-back">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path d="M19.35 10.04C18.67 6.59 15.64 4 12 4 9.11 4 6.6 5.64 5.35 8.04 2.34 8.36 0 10.91 0 14c0 3.31 2.69 6 6 6h13c2.76 0 5-2.24 5-5 0-2.64-2.05-4.78-4.65-4.96zM14 13v4h-4v-4H7l5-5 5 5h-3z"/>
                </svg>
                Upload More Files
            </a>
            <a href="/" style="margin-left: 10px;" class="btn-back">
                🏠 Home
            </a>
        </div>
    </div>
</body>
</html>