-- =============================================================================
-- Stored Procedure: SP_Room_ReadByHotel
-- Rule 1 & Rule 2: Transaction safe with SQLEXCEPTION handler
-- =============================================================================

DROP PROCEDURE IF EXISTS SP_Room_ReadByHotel;

DELIMITER //

CREATE PROCEDURE SP_Room_ReadByHotel(
    IN p_hotel_id BIGINT UNSIGNED
)
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        ROLLBACK;
        RESIGNAL;
    END;

    START TRANSACTION;

    SELECT 
        r.id,
        r.hotel_id,
        r.name,
        r.room_type,
        r.price_per_night,
        r.capacity,
        r.beds,
        r.description,
        r.image_url,
        r.is_available,
        r.created_at,
        r.updated_at
    FROM rooms r
    WHERE r.hotel_id = p_hotel_id
    ORDER BY r.price_per_night ASC;

    COMMIT;
END //

DELIMITER ;
