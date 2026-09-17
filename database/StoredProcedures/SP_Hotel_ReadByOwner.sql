-- =============================================================================
-- Stored Procedure: SP_Hotel_ReadByOwner
-- Rule 1 & Rule 2: Transaction safe with SQLEXCEPTION handler
-- =============================================================================

DROP PROCEDURE IF EXISTS SP_Hotel_ReadByOwner;

DELIMITER //

CREATE PROCEDURE SP_Hotel_ReadByOwner(
    IN p_user_id BIGINT UNSIGNED
)
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        ROLLBACK;
        RESIGNAL;
    END;

    START TRANSACTION;

    SELECT 
        h.id,
        h.user_id,
        h.name,
        h.description,
        h.city,
        h.address,
        h.star_rating,
        h.price_per_night,
        h.image_url,
        h.phone,
        h.email,
        h.is_featured,
        h.created_at,
        h.updated_at,
        COUNT(DISTINCT rm.id) AS rooms_count,
        COALESCE(AVG(r.rating), 8.5) AS average_rating
    FROM hotels h
    LEFT JOIN rooms rm ON h.id = rm.hotel_id
    LEFT JOIN reviews r ON h.id = r.hotel_id
    WHERE h.user_id = p_user_id
    GROUP BY h.id
    ORDER BY h.created_at DESC;

    COMMIT;
END //

DELIMITER ;
