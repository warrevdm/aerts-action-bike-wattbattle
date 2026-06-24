CREATE DATABASE IF NOT EXISTS wattbattle CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE wattbattle;

CREATE TABLE IF NOT EXISTS scores (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    competition ENUM('men', 'women', 'kids') NOT NULL DEFAULT 'men',
    wattage INT UNSIGNED NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_competition_wattage (competition, wattage, created_at)
);

-- Gebruik dit enkel als je de tabel al had aangemaakt zonder competition-kolom:
-- ALTER TABLE scores ADD COLUMN competition ENUM('men', 'women', 'kids') NOT NULL DEFAULT 'men' AFTER name;
-- CREATE INDEX idx_competition_wattage ON scores (competition, wattage, created_at);
