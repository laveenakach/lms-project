<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatbotController extends Controller
{
    public function reply(Request $request)
    {
        $message = strtolower(trim($request->message));
        $reply = "";

        if (str_contains($message, 'hello') || str_contains($message, 'hi')) {
            $reply = "👋 Hello there! How can I help you today?";
        } elseif (str_contains($message, 'course') || str_contains($message, 'courses')) {
            $reply = "🎓 You can view all available courses under the *Courses* section. Would you like me to help you navigate there?";
        } elseif (str_contains($message, 'attendance')) {
            $reply = "📅 To check your attendance, go to *Dashboard → Attendance* or click on the Attendance tab from your sidebar.";
        } elseif (str_contains($message, 'assignment')) {
            $reply = "📝 You can view or submit assignments under *Dashboard → Assignments*. Make sure your file format is PDF or DOCX!";
        } elseif (str_contains($message, 'project')) {
            $reply = "💻 You can track or upload your projects under the *Projects* module. Don’t forget to include your GitHub link if applicable!";
        } elseif (str_contains($message, 'certificate') || str_contains($message, 'certification')) {
            $reply = "🏆 Your certificates are available under *My Certifications*. You can download them in PDF format once approved.";
        } elseif (str_contains($message, 'profile') || str_contains($message, 'update')) {
            $reply = "👤 You can update your profile details from *Dashboard → My Profile*. Don’t forget to save your changes!";
        } elseif (str_contains($message, 'password')) {
            $reply = "🔐 You can reset your password by visiting *Settings → Change Password* or using the ‘Forgot Password’ link on the login page.";
        } elseif (str_contains($message, 'support') || str_contains($message, 'contact')) {
            $reply = "📩 For any issues, please contact our support team at *support@yourdomain.com* or use the *Contact Us* page.";
        } elseif (str_contains($message, 'thank')) {
            $reply = "😊 You're most welcome! Let me know if there’s anything else I can do for you.";
        } else {
            $reply = "🤔 I’m not sure about that yet, but I’m learning! Try asking about *courses, attendance, assignments,* or *support.*";
        }

        return response()->json(['reply' => $reply]);
    }
}
