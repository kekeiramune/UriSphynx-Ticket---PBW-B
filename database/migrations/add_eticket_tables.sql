-- ============================================
-- E-Ticket System Database Setup
-- ============================================

-- Step 1: Add new columns to existing transactions table
ALTER TABLE `transactions` 
ADD COLUMN `approved_at` timestamp NULL DEFAULT NULL AFTER `updated_at`,
ADD COLUMN `approved_by` bigint UNSIGNED NULL DEFAULT NULL AFTER `approved_at`,
ADD COLUMN `admin_notes` text NULL DEFAULT NULL AFTER `approved_by`;

-- Step 2: Create tickets table for e-tickets
CREATE TABLE `tickets` (
  `id_ticket` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `transaction_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `id_concert` int NOT NULL,
  `id_price` int NOT NULL,
  `ticket_code` varchar(50) NOT NULL,
  `qr_code_path` varchar(255) DEFAULT NULL,
  `status` enum('active','used','expired','cancelled') NOT NULL DEFAULT 'active',
  `used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_ticket`),
  UNIQUE KEY `tickets_ticket_code_unique` (`ticket_code`),
  KEY `fk_tickets_transaction` (`transaction_id`),
  KEY `fk_tickets_user` (`user_id`),
  KEY `fk_tickets_concert` (`id_concert`),
  KEY `fk_tickets_price` (`id_price`),
  CONSTRAINT `fk_tickets_transaction` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id_transaction`) ON DELETE CASCADE,
  CONSTRAINT `fk_tickets_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_tickets_concert` FOREIGN KEY (`id_concert`) REFERENCES `concerts` (`id_concert`) ON DELETE CASCADE,
  CONSTRAINT `fk_tickets_price` FOREIGN KEY (`id_price`) REFERENCES `concert_price` (`id_price`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Step 3: Optional - Drop payment_transactions table if not needed
-- DROP TABLE IF EXISTS `payment_transactions`;

-- Verification queries
-- SELECT * FROM tickets LIMIT 5;
-- SHOW COLUMNS FROM transactions LIKE 'approved%';
