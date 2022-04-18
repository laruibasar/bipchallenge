<?php

namespace Model;

use Core\DataModel\Model;

class Turbine extends Model
{
    protected static string $table = 'turbines';

    private ?int $id;

    private ?string $identifier;

    private ?string $producer;

    private ?float $latitude;

    private ?float $longitude;

    /**
     * @return string|null
     */
    public function getIdentifier(): ?string
    {
        return $this->identifier;
    }

    /**
     * @param string|null $identifier
     */
    public function setIdentifier(?string $identifier): void
    {
        $this->identifier = $identifier;
    }

    /**
     * @return string|null
     */
    public function getProducer(): ?string
    {
        return $this->producer;
    }

    /**
     * @param string|null $producer
     */
    public function setProducer(?string $producer): void
    {
        $this->producer = $producer;
    }

    /**
     * @return float|null
     */
    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    /**
     * @param float|null $latitude
     */
    public function setLatitude(?float $latitude): void
    {
        $this->latitude = $latitude;
    }

    /**
     * @return float|null
     */
    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    /**
     * @param float|null $longitude
     */
    public function setLongitude(?float $longitude): void
    {
        $this->longitude = $longitude;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * Return the information about the location of the turbine
     * @return array
     */
    public function getAddress(): array
    {
        return [
            'identifier' => $this->identifier,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude
        ];
    }
}