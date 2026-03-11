<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Models\User;
use App\Models\Student;
use App\Models\FileUpload;
use App\Notifications\NewMessageNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

// Welcome page
Route::get('/', function () {
    return view('welcome');
});

// Test route
Route::get('/test-web', function() {
    return response()->json(['message' => 'Web route works!']);
});

// Simple admin route with role middleware
Route::get('/admin', function () {
    return "Admin Dashboard";
})->middleware('role:admin');

// Admin routes group with controllers
Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
});

// Student routes
Route::get('/add-student', function () {
    Student::create([
        'name' => 'Juan Dela Cruz',
        'email' => 'juan@example.com',
        'course' => 'BSIT'
    ]);

    return "Student Added!";
});

// Retrieve all students (JSON)
Route::get('/students', function () {
    $students = Student::all();
    return $students;
});

// Display students in Blade view
Route::get('/students-view', function () {
    $students = Student::all();
    return view('students', compact('students'));
});

// Update student data
Route::get('/update-student', function () {
    // Find student with ID 1
    $student = Student::find(1);
    
    if (!$student) {
        return "Student with ID 1 not found!";
    }
    
    // Update the course
    $student->course = "BSCS";
    $student->save();
    
    return "Student Updated! Course changed to BSCS";
});

// Delete student data
Route::get('/delete-student', function () {
    // Find student with ID 1
    $student = Student::find(1);
    
    if (!$student) {
        return "Student with ID 1 not found!";
    }
    
    // Delete the student
    $student->delete();
    
    return "Student Deleted!";
});

// File Upload Routes
Route::get('/upload', function () {
    return view('upload');
});

// Multiple File Upload Route with Validation
Route::post('/upload-file', function (Request $request) {
    // Validate the request for multiple files
    $request->validate([
        'files.*' => 'required|file|mimes:jpg,png,pdf,docx|max:2048'
    ]);

    $uploadedCount = 0;
    $uploadedFiles = [];

    // Loop through each uploaded file
    foreach ($request->file('files') as $file) {
        // Store the file in the public disk under 'uploads' directory
        $path = $file->store('uploads', 'public');

        // Create a record in the database
        FileUpload::create([
            'filename' => $file->getClientOriginalName(),
            'original_filename' => $file->getClientOriginalName(),
            'filepath' => $path,
            'mime_type' => $file->getMimeType(),
            'file_size' => $file->getSize(),
            'extension' => $file->getClientOriginalExtension(),
            'is_public' => true,
            'download_count' => 0
        ]);
        
        $uploadedCount++;
        $uploadedFiles[] = $file->getClientOriginalName();
    }

    // Return success message with details
    return "{$uploadedCount} file(s) uploaded successfully! Files: " . implode(', ', $uploadedFiles);
});

// View uploaded files
Route::get('/files', function () {
    $files = FileUpload::all();
    return view('files', compact('files'));
});

// Download file
Route::get('/download/{id}', function ($id) {
    // Find the file or fail (throws 404 if not found)
    $file = FileUpload::findOrFail($id);
    
    // Increment download count
    $file->increment('download_count');
    
    // Download the file from storage
    return Storage::disk('public')->download($file->filepath, $file->filename);
});

// OPTION 1: Delete file - Accept both GET and DELETE methods
Route::match(['get', 'delete'], '/delete/{id}', function ($id) {
    // Find the file or fail (throws 404 if not found)
    $file = FileUpload::findOrFail($id);
    
    // Delete the physical file from storage
    Storage::disk('public')->delete($file->filepath);
    
    // Delete the database record
    $file->delete();
    
    // Redirect back to files page with success message
    return redirect('/files')->with('success', 'File deleted successfully!');
});

// Notification test route
Route::get('/send-notification', function () {
    // Find user with ID 1 (make sure this user exists in your database)
    $user = User::find(1);
    
    if (!$user) {
        return "User with ID 1 not found!";
    }
    
    $user->notify(new NewMessageNotification());
    
    return "Notification Sent!";
});

// Display notifications view
Route::get('/notifications', function () {
    $user = User::find(1);
    
    if (!$user) {
        return "User with ID 1 not found!";
    }
    
    $notifications = $user->notifications;
    
    return view('notifications', compact('notifications'));
});

// Display unread notifications view
Route::get('/unread-notifications', function () {
    $user = User::find(1);
    
    if (!$user) {
        return "User with ID 1 not found!";
    }
    
    $notifications = $user->unreadNotifications;
    
    return view('notifications', compact('notifications'));
});

// Mark notifications as read
Route::get('/mark-as-read', function () {
    $user = User::find(1);
    
    if (!$user) {
        return "User with ID 1 not found!";
    }
    
    $user->unreadNotifications->markAsRead();
    
    return redirect('/notifications')->with('message', 'All notifications marked as read!');
});