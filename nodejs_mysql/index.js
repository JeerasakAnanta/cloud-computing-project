const express = require('express');
const mysql = require('mysql2');
const bodyParser = require('body-parser');

const app = express();
const port = 3000;

// Middleware
app.use(bodyParser.json());
app.use(express.static('frontend')); // Serve static files from frontend directory


// MySQL Database Connection
require('dotenv').config();

const db = mysql.createConnection({
    host: process.env.DB_HOST,
    user: process.env.DB_USER,
    password: process.env.DB_PASSWORD,
    database: process.env.DB_NAME
});


// Connect to the Database
db.connect(err => {
    if (err) {
        console.error('Database connection error:', err.stack);
        return;
    }
    console.log('Connected to database');
});

// Create Menu Item
app.post('/menu', (req, res) => {
    const { name, description, price } = req.body;
    db.query('INSERT INTO menu (name, description, price) VALUES (?, ?, ?)', 
             [name, description, price], (err, result) => {
        if (err) return res.status(500).json(err);
        res.status(201).json({ id: result.insertId, name, description, price });
    });
});

// Get Menu Items
app.get('/menu', (req, res) => {
    db.query('SELECT * FROM menu', (err, results) => {
        if (err) return res.status(500).json(err);
        res.status(200).json(results);
    });
});

// Update Menu Item
app.put('/menu/:id', (req, res) => {
    const { id } = req.params;
    const { name, description, price } = req.body;
    db.query('UPDATE menu SET name = ?, description = ?, price = ? WHERE id = ?', 
             [name, description, price, id], (err) => {
        if (err) return res.status(500).json(err);
        res.status(200).json({ message: 'Menu item updated' });
    });
});

// Delete Menu Item
app.delete('/menu/:id', (req, res) => {
    const { id } = req.params;
    db.query('DELETE FROM menu WHERE id = ?', [id], (err) => {
        if (err) return res.status(500).json(err);
        res.status(204).send();
    });
});

// Start Server
app.listen(port, () => {
    console.log(`Server running at http://localhost:${port}`);
});