<?php

namespace App\Entity;

use App\Repository\NftRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NftRepository::class)]
class Nft
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    private ?string $img = null;

    #[ORM\Column]
    private ?int $stock = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $launchDate = null;

    #[ORM\OneToMany(mappedBy: 'nft', targetEntity: NftPrice::class)]
    private Collection $nftPrices;

    public function __construct()
    {
        $this->nftPrices = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getImg(): ?string
    {
        return $this->img;
    }

    public function setImg(string $img): self
    {
        $this->img = $img;

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(int $stock): self
    {
        $this->stock = $stock;

        return $this;
    }

    public function getLaunchDate(): ?\DateTimeInterface
    {
        return $this->launchDate;
    }

    public function setLaunchDate(\DateTimeInterface $launchDate): self
    {
        $this->launchDate = $launchDate;

        return $this;
    }

    /**
     * @return Collection<int, NftPrice>
     */
    public function getNftPrices(): Collection
    {
        return $this->nftPrices;
    }

    public function addNftPrice(NftPrice $nftPrice): self
    {
        if (!$this->nftPrices->contains($nftPrice)) {
            $this->nftPrices->add($nftPrice);
            $nftPrice->setNft($this);
        }

        return $this;
    }

    public function removeNftPrice(NftPrice $nftPrice): self
    {
        if ($this->nftPrices->removeElement($nftPrice)) {
            // set the owning side to null (unless already changed)
            if ($nftPrice->getNft() === $this) {
                $nftPrice->setNft(null);
            }
        }

        return $this;
    }
}
