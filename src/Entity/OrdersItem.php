<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OrdersItemRepository")
 */
class OrdersItem
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $barcode;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Orders", inversedBy="ordersItems")
     * @ORM\JoinColumn(nullable=false)
     */
    private $orders;

    /**
     * @ORM\Column(type="decimal", precision=12, scale=2)
     * @Assert\NotBlank
     */
    private $price;

    /**
     * @ORM\Column(type="decimal", precision=12, scale=2)
     * @Assert\NotBlank
     */
    private $cost;

    /**
     * @ORM\Column(type="smallint")
     * @Assert\NotBlank
     */
    private $tax_perc;

    /**
     * @ORM\Column(type="decimal", precision=12, scale=2)
     * @Assert\NotBlank
     */
    private $tax_amt;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank
     */
    private $quantity;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $tracking_number;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank
     */
    private $canceled;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank
     */
    private $shipped_status_sku;

    public function getId(): ?int
    {
        return $this->id;
    }
    

    public function getBarcode(): ?string
    {
        return $this->barcode;
    }

    public function setBarcode(string $barcode): self
    {
        $this->barcode = $barcode;

        return $this;
    }

    public function getOrders(): ?Orders
    {
        return $this->orders;
    }

    public function setOrders(?Orders $orders): self
    {
        $this->orders = $orders;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getCost(): ?string
    {
        return $this->cost;
    }

    public function setCost(string $cost): self
    {
        $this->cost = $cost;

        return $this;
    }

    public function getTaxPerc(): ?int
    {
        return $this->tax_perc;
    }

    public function setTaxPerc(int $tax_perc): self
    {
        $this->tax_perc = $tax_perc;

        return $this;
    }

    public function getTaxAmt(): ?string
    {
        return $this->tax_amt;
    }

    public function setTaxAmt(string $tax_amt): self
    {
        $this->tax_amt = $tax_amt;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getTrackingNumber(): ?string
    {
        return $this->tracking_number;
    }

    public function setTrackingNumber(string $tracking_number): self
    {
        $this->tracking_number = $tracking_number;

        return $this;
    }

    public function getCanceled(): ?string
    {
        return $this->cancelled;
    }

    public function setCanceled(string $canceled): self
    {
        $this->canceled = $canceled;

        return $this;
    }

    public function getShippedStatusSku(): ?string
    {
        return $this->shipped_status_sku;
    }

    public function setShippedStatusSku(string $shipped_status_sku): self
    {
        $this->shipped_status_sku = $shipped_status_sku;

        return $this;
    }

}
