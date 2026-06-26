
-- =====================================================
-- Innovation Dashboard Database
-- Version : 1.0.0
-- =====================================================

DROP DATABASE IF EXISTS innovation_dashboard;
CREATE DATABASE innovation_dashboard
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE innovation_dashboard;

CREATE TABLE opd (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_opd VARCHAR(150) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE innovations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    opd_id INT NOT NULL,
    judul_inovasi VARCHAR(255) NOT NULL,
    deskripsi TEXT,
    tanggal_inovasi DATE NOT NULL,
    status ENUM('diajukan','dikembalikan','terverifikasi')
        DEFAULT 'diajukan',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_innovation_opd
        FOREIGN KEY (opd_id) REFERENCES opd(id)
        ON DELETE RESTRICT
        ON UPDATE CASCADE,
    INDEX idx_opd (opd_id),
    INDEX idx_tanggal (tanggal_inovasi),
    INDEX idx_status (status)
);

CREATE TABLE opd_statistics (
    id INT AUTO_INCREMENT PRIMARY KEY,
    opd_id INT NOT NULL,
    tahun YEAR NOT NULL,
    total_inovator INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_statistics_opd
        FOREIGN KEY (opd_id) REFERENCES opd(id)
        ON DELETE RESTRICT
        ON UPDATE CASCADE,
    UNIQUE KEY uk_opd_tahun (opd_id,tahun)
);