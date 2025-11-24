<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('admin.profile.index');
    }

    public function update(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'cropped_photo' => 'nullable|string',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        // Handle cropped photo (from JavaScript cropper)
        if ($request->filled('cropped_photo')) {
            Log::info('Processing cropped photo');
            // Delete old photo if exists
            if ($user->photo) {
                Storage::delete('public/' . $user->photo);
            }

            // Get base64 image data
            $imageData = $request->cropped_photo;
            
            // Remove the data URL prefix
            $imageData = substr($imageData, strpos($imageData, ',') + 1);
            
            // Decode base64 image
            $imageData = base64_decode($imageData);
            
            // Create a temporary file
            $filename = time() . '.jpg';
            $tempPath = sys_get_temp_dir() . '/' . $filename;
            file_put_contents($tempPath, $imageData);
            
            // Resize image to 160x160 using GD
            list($width, $height) = getimagesize($tempPath);
            $newWidth = 160;
            $newHeight = 160;
            
            // Create a new true color image
            $thumb = imagecreatetruecolor($newWidth, $newHeight);
            
            // Create source image from JPEG
            $source = imagecreatefromjpeg($tempPath);
            
            // Resize the image
            imagecopyresampled($thumb, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
            
            // Save the resized image to a temporary file
            $resizedTempPath = sys_get_temp_dir() . '/resized_' . $filename;
            imagejpeg($thumb, $resizedTempPath, 90);
            
            // Free up memory
            imagedestroy($thumb);
            imagedestroy($source);
            
            // Store the image
            $path = 'profile-photos/' . $filename;
            Storage::disk('public')->put($path, file_get_contents($resizedTempPath));
            
            // Delete temporary files
            unlink($tempPath);
            unlink($resizedTempPath);
            
            $user->photo = $path;
            Log::info('Cropped photo saved to: ' . $path);
        }
        // Handle regular photo upload (fallback)
        elseif ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($user->photo) {
                Storage::delete('public/' . $user->photo);
            }

            $photo = $request->file('photo');
            $filename = time() . '.' . $photo->getClientOriginalExtension();
            
            // Resize image to 160x160 using GD
            list($width, $height) = getimagesize($photo);
            $newWidth = 160;
            $newHeight = 160;
            
            // Create a new true color image
            $thumb = imagecreatetruecolor($newWidth, $newHeight);
            
            // Create source image based on file type
            $extension = strtolower($photo->getClientOriginalExtension());
            if ($extension == 'jpeg' || $extension == 'jpg') {
                $source = imagecreatefromjpeg($photo);
            } elseif ($extension == 'png') {
                $source = imagecreatefrompng($photo);
            } elseif ($extension == 'gif') {
                $source = imagecreatefromgif($photo);
            } else {
                // Unsupported format
                return redirect()->route('admin.profile.index')
                    ->with('error', 'Unsupported image format. Please use JPG, PNG, or GIF.');
            }
            
            // Resize the image
            imagecopyresampled($thumb, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
            
            // Save the resized image to a temporary file
            $tempPath = sys_get_temp_dir() . '/' . $filename;
            if ($extension == 'jpeg' || $extension == 'jpg') {
                imagejpeg($thumb, $tempPath, 90);
            } elseif ($extension == 'png') {
                imagepng($thumb, $tempPath, 9);
            } elseif ($extension == 'gif') {
                imagegif($thumb, $tempPath);
            }
            
            // Free up memory
            imagedestroy($thumb);
            imagedestroy($source);
            
            // Store the image
            $path = 'profile-photos/' . $filename;
            Storage::disk('public')->put($path, file_get_contents($tempPath));
            
            // Delete temporary file
            unlink($tempPath);
            
            $user->photo = $path;
        }

        $user->save();

        return redirect()->route('admin.profile.index')
            ->with('success', 'Profile updated successfully.');
    }
}