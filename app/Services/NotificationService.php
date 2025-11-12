<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use App\Models\User;

class NotificationService
{
    public static function notifyAdmins($type, $title, $message, $data = [])
    {
        $admins = User::where('is_admin', 'yes')->get();

        foreach ($admins as $admin) {
            // Send Email + SMS
            self::sendEmail($admin, $title, $message, $data);
            self::sendSMS($admin, $title, $message);
        }
    }

    private static function sendEmail($admin, $title, $message, $data)
    {
        try {
            $emailContent = view('emails.admin_notification', [
                'admin' => $admin,
                'title' => $title,
                'messageBody' => $message,
                'data' => $data,
            ])->render();

            Mail::send([], [], function ($msg) use ($admin, $title, $emailContent) {
                $msg->to($admin->email)
                    ->subject("📢 {$title}")
                    ->html($emailContent);
            });

            Log::info("✅ Admin email sent successfully to {$admin->email}");
        } catch (\Exception $e) {
            Log::error("❌ Failed to send email to admin {$admin->email}: " . $e->getMessage());
        }
    }

    private static function sendSMS($admin, $title, $message)
    {
        if (!$admin->phone) {
            Log::warning("⚠️ No phone number found for admin {$admin->email}");
            return;
        }

        $apiToken = config('services.mista.api_token');
        $senderId = config('services.mista.sender_id');

        $phone = preg_replace('/[^0-9]/', '', $admin->phone);

        // Format Rwandan number e.g. 07xx → 2507xx
        if (Str::startsWith($phone, '07')) {
            $phone = '250' . substr($phone, 1);
        }

        $smsMessage = "{$title}\n\n{$message}\n\n- Tunga Market System";

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiToken,
                'accept' => 'application/json',
                'content-type' => 'application/json',
            ])->post('https://api.mista.io/sms', [
                'to' => $phone,
                'from' => $senderId,
                'message' => $smsMessage,
            ]);

            Log::info("📩 SMS sent to {$phone} ({$admin->email}) | Response: " . $response->body());
        } catch (\Exception $e) {
            Log::error("❌ Failed to send SMS to {$admin->email} ({$phone}): " . $e->getMessage());
        }
    }
}
