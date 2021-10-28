<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Spatie\SchemalessAttributes\SchemalessAttributes;
use Spatie\SchemalessAttributes\SchemalessAttributesTrait;

trait HasPostFeatures
{
    use SchemalessAttributesTrait;

    public function initializeHasPostFeatures()
    {
        $this->fillable = array_merge(
            $this->fillable,
            [
                'cluster',
                'bei',
                'sealed',
                'duration',
                'police',
                'military',
                'president',
                'vicepresident',
                'governor',
                'congressman',
                'mayor',
                'printed',
                'transmitted',
                'retrieved',
                'candidate1',
                'candidate2',
                'candidate3',
                'candidate4',
                'candidate5',
                'incident',
                'action',
                'remarks',
                'geotag'
            ]
        );
        $this->casts = array_merge($this->casts, ['features' => SchemalessAttributes::class]);
    }

    protected $schemalessAttributes = ['features',];

    public function scopeWithFeatures(): Builder
    {
        return $this->features->modelScope(); // me thinks this only works with PHP 8.0
    }

    public function getClusterAttribute(): string
    {
        return $this->features['cluster'];
    }

    public function setClusterAttribute(string $value): self
    {
        $this->features['cluster'] = $value;

        return $this;
    }

    public function getBeiAttribute(): string
    {
        return $this->features['bei'];
    }

    public function setBeiAttribute(string $value): self
    {
        $this->features['bei'] = $value;

        return $this;
    }

    public function getSealedAttribute(): bool
    {
        return $this->features['sealed'];
    }

    public function setSealedAttribute(bool $value): self
    {
        $this->features['sealed'] = $value;

        return $this;
    }

    public function getDurationAttribute(): int
    {
        return $this->features['duration'];
    }

    public function setDurationAttribute(string $value): self
    {
        $this->features['duration'] = $value;

        return $this;
    }

    public function getPoliceAttribute(): bool
    {
        return $this->features['police'];
    }

    public function setPoliceAttribute(bool $value): self
    {
        $this->features['police'] = $value;

        return $this;
    }

    public function getMilitaryAttribute(): bool
    {
        return $this->features['military'];
    }

    public function setMilitaryAttribute(bool $value): self
    {
        $this->features['military'] = $value;

        return $this;
    }

    public function getPresidentAttribute(): string
    {
        return $this->features['president'];
    }

    public function setPresidentAttribute(string $value): self
    {
        $this->features['president'] = $value;

        return $this;
    }

    public function getVicePresidentAttribute(): string
    {
        return $this->features['vicepresident'];
    }

    public function setVicePresidentAttribute(string $value): self
    {
        $this->features['vicepresident'] = $value;

        return $this;
    }

    public function getGovernorAttribute(): string
    {
        return $this->features['governor'];
    }

    public function setGovernorAttribute(string $value): self
    {
        $this->features['governor'] = $value;

        return $this;
    }

    public function getCongressmanAttribute(): string
    {
        return $this->features['congressman'];
    }

    public function setCongressmanAttribute(string $value): self
    {
        $this->features['congressman'] = $value;

        return $this;
    }

    public function getMayorAttribute(): string
    {
        return $this->features['mayor'];
    }

    public function setMayorAttribute(string $value): self
    {
        $this->features['mayor'] = $value;

        return $this;
    }

    public function getPrintedAttribute(): bool
    {
        return $this->features['printed'];
    }

    public function setPrintedAttribute(bool $value): self
    {
        $this->features['printed'] = $value;

        return $this;
    }

    public function getTransmittedAttribute(): bool
    {
        return $this->features['transmitted'];
    }

    public function setTransmittedAttribute(bool $value): self
    {
        $this->features['transmitted'] = $value;

        return $this;
    }

    public function getRetrievedAttribute(): bool
    {
        return $this->features['retrieved'];
    }

    public function setRetrievedAttribute(bool $value): self
    {
        $this->features['retrieved'] = $value;

        return $this;
    }

    public function getCandidate1Attribute(): int
    {
        return $this->features['candidate1'];
    }

    public function setCandidate1Attribute(string $value): self
    {
        $this->features['candidate1'] = $value;

        return $this;
    }

    public function getCandidate2Attribute(): int
    {
        return $this->features['candidate2'];
    }

    public function setCandidate2Attribute(string $value): self
    {
        $this->features['candidate2'] = $value;

        return $this;
    }

    public function getCandidate3Attribute(): int
    {
        return $this->features['candidate3'];
    }

    public function setCandidate3Attribute(string $value): self
    {
        $this->features['candidate3'] = $value;

        return $this;
    }

    public function getCandidate4Attribute(): int
    {
        return $this->features['candidate4'];
    }

    public function setCandidate4Attribute(string $value): self
    {
        $this->features['candidate4'] = $value;

        return $this;
    }

    public function getCandidate5Attribute(): int
    {
        return $this->features['candidate5'];
    }

    public function setCandidate5Attribute(string $value): self
    {
        $this->features['candidate5'] = $value;

        return $this;
    }

    public function getIncidentAttribute(): string
    {
        return $this->features['incident'];
    }

    public function setIncidentAttribute(string $value): self
    {
        $this->features['incident'] = $value;

        return $this;
    }

    public function getActionAttribute(): string
    {
        return $this->features['action'];
    }

    public function setActionAttribute(string $value): self
    {
        $this->features['action'] = $value;

        return $this;
    }

    public function getRemarksAttribute(): string
    {
        return $this->features['remarks'];
    }

    public function setRemarksAttribute(string $value): self
    {
        $this->features['remarks'] = $value;

        return $this;
    }

    public function getGeotagAttribute(): array
    {
        return $this->features['geotag'];
    }

    public function setGeotagAttribute(array $value): self
    {
        $this->features['geotag'] = $value;

        return $this;
    }
}
