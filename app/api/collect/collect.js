export default function handler(req, res) {
    if (req.method === 'POST') {
        const email = req.body.email;
        console.log("Received email:", email);
        res.send("Thanks! We got your email.");
    } else {
        res.status(405).send("Only POST allowed");
    }
}