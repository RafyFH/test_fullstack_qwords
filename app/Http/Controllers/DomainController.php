<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Domain;

class DomainController extends Controller
{
    public function check(Request $request)
    {
        $request->validate([
            'domain' => 'required|string'
        ]);

        $domain = $request->input('domain');

        // 1. Cek ke API
        $response = Http::get("https://portal.qwords.com/apitest/whois.php?domain={$domain}");

        // 2. Jika API berhasil, lakukan pengecekan
        if ($response->successful()) {
            $data = $response->json();

            // Cek status domain dari API
            if (isset($data['status']) && $data['status'] === 'available') {
                // 3. Cek ke database
                $domainExistsInDB = Domain::where('domain_name', $domain)->exists();

                // Jika domain tidak ada di database, maka tersedia
                if (!$domainExistsInDB) {
                    return response()->json([
                        'available' => true,
                        'message' => 'Domain is available for registration!',
                    ]);
                } else {
                    return response()->json([
                        'available' => false,
                        'message' => 'Domain is already taken in our database.',
                    ]);
                }
            } else {
                return response()->json([
                    'available' => false,
                    'message' => 'Domain is already taken according to the API.',
                ]);
            }
        }

        return response()->json([
            'available' => false,
            'message' => 'Error checking domain availability.',
        ], 500);
    }
}
