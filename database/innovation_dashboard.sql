
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



INSERT INTO opd (nama_opd) VALUES
('Dinas Kesehatan'),
('Dinas Tenaga Kerja'),
('Dinas Komunikasi dan Informatika'),
('Bappeda'),
('Dinas Pendidikan'),
('Dinas Pertanian'),
('Dinas PUPR'),
('Satpol PP');

INSERT INTO opd_statistics (opd_id,tahun,total_inovator) VALUES
(1,2024,12),(1,2025,15),(1,2026,18),
(2,2024,8),(2,2025,10),(2,2026,12),
(3,2024,9),(3,2025,11),(3,2026,14),
(4,2024,6),(4,2025,7),(4,2026,9),
(5,2024,14),(5,2025,17),(5,2026,20),
(6,2024,5),(6,2025,6),(6,2026,8),
(7,2024,10),(7,2025,12),(7,2026,15),
(8,2024,4),(8,2025,5),(8,2026,6);

INSERT INTO innovations (opd_id,judul_inovasi,deskripsi,tanggal_inovasi,status) VALUES
(1,'Smart Monitoring OPD 1-2024-1','Dummy inovasi 1','2024-01-15','terverifikasi'),
(1,'Digital Archive OPD 1-2024-2','Dummy inovasi 2','2024-02-15','terverifikasi'),
(1,'e-Report OPD 1-2024-3','Dummy inovasi 3','2024-03-15','terverifikasi'),
(1,'Portal Data OPD 1-2024-4','Dummy inovasi 4','2024-04-15','terverifikasi'),
(1,'Smart Monitoring OPD 1-2025-1','Dummy inovasi 5','2025-01-15','terverifikasi'),
(1,'Digital Archive OPD 1-2025-2','Dummy inovasi 6','2025-02-15','terverifikasi'),
(1,'e-Report OPD 1-2025-3','Dummy inovasi 7','2025-03-15','diajukan'),
(1,'Portal Data OPD 1-2025-4','Dummy inovasi 8','2025-04-15','dikembalikan'),
(1,'Smart Monitoring OPD 1-2026-1','Dummy inovasi 9','2026-01-15','terverifikasi'),
(1,'Digital Archive OPD 1-2026-2','Dummy inovasi 10','2026-02-15','terverifikasi'),
(1,'e-Report OPD 1-2026-3','Dummy inovasi 11','2026-03-15','terverifikasi'),
(1,'Portal Data OPD 1-2026-4','Dummy inovasi 12','2026-04-15','terverifikasi'),
(2,'Digital Archive OPD 2-2024-1','Dummy inovasi 13','2024-01-15','terverifikasi'),
(2,'e-Report OPD 2-2024-2','Dummy inovasi 14','2024-02-15','terverifikasi'),
(2,'Portal Data OPD 2-2024-3','Dummy inovasi 15','2024-03-15','diajukan'),
(2,'Mobile Service OPD 2-2024-4','Dummy inovasi 16','2024-04-15','dikembalikan'),
(2,'Digital Archive OPD 2-2025-1','Dummy inovasi 17','2025-01-15','terverifikasi'),
(2,'e-Report OPD 2-2025-2','Dummy inovasi 18','2025-02-15','terverifikasi'),
(2,'Portal Data OPD 2-2025-3','Dummy inovasi 19','2025-03-15','terverifikasi'),
(2,'Mobile Service OPD 2-2025-4','Dummy inovasi 20','2025-04-15','terverifikasi'),
(2,'Digital Archive OPD 2-2026-1','Dummy inovasi 21','2026-01-15','terverifikasi'),
(2,'e-Report OPD 2-2026-2','Dummy inovasi 22','2026-02-15','terverifikasi'),
(2,'Portal Data OPD 2-2026-3','Dummy inovasi 23','2026-03-15','diajukan'),
(2,'Mobile Service OPD 2-2026-4','Dummy inovasi 24','2026-04-15','dikembalikan'),
(3,'e-Report OPD 3-2024-1','Dummy inovasi 25','2024-01-15','terverifikasi'),
(3,'Portal Data OPD 3-2024-2','Dummy inovasi 26','2024-02-15','terverifikasi'),
(3,'Mobile Service OPD 3-2024-3','Dummy inovasi 27','2024-03-15','terverifikasi'),
(3,'Smart Queue OPD 3-2024-4','Dummy inovasi 28','2024-04-15','terverifikasi'),
(3,'e-Report OPD 3-2025-1','Dummy inovasi 29','2025-01-15','terverifikasi'),
(3,'Portal Data OPD 3-2025-2','Dummy inovasi 30','2025-02-15','terverifikasi'),
(3,'Mobile Service OPD 3-2025-3','Dummy inovasi 31','2025-03-15','diajukan'),
(3,'Smart Queue OPD 3-2025-4','Dummy inovasi 32','2025-04-15','dikembalikan'),
(3,'e-Report OPD 3-2026-1','Dummy inovasi 33','2026-01-15','terverifikasi'),
(3,'Portal Data OPD 3-2026-2','Dummy inovasi 34','2026-02-15','terverifikasi'),
(3,'Mobile Service OPD 3-2026-3','Dummy inovasi 35','2026-03-15','terverifikasi'),
(3,'Smart Queue OPD 3-2026-4','Dummy inovasi 36','2026-04-15','terverifikasi'),
(4,'Portal Data OPD 4-2024-1','Dummy inovasi 37','2024-01-15','terverifikasi'),
(4,'Mobile Service OPD 4-2024-2','Dummy inovasi 38','2024-02-15','terverifikasi'),
(4,'Smart Queue OPD 4-2024-3','Dummy inovasi 39','2024-03-15','diajukan'),
(4,'e-Office OPD 4-2024-4','Dummy inovasi 40','2024-04-15','dikembalikan'),
(4,'Portal Data OPD 4-2025-1','Dummy inovasi 41','2025-01-15','terverifikasi'),
(4,'Mobile Service OPD 4-2025-2','Dummy inovasi 42','2025-02-15','terverifikasi'),
(4,'Smart Queue OPD 4-2025-3','Dummy inovasi 43','2025-03-15','terverifikasi'),
(4,'e-Office OPD 4-2025-4','Dummy inovasi 44','2025-04-15','terverifikasi'),
(4,'Portal Data OPD 4-2026-1','Dummy inovasi 45','2026-01-15','terverifikasi'),
(4,'Mobile Service OPD 4-2026-2','Dummy inovasi 46','2026-02-15','terverifikasi'),
(4,'Smart Queue OPD 4-2026-3','Dummy inovasi 47','2026-03-15','diajukan'),
(4,'e-Office OPD 4-2026-4','Dummy inovasi 48','2026-04-15','dikembalikan'),
(5,'Mobile Service OPD 5-2024-1','Dummy inovasi 49','2024-01-15','terverifikasi'),
(5,'Smart Queue OPD 5-2024-2','Dummy inovasi 50','2024-02-15','terverifikasi'),
(5,'e-Office OPD 5-2024-3','Dummy inovasi 51','2024-03-15','terverifikasi'),
(5,'SIM Pelayanan OPD 5-2024-4','Dummy inovasi 52','2024-04-15','terverifikasi'),
(5,'Mobile Service OPD 5-2025-1','Dummy inovasi 53','2025-01-15','terverifikasi'),
(5,'Smart Queue OPD 5-2025-2','Dummy inovasi 54','2025-02-15','terverifikasi'),
(5,'e-Office OPD 5-2025-3','Dummy inovasi 55','2025-03-15','diajukan'),
(5,'SIM Pelayanan OPD 5-2025-4','Dummy inovasi 56','2025-04-15','dikembalikan'),
(5,'Mobile Service OPD 5-2026-1','Dummy inovasi 57','2026-01-15','terverifikasi'),
(5,'Smart Queue OPD 5-2026-2','Dummy inovasi 58','2026-02-15','terverifikasi'),
(5,'e-Office OPD 5-2026-3','Dummy inovasi 59','2026-03-15','terverifikasi'),
(5,'SIM Pelayanan OPD 5-2026-4','Dummy inovasi 60','2026-04-15','terverifikasi'),
(6,'Smart Queue OPD 6-2024-1','Dummy inovasi 61','2024-01-15','terverifikasi'),
(6,'e-Office OPD 6-2024-2','Dummy inovasi 62','2024-02-15','terverifikasi'),
(6,'SIM Pelayanan OPD 6-2024-3','Dummy inovasi 63','2024-03-15','diajukan'),
(6,'Smart Monitoring OPD 6-2024-4','Dummy inovasi 64','2024-04-15','dikembalikan'),
(6,'Smart Queue OPD 6-2025-1','Dummy inovasi 65','2025-01-15','terverifikasi'),
(6,'e-Office OPD 6-2025-2','Dummy inovasi 66','2025-02-15','terverifikasi'),
(6,'SIM Pelayanan OPD 6-2025-3','Dummy inovasi 67','2025-03-15','terverifikasi'),
(6,'Smart Monitoring OPD 6-2025-4','Dummy inovasi 68','2025-04-15','terverifikasi'),
(6,'Smart Queue OPD 6-2026-1','Dummy inovasi 69','2026-01-15','terverifikasi'),
(6,'e-Office OPD 6-2026-2','Dummy inovasi 70','2026-02-15','terverifikasi'),
(6,'SIM Pelayanan OPD 6-2026-3','Dummy inovasi 71','2026-03-15','diajukan'),
(6,'Smart Monitoring OPD 6-2026-4','Dummy inovasi 72','2026-04-15','dikembalikan'),
(7,'e-Office OPD 7-2024-1','Dummy inovasi 73','2024-01-15','terverifikasi'),
(7,'SIM Pelayanan OPD 7-2024-2','Dummy inovasi 74','2024-02-15','terverifikasi'),
(7,'Smart Monitoring OPD 7-2024-3','Dummy inovasi 75','2024-03-15','terverifikasi'),
(7,'Digital Archive OPD 7-2024-4','Dummy inovasi 76','2024-04-15','terverifikasi'),
(7,'e-Office OPD 7-2025-1','Dummy inovasi 77','2025-01-15','terverifikasi'),
(7,'SIM Pelayanan OPD 7-2025-2','Dummy inovasi 78','2025-02-15','terverifikasi'),
(7,'Smart Monitoring OPD 7-2025-3','Dummy inovasi 79','2025-03-15','diajukan'),
(7,'Digital Archive OPD 7-2025-4','Dummy inovasi 80','2025-04-15','dikembalikan'),
(7,'e-Office OPD 7-2026-1','Dummy inovasi 81','2026-01-15','terverifikasi'),
(7,'SIM Pelayanan OPD 7-2026-2','Dummy inovasi 82','2026-02-15','terverifikasi'),
(7,'Smart Monitoring OPD 7-2026-3','Dummy inovasi 83','2026-03-15','terverifikasi'),
(7,'Digital Archive OPD 7-2026-4','Dummy inovasi 84','2026-04-15','terverifikasi'),
(8,'SIM Pelayanan OPD 8-2024-1','Dummy inovasi 85','2024-01-15','terverifikasi'),
(8,'Smart Monitoring OPD 8-2024-2','Dummy inovasi 86','2024-02-15','terverifikasi'),
(8,'Digital Archive OPD 8-2024-3','Dummy inovasi 87','2024-03-15','diajukan'),
(8,'e-Report OPD 8-2024-4','Dummy inovasi 88','2024-04-15','dikembalikan'),
(8,'SIM Pelayanan OPD 8-2025-1','Dummy inovasi 89','2025-01-15','terverifikasi'),
(8,'Smart Monitoring OPD 8-2025-2','Dummy inovasi 90','2025-02-15','terverifikasi'),
(8,'Digital Archive OPD 8-2025-3','Dummy inovasi 91','2025-03-15','terverifikasi'),
(8,'e-Report OPD 8-2025-4','Dummy inovasi 92','2025-04-15','terverifikasi'),
(8,'SIM Pelayanan OPD 8-2026-1','Dummy inovasi 93','2026-01-15','terverifikasi'),
(8,'Smart Monitoring OPD 8-2026-2','Dummy inovasi 94','2026-02-15','terverifikasi'),
(8,'Digital Archive OPD 8-2026-3','Dummy inovasi 95','2026-03-15','diajukan'),
(8,'e-Report OPD 8-2026-4','Dummy inovasi 96','2026-04-15','dikembalikan');