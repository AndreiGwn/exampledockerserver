-- =============================================================================
-- Stored Procedure: SP_Hotel_ReadAll
-- Rule 1 & Rule 2: Transaction safe with SQLEXCEPTION handler
-- =============================================================================

DROP PROCEDURE IF EXISTS SP_Hotel_ReadAll;

DELIMITER //

CREATE PROCEDURE SP_Hotel_ReadAll()
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
        COALESCE(AVG(r.rating), 8.5) AS average_rating,
        COUNT(DISTINCT r.id) AS reviews_count,
        COALESCE(MIN(rm.price_per_night), h.price_per_night) AS starting_price,
        COUNT(DISTINCT rm.id) AS total_rooms
    FROM hotels h
    LEFT JOIN reviews r ON h.id = r.hotel_id
    LEFT JOIN rooms rm ON h.id = rm.hotel_id AND rm.is_available = 1
    GROUP BY h.id
    ORDER BY h.is_featured DESC, h.star_rating DESC, h.created_at DESC;

    COMMIT;
END //

DELIMITER ;
