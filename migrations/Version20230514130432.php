<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230514130432 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE nft_price (id INT AUTO_INCREMENT NOT NULL, nft_id INT NOT NULL, price_date DATETIME NOT NULL, price_eth_value DOUBLE PRECISION NOT NULL, INDEX IDX_8D397C7AE813668D (nft_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE nft_price ADD CONSTRAINT FK_8D397C7AE813668D FOREIGN KEY (nft_id) REFERENCES nft (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE nft_price DROP FOREIGN KEY FK_8D397C7AE813668D');
        $this->addSql('DROP TABLE nft_price');
    }
}
