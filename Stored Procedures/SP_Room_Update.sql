-- =============================================================================
-- Stored Procedure: SP_Room_Update
-- Rule 1 & Rule 2: Transaction safe with SQLEXCEPTION handler
-- =============================================================================

DROP PROCEDURE IF EXISTS SP_Room_Update;

DELIMITER //

CREATE PROCEDURE SP_Room_Update(
    IN p_id BIGINT UNSIGNED,
    IN p_name VARCHAR(255),
    IN p_room_type VARCHAR(100),
    IN p_price_per_night DECIMAL(10,2),
    IN p_capacity INT,
    IN p_beds VARCHAR(100),
    IN p_description TEXT,
    IN p_image_url VARCHAR(500),
    IN p_is_available TINYINT(1)
)
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        ROLLBACK;
        RESIGNAL;
    END;

    START TRANSACTION;

    UPDATE rooms
    SET 
        name = COALESCE(p_name, name),
        room_type = COALESCE(p_room_type, room_type),
        price_per_night = COALESCE(p_price_per_night, price_per_night),
        capacity = COALESCE(p_capacity, capacity),
        beds = COALESCE(p_beds, beds),
        description = COALESCE(p_description, description),
        image_url = COALESCE(p_image_url, image_url),
        is_available = COALESCE(p_is_available, is_available),
        updated_at = NOW()
    WHERE id = p_id;

    COMMIT;
END //

DELIMITER ;
