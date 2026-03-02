-- Tabela para as marcações de consultas
-- Executa este SQL no phpMyAdmin (base de dados medi_trust_bd)

CREATE TABLE IF NOT EXISTS marcacoes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(50) NOT NULL,
  email VARCHAR(100) NOT NULL,
  telemovel VARCHAR(20) NOT NULL,
  departmento VARCHAR(50) NOT NULL,
  data DATE NOT NULL,
  doutor VARCHAR(50) NOT NULL,
  descricao TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
