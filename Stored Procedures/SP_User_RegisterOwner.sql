-- =============================================================================
-- Stored Procedure: SP_User_RegisterOwner
-- Rule 1 & Rule 2: Transaction safe with SQLEXCEPTION handler
-- Purpose: Register an Eigenaar (Hotel Owner) account
-- =============================================================================

DROP PROCEDURE IF EXISTS SP_User_RegisterOwner;

DELIMITER //

CREATE PROCEDURE SP_User_RegisterOwner(
    IN p_name VARCHAR(255),
    IN p_email VARCHAR(255),
    IN p_password VARCHAR(255),
    IN p_phone VARCHAR(50),
    IN p_company_name VARCHAR(255),
    OUT p_id BIGINT UNSIGNED
)
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        ROLLBACK;
        RESIGNAL;
    END;

    START TRANSACTION;

    INSERT INTO users (
        name,
        email,
        password,
        role,
        phone,
        company_name,
        created_at,
        updated_at
    ) VALUES (
        p_name,
        p_email,
        p_password,
        'eigenaar',
        p_phone,
        p_company_name,
        NOW(),
        NOW()
    );

    SET p_id = LAST_INSERT_ID();

    COMMIT;
END //

DELIMITER ;
