-- =============================================================================
-- Stored Procedure: SP_Room_Create
-- Rule 1 & Rule 2: Transaction safe with SQLEXCEPTION handler
-- =============================================================================

DROP PROCEDURE IF EXISTS SP_Room_Create;

DELIMITER //

CREATE PROCEDURE SP_Room_Create(
    IN p_hotel_id BIGINT UNSIGNED,
    IN p_name VARCHAR(255),
    IN p_room_type VARCHAR(100),
    IN p_price_per_night DECIMAL(10,2),
    IN p_capacity INT,
    IN p_beds VARCHAR(100),
    IN p_description TEXT,
    IN p_image_url VARCHAR(500),
    IN p_is_available TINYINT(1),
    OUT p_id BIGINT UNSIGNED
)
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        ROLLBACK;
        RESIGNAL;
    END;

    START TRANSACTION;

    INSERT INTO rooms (
        hotel_id,
        name,
        room_type,
        price_per_night,
        capacity,
        beds,
        description,
        image_url,
        is_available,
        created_at,
        updated_at
    ) VALUES (
        p_hotel_id,
        p_name,
        COALESCE(p_room_type, 'Standard Room'),
        p_price_per_night,
        COALESCE(p_capacity, 2),
        COALESCE(p_beds, '1 Queen Bed'),
        p_description,
        p_image_url,
        COALESCE(p_is_available, 1),
        NOW(),
        NOW()
    );

    SET p_id = LAST_INSERT_ID();

    COMMIT;
END //

DELIMITER ;
