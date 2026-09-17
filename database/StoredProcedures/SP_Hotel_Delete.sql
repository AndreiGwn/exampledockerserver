-- =============================================================================
-- Stored Procedure: SP_Hotel_Delete
-- Rule 1 & Rule 2: Transaction safe with SQLEXCEPTION handler
-- =============================================================================

DROP PROCEDURE IF EXISTS SP_Hotel_Delete;

DELIMITER //

CREATE PROCEDURE SP_Hotel_Delete(
    IN p_id BIGINT UNSIGNED,
    IN p_user_id BIGINT UNSIGNED
)
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        ROLLBACK;
        RESIGNAL;
    END;

    START TRANSACTION;

    -- Delete associated rooms and amenities first if cascade is not direct
    DELETE FROM rooms WHERE hotel_id = p_id;
    DELETE FROM hotel_amenities WHERE hotel_id = p_id;
    DELETE FROM reviews WHERE hotel_id = p_id;

    DELETE FROM hotels 
    WHERE id = p_id AND (p_user_id IS NULL OR user_id = p_user_id);

    COMMIT;
END //

DELIMITER ;
