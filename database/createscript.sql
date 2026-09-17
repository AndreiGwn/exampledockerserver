-- ==============================================================================
-- GSHotel Platform - Database Creation Script
-- Luxury 4-5 Star Hotels in the Netherlands with Instant Guest Reservations
-- ==============================================================================

SET FOREIGN_KEY_CHECKS = 0;

-- 1. Hotels Table
DROP TABLE IF EXISTS hotel_amenities;
DROP TABLE IF EXISTS reviews;
DROP TABLE IF EXISTS reservations;
DROP TABLE IF EXISTS rooms;
DROP TABLE IF EXISTS amenities;
DROP TABLE IF EXISTS hotels;

CREATE TABLE hotels (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    city VARCHAR(100) NOT NULL,
    address VARCHAR(255) NOT NULL,
    star_rating TINYINT UNSIGNED NOT NULL DEFAULT 5, -- 4 or 5 stars
    price_per_night DECIMAL(10, 2) NOT NULL,
    description TEXT NOT NULL,
    image_url VARCHAR(500) NOT NULL,
    gallery_images JSON NULL,
    featured BOOLEAN NOT NULL DEFAULT TRUE,
    rating_score DECIMAL(3, 1) NOT NULL DEFAULT 4.9,
    phone VARCHAR(50) NULL,
    email VARCHAR(255) NULL,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_city (city),
    INDEX idx_stars (star_rating),
    INDEX idx_price (price_per_night)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 2. Rooms / Suites Table
CREATE TABLE rooms (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    hotel_id BIGINT UNSIGNED NOT NULL,
    name VARCHAR(255) NOT NULL,
    room_type VARCHAR(100) NOT NULL, -- e.g. Executive Suite, Presidential Suite, Deluxe Canal View
    price_per_night DECIMAL(10, 2) NOT NULL,
    max_guests INT UNSIGNED NOT NULL DEFAULT 2,
    bed_type VARCHAR(100) NOT NULL DEFAULT 'King Size',
    description TEXT NULL,
    image_url VARCHAR(500) NULL,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (hotel_id) REFERENCES hotels(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 3. Amenities Table
CREATE TABLE amenities (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE,
    icon VARCHAR(100) NOT NULL,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 4. Hotel Amenities Pivot Table
CREATE TABLE hotel_amenities (
    hotel_id BIGINT UNSIGNED NOT NULL,
    amenity_id BIGINT UNSIGNED NOT NULL,
    PRIMARY KEY (hotel_id, amenity_id),
    FOREIGN KEY (hotel_id) REFERENCES hotels(id) ON DELETE CASCADE,
    FOREIGN KEY (amenity_id) REFERENCES amenities(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 5. Guest Reservations Table
CREATE TABLE reservations (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    reservation_code VARCHAR(32) NOT NULL UNIQUE,
    hotel_id BIGINT UNSIGNED NOT NULL,
    room_id BIGINT UNSIGNED NULL,
    guest_name VARCHAR(255) NOT NULL,
    guest_email VARCHAR(255) NOT NULL,
    guest_phone VARCHAR(50) NOT NULL,
    guest_address VARCHAR(255) NULL,
    check_in DATE NULL,
    check_out DATE NULL,
    guests_count INT UNSIGNED NOT NULL DEFAULT 2,
    special_requests TEXT NULL,
    session_id VARCHAR(100) NULL,
    status VARCHAR(50) NOT NULL DEFAULT 'Confirmed',
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_reservation_code (reservation_code),
    INDEX idx_guest_email (guest_email),
    INDEX idx_session (session_id),
    FOREIGN KEY (hotel_id) REFERENCES hotels(id) ON DELETE CASCADE,
    FOREIGN KEY (room_id) REFERENCES rooms(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

SET FOREIGN_KEY_CHECKS = 1;
