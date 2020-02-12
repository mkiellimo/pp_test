<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OrdersRepository")
 */
class Orders
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
    private $order_id;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotNull
     */
    private $phone;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\OrdersItem", mappedBy="orders")
     */
    private $ordersItems;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotNull
     */
    private $shipping_status;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     * @Assert\NotNull
     */
    private $shipping_price;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotNull
     */
    private $shipping_payment_status;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotNull
     */
    private $payment_status;

    public function __construct()
    {
        $this->ordersItems = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrderId(): ?string
    {
        return $this->order_id;
    }

    public function setOrderId(string $order_id): self
    {
        $this->order_id = $order_id;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * @return Collection|OrdersItem[]
     */
    public function getOrdersItems(): Collection
    {
        return $this->ordersItems;
    }

    public function addOrdersItem(OrdersItem $ordersItem): self
    {
        if (!$this->ordersItems->contains($ordersItem)) {
            $this->ordersItems[] = $ordersItem;
            $ordersItem->setOrders($this);
        }

        return $this;
    }

    public function removeOrdersItem(OrdersItem $ordersItem): self
    {
        if ($this->ordersItems->contains($ordersItem)) {
            $this->ordersItems->removeElement($ordersItem);
            // set the owning side to null (unless already changed)
            if ($ordersItem->getOrders() === $this) {
                $ordersItem->setOrders(null);
            }
        }

        return $this;
    }

    public function getShippingStatus(): ?string
    {
        return $this->shipping_status;
    }

    public function setShippingStatus(string $shipping_status): self
    {
        $this->shipping_status = $shipping_status;

        return $this;
    }

    public function getShippingPrice(): ?string
    {
        return $this->shipping_price;
    }

    public function setShippingPrice(string $shipping_price): self
    {
        $this->shipping_price = $shipping_price;

        return $this;
    }

    public function getShippingPaymentStatus(): ?string
    {
        return $this->shipping_payment_status;
    }

    public function setShippingPaymentStatus(string $shipping_payment_status): self
    {
        $this->shipping_payment_status = $shipping_payment_status;

        return $this;
    }

    public function getPaymentStatus(): ?string
    {
        return $this->payment_status;
    }

    public function setPaymentStatus(string $payment_status): self
    {
        $this->payment_status = $payment_status;

        return $this;
    }
}
