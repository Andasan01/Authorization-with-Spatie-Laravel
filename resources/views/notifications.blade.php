<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Notifications</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h2 {
            color: #333;
            border-bottom: 2px solid #eee;
            padding-bottom: 10px;
            margin-top: 0;
        }
        .notification {
            background-color: #f9f9f9;
            border-left: 4px solid #007bff;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 5px;
            transition: all 0.3s ease;
        }
        .notification:hover {
            background-color: #f0f0f0;
            transform: translateX(5px);
        }
        .notification.unread {
            border-left-color: #dc3545;
            background-color: #fff3f3;
        }
        .notification-message {
            font-size: 16px;
            color: #333;
            margin: 0 0 10px 0;
        }
        .notification-meta {
            font-size: 12px;
            color: #666;
            margin: 0;
        }
        .notification-meta span {
            margin-right: 15px;
        }
        .badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 3px;
            font-size: 11px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .badge.unread {
            background-color: #dc3545;
            color: white;
        }
        .badge.read {
            background-color: #28a745;
            color: white;
        }
        .no-notifications {
            text-align: center;
            color: #666;
            padding: 40px;
            background-color: #f9f9f9;
            border-radius: 5px;
        }
        .links {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            text-align: center;
        }
        .links a {
            display: inline-block;
            margin: 0 10px;
            padding: 8px 15px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 14px;
        }
        .links a:hover {
            background-color: #0056b3;
        }
        .links a.danger {
            background-color: #dc3545;
        }
        .links a.danger:hover {
            background-color: #bd2130;
        }
        .links a.success {
            background-color: #28a745;
        }
        .links a.success:hover {
            background-color: #1e7e34;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>User Notifications</h2>
        
        @if($notifications->count() > 0)
            @foreach($notifications as $notification)
                <div class="notification {{ $notification->read_at ? 'read' : 'unread' }}">
                    <p class="notification-message">
                        {{ $notification->data['message'] ?? 'No message content' }}
                    </p>
                    <p class="notification-meta">
                        <span>📅 {{ $notification->created_at->diffForHumans() }}</span>
                        <span>📌 Type: {{ class_basename($notification->type) }}</span>
                        <span class="badge {{ $notification->read_at ? 'read' : 'unread' }}">
                            {{ $notification->read_at ? 'Read' : 'Unread' }}
                        </span>
                        @if(isset($notification->data['url']))
                            <span>🔗 <a href="{{ $notification->data['url'] }}">View</a></span>
                        @endif
                    </p>
                </div>
            @endforeach
        @else
            <div class="no-notifications">
                <p>📭 No notifications found</p>
            </div>
        @endif

        <div class="links">
            <a href="{{ url('/send-notification') }}">Send Test Notification</a>
            <a href="{{ url('/notifications') }}" class="success">All Notifications</a>
            <a href="{{ url('/unread-notifications') }}" class="danger">Unread Only</a>
            <a href="{{ url('/mark-as-read') }}" class="success">Mark All as Read</a>
        </div>
    </div>
</body>
</html>