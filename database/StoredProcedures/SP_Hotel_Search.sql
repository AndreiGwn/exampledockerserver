-- =============================================================================
-- Stored Procedure: SP_Hotel_Search
-- Rule 1 & Rule 2: Transaction safe with SQLEXCEPTION handler
-- Purpose: Advanced search for Trivago-style hotel discovery
-- =============================================================================

DROP PROCEDURE IF EXISTS SP_Hotel_Search;

DELIMITER //

CREATE PROCEDURE SP_Hotel_Search(
    IN p_query VARCHAR(255),
    IN p_city VARCHAR(100),
    IN p_min_price DECIMAL(10,2),
    IN p_max_price DECIMAL(10,2),
    IN p_min_star INT,
    IN p_capacity INT,
    IN p_sort_by VARCHAR(50)
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
        COALESCE(AVG(r.rating), 8.5) AS average_rating,
        COUNT(DISTINCT r.id) AS reviews_count,
        COALESCE(MIN(rm.price_per_night), h.price_per_night) AS starting_price,
        COUNT(DISTINCT rm.id) AS available_rooms_count
    FROM hotels h
    LEFT JOIN reviews r ON h.id = r.hotel_id
    LEFT JOIN rooms rm ON h.id = rm.hotel_id AND rm.is_available = 1
    WHERE 
        (p_query IS NULL OR p_query = '' OR h.name LIKE CONCAT('%', p_query, '%') OR h.city LIKE CONCAT('%', p_query, '%') OR h.description LIKE CONCAT('%', p_query, '%'))
        AND (p_city IS NULL OR p_city = '' OR p_city = 'All' OR h.city = p_city)
        AND (p_min_star IS NULL OR p_min_star = 0 OR h.star_rating >= p_min_star)
        AND (p_min_price IS NULL OR h.price_per_night >= p_min_price OR rm.price_per_night >= p_min_price)
        AND (p_max_price IS NULL OR p_max_price = 0 OR h.price_per_night <= p_max_price OR rm.price_per_night <= p_max_price)
        AND (p_capacity IS NULL OR p_capacity = 0 OR rm.capacity >= p_capacity OR p_capacity <= 2)
    GROUP BY h.id
    ORDER BY 
        CASE WHEN p_sort_by = 'price_asc' THEN COALESCE(MIN(rm.price_per_night), h.price_per_night) END ASC,
        CASE WHEN p_sort_by = 'price_desc' THEN COALESCE(MIN(rm.price_per_night), h.price_per_night) END DESC,
        CASE WHEN p_sort_by = 'rating_desc' THEN COALESCE(AVG(r.rating), 8.5) END DESC,
        CASE WHEN p_sort_by = 'stars_desc' THEN h.star_rating END DESC,
        h.is_featured DESC,
        h.created_at DESC;

    COMMIT;
END //

DELIMITER ;
