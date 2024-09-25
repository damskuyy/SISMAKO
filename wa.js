import pkg from 'whatsapp-web.js';
const { Client, LocalAuth } = pkg;
import qrcode from 'qrcode-terminal';

const client = new Client({
    authStrategy: new LocalAuth(),
});



// Event: Saat kode QR dihasilkan
client.on('qr', (qr) => {
    qrcode.generate(qr, { small: true });
});

// Event: Ketika klien berhasil terhubung
client.on('ready', () => {
    console.log('Client is ready!');
});

// Fungsi untuk mengirim pesan
const sendMessage = async (data) => {

    console.log(data)
    const chatIds = [
        '6289514563365@c.us',
    ];

    const now = new Date();

    // Mendapatkan nama hari, tanggal, bulan, dan tahun dalam format yang diinginkan
    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    const formattedDate = now.toLocaleDateString('id-ID', options);


    // Hasil akhir: "Sabtu, 14 September 2024 07:53:22"
    const result = `${formattedDate}}`;

    // Format pesan
    const message = `SMK TI BAZMA
Akses LAB : ${result}

Nama            : ${data.siswa.nama}
Kelas             : ${data.class}
Jam Masuk     : ${data.start}
Project Guru  : ${data.guru.nama}
Keterangan    : ${data.siswa.nama}

Bagi bapak ibu guru yang memberi tugas, harap mengawasi langsung via CCTV.

Bagi Bapak/ibu yang tidak merasa memberikan tugas, silahkan untuk ditindaklanjuti.

Notification sent by the system
E-Absensi Digital SMK TI BAZMA
`;


    // Kirim pesan
    for (const chatId of chatIds) {
        try {
            const response = await client.sendMessage(chatId, message);
            console.log(`Message sent to ${chatId}:`, response);
        } catch (err) {
            console.error(`Error sending message to ${chatId}:`, err);
        }
    }
};

// Memulai klien WhatsApp
client.initialize();

// Ekspor fungsi
export default sendMessage;
