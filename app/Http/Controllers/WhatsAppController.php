<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WhatsAppController extends Controller
{
    public function sendMessage(Request $request)
    {
        // Ambil nama dari request (default 'Fadhil Rabbani' jika tidak ada)
        $name = $request->input('name', 'Fadhil Rabbani');

        // Path ke file wa.js
        $waScriptPath = 'file://' . str_replace('\\', '/', base_path('wa.js'));

        // Perintah Node.js untuk menjalankan sendMessage
        $nodeCommand = 'node -e "import(\'' . addslashes($waScriptPath) . '\').then(module => module.default(\'' . addslashes($name) . '\'))"';

        // Jalankan perintah node.js
        shell_exec(command: $nodeCommand);

        // Kirim respon ke pengguna
        return response()->json([
            'message' => 'WhatsApp message sent',
            'output' => 'succes',
        ]);
    }
}
