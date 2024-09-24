const express = require('express');
const router = express.Router();
const db = require('../db'); // Módulo para interagir com o banco de dados

// Rota para listar todos os projetos
router.get('/', (req, res) => {
    db.query('SELECT * FROM projetos', (err, result) => {
        if (err) {
            console.error('Erro ao buscar projetos:', err);
            res.status(500).json({ mensagem: 'Erro ao buscar projetos' });
        } else {
            res.status(200).json(result);
        }
    });
});

// Outras rotas para criar, atualizar e excluir projetos
// Exemplo:
// router.post('/', (req, res) => { ... });

module.exports = router;
