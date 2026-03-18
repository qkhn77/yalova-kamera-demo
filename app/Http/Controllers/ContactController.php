<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * İletişim formu gönderimi. Mesaj "Mail Ayarları"ndaki "Mesajın Geleceği E-Posta" adresine gider.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|string|max:50',
            'message' => 'required|string|max:5000',
        ], [
            'name.required' => 'Ad Soyad gerekli.',
            'email.required' => 'E-posta adresi gerekli.',
            'email.email' => 'Geçerli bir e-posta adresi girin.',
            'message.required' => 'Mesaj gerekli.',
        ]);

        $to = Setting::get('mail_recipient');
        if (empty($to)) {
            return back()->with('error', 'Mail alıcı adresi tanımlı değil. Lütfen yönetici ile iletişime geçin.');
        }

        try {
            Mail::send('emails.contact', $validated, function ($message) use ($to, $validated) {
                $message->to($to)
                    ->replyTo($validated['email'], $validated['name'])
                    ->subject('İletişim formu: ' . $validated['name']);
            });
        } catch (\Throwable $e) {
            return back()->with('error', 'Mesaj gönderilemedi. Lütfen daha sonra tekrar deneyin.');
        }

        return back()->with('success', 'Mesajınız alındı, en kısa sürede size dönüş yapacağız.');
    }
}
