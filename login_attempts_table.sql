
-- Tabella già inclusa nel database.sql ma fornita anche separatamente per chiarezza
CREATE TABLE IF NOT EXISTS login_attempts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50),
    ip_address VARCHAR(45),
    status ENUM('success', 'failed'),
    attempt_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
