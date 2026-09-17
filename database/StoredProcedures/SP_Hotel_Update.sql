-- =============================================================================
-- Stored Procedure: SP_Hotel_Update
-- Rule 1 & Rule 2: Transaction safe with SQLEXCEPTION handler
-- =============================================================================

DROP PROCEDURE IF EXISTS SP_Hotel_Update;

DELIMITER //

CREATE PROCEDURE SP_Hotel_Update(
    IN p_id BIGINT UNSIGNED,
    IN p_user_id BIGINT UNSIGNED,
    IN p_name VARCHAR(255),
    IN p_description TEXT,
    IN p_city VARCHAR(100),
    IN p_address VARCHAR(255),
    IN p_star_rating INT,
    IN p_price_per_night DECIMAL(10,2),
    IN p_image_url VARCHAR(500),
    IN p_phone VARCHAR(50),
    IN p_email VARCHAR(255),
    IN p_is_featured TINYINT(1)
)
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        ROLLBACK;
        RESIGNAL;
    END;

    START TRANSACTION;

    UPDATE hotels
    SET 
        name = COALESCE(p_name, name),
        description = COALESCE(p_description, description),
        city = COALESCE(p_city, city),
        address = COALESCE(p_address, address),
        star_rating = COALESCE(p_star_rating, star_rating),
        price_per_night = COALESCE(p_price_per_night, price_per_night),
        image_url = COALESCE(p_image_url, image_url),
        phone = COALESCE(p_phone, phone),
        email = COALESCE(p_email, email),
        is_featured = COALESCE(p_is_featured, is_featured),
        updated_at = NOW()
    WHERE id = p_id AND (p_user_id IS NULL OR user_id = p_user_id);

    COMMIT;
END //

DELIMITER ;
