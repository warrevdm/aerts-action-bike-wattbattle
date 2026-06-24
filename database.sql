CREATE DATABASE IF NOT EXISTS wattbattle CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE wattbattle;

CREATE TABLE IF NOT EXISTS scores (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL,
    newsletter_optin TINYINT(1) NOT NULL DEFAULT 0,
    competition ENUM('men', 'women', 'kids') NOT NULL DEFAULT 'men',
    wattage INT UNSIGNED NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_competition_wattage (competition, wattage, created_at),
    INDEX idx_email (email),
    INDEX idx_newsletter_optin (newsletter_optin)
);

-- Gebruik dit enkel als je de tabel al had aangemaakt zonder nieuwe kolommen:
-- ALTER TABLE scores ADD COLUMN email VARCHAR(150) NOT NULL AFTER name;
-- ALTER TABLE scores ADD COLUMN newsletter_optin TINYINT(1) NOT NULL DEFAULT 0 AFTER email;
-- ALTER TABLE scores ADD COLUMN competition ENUM('men', 'women', 'kids') NOT NULL DEFAULT 'men' AFTER newsletter_optin;
-- CREATE INDEX idx_competition_wattage ON scores (competition, wattage, created_at);
-- CREATE INDEX idx_email ON scores (email);
-- CREATE INDEX idx_newsletter_optin ON scores (newsletter_optin);
