const express = require('express');
const mysql = require('mysql');
const bodyParser = require('body-parser');

const app = express();
const port = 3000;

const db = mysql.createConnection({
    host: 'localhost',
    user: 'seu_usuario',
    password: 'sua_senha',
    database: 'sua_base_de_dados'
});

db.connect(err => {
    if (err) {
        console.error('Erro ao conectar ao banco de dados:', err);
    } else {
        console.log('Conectado ao banco de dados MySQL');
    }
});

app.use(bodyParser.json());

// Rotas para gerenciar projetos, clientes e usuários
app.use('/projetos', require('./routes/projetos'));
app.use('/clientes', require('./routes/clientes'));
app.use('/usuarios', require('./routes/usuarios'));

app.listen(port, () => {
    console.log(`Servidor rodando na porta ${port}`);
});
