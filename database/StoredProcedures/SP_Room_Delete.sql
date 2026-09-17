-- =============================================================================
-- Stored Procedure: SP_Room_Delete
-- Rule 1 & Rule 2: Transaction safe with SQLEXCEPTION handler
-- =============================================================================

DROP PROCEDURE IF EXISTS SP_Room_Delete;

DELIMITER //

CREATE PROCEDURE SP_Room_Delete(
    IN p_id BIGINT UNSIGNED
)
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        ROLLBACK;
        RESIGNAL;
    END;

    START TRANSACTION;

    DELETE FROM rooms WHERE id = p_id;

    COMMIT;
END //

DELIMITER ;
