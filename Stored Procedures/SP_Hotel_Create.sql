-- =============================================================================
-- Stored Procedure: SP_Hotel_Create
-- Rule 1 & Rule 2: Transaction safe with SQLEXCEPTION handler
-- =============================================================================

DROP PROCEDURE IF EXISTS SP_Hotel_Create;

DELIMITER //

CREATE PROCEDURE SP_Hotel_Create(
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
    IN p_is_featured TINYINT(1),
    OUT p_id BIGINT UNSIGNED
)
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        ROLLBACK;
        RESIGNAL;
    END;

    START TRANSACTION;

    INSERT INTO hotels (
        user_id,
        name,
        description,
        city,
        address,
        star_rating,
        price_per_night,
        image_url,
        phone,
        email,
        is_featured,
        created_at,
        updated_at
    ) VALUES (
        p_user_id,
        p_name,
        p_description,
        p_city,
        p_address,
        COALESCE(p_star_rating, 3),
        COALESCE(p_price_per_night, 0.00),
        p_image_url,
        p_phone,
        p_email,
        COALESCE(p_is_featured, 0),
        NOW(),
        NOW()
    );

    SET p_id = LAST_INSERT_ID();

    COMMIT;
END //

DELIMITER ;
