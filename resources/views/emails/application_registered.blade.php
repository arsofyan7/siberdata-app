<x-mail::message>
# Pendaftaran APL-01 Berhasil!

Yth. **{{ $application->personal_data['full_name'] ?? 'Asesi' }}**,

Terima kasih telah mengajukan pendaftaran sertifikasi kompetensi di LSP Siberdata. Pendaftaran APL-01 Anda telah berhasil kami terima dan saat ini berstatus **Menunggu Verifikasi** (*Pending*).

Berikut adalah detail pendaftaran Anda:

- **Nomor Registrasi:** {{ $application->registration_number }}
- **Skema Uji:** {{ $application->scheme->name }} ({{ $application->scheme->code }})
- **Tgl Pendaftaran:** {{ $application->created_at->translatedFormat('l, d F Y') }}

<x-mail::panel>
**Langkah Selanjutnya:**
Tim Asesor kami akan meninjau kelengkapan dokumen dan data diri Anda. Harap pastikan seluruh Portofolio dasar sudah Anda lengkapi di portal Asesi. Anda akan menerima notifikasi lebih lanjut apabila dokumen sudah divalidasi.
</x-mail::panel>

<x-mail::button :url="route('asesi.index')">
Cek Status Pendaftaran
</x-mail::button>

Salam hangat,<br>
**Admin LSP Siberdata**
<br>
_Terakreditasi Nasional_
</x-mail::message>
