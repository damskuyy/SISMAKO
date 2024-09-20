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
const sendMessage = async (nama = 'Fadhil Rabbani') => {

    const chatIds = [
        '6289514563365@c.us',
    ];

    const now = new Date();
    const hours = String(now.getHours()).padStart(2, '0');
    const minutes = String(now.getMinutes()).padStart(2, '0');
    const seconds = String(now.getSeconds()).padStart(2, '0');

    const formattedTime = `${hours}:${minutes}:${seconds}`;

    // Format pesan
    const message = `
Reuni STAN 80
Hotel Harris FX Soedirman - Jakarta
Registrasi: Sabtu 31 Agustus 2024

Nama             : ${nama}
Waktu Hadir  : ${formattedTime}

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
