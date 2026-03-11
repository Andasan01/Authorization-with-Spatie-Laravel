<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student List</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
            background-color: #f8f9fa;
        }
        .container {
            max-width: 1000px;
            margin: 0 auto;
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 15px rgba(0,0,0,0.1);
        }
        h2 {
            color: #2c3e50;
            border-bottom: 3px solid #3498db;
            padding-bottom: 10px;
            margin-top: 0;
        }
        .student-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }
        .student-card {
            background-color: #fff;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 20px;
            transition: transform 0.2s, box-shadow 0.2s;
            border-left: 4px solid #3498db;
        }
        .student-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0,0,0,0.15);
        }
        .student-name {
            font-size: 1.2em;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 10px;
        }
        .student-course {
            display: inline-block;
            background-color: #e1f0fa;
            color: #2980b9;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.9em;
            font-weight: 500;
        }
        .student-email {
            color: #7f8c8d;
            font-size: 0.9em;
            margin: 10px 0;
        }
        .student-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 15px;
            font-size: 0.85em;
            color: #95a5a6;
        }
        .no-students {
            text-align: center;
            color: #7f8c8d;
            padding: 40px;
            background-color: #f9f9f9;
            border-radius: 8px;
            font-size: 1.1em;
        }
        .actions {
            margin-top: 20px;
            text-align: center;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin: 0 5px;
            transition: background-color 0.3s;
        }
        .btn:hover {
            background-color: #2980b9;
        }
        .btn-success {
            background-color: #27ae60;
        }
        .btn-success:hover {
            background-color: #229954;
        }
        .student-stats {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .stats-badge {
            background-color: #3498db;
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>📚 Student List</h2>
        
        <div class="student-stats">
            <span>Total Students: <span class="stats-badge">{{ $students->count() }}</span></span>
            <span>Last Updated: {{ now()->format('F j, Y g:i A') }}</span>
        </div>
        
        @if($students->isEmpty())
            <div class="no-students">
                <p>✨ No students found. Add your first student!</p>
                <a href="/add-student" class="btn btn-success">Add Student</a>
            </div>
        @else
            <div class="student-grid">
                @foreach($students as $student)
                    <div class="student-card">
                        <div class="student-name">
                            👤 {{ $student->name }}
                        </div>
                        <div class="student-email">
                            📧 {{ $student->email }}
                        </div>
                        <div>
                            <span class="student-course">
                                📖 {{ $student->course }}
                            </span>
                        </div>
                        <div class="student-meta">
                            <span>🆔 ID: {{ $student->id }}</span>
                            <span>📅 Joined: {{ $student->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
        
        <div class="actions">
            <a href="/" class="btn">🏠 Home</a>
            <a href="/add-student" class="btn btn-success">➕ Add Student</a>
            <a href="/students" class="btn">📋 View JSON</a>
        </div>
    </div>
</body>
</html>