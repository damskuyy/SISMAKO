import express from 'express';
import sendMessage from './wa.js';

const app = express();
const port = 5000;

app.use(express.json());


app.post('/send-whatsapp-message', async (req, res) => {
    console.log(req.body)
    const { data } = req.body;

    if ( !data ) {
        return res.status(400).json({ error: 'Missing required fields' });
    }

    try {
        const response = await sendMessage(data);
        res.json({ message: 'Message sent successfully', response });
    } catch (error) {
        res.status(500).json({ error: 'Error while sending message', details: error.message });
    }
});

app.listen(port, () => {
    console.log(`Server is running on http://localhost:${port}`);
});
