ALTER TABLE `tasks`
    ADD `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL,
    ADD `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL;

