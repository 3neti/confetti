<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Spatie\SchemalessAttributes\SchemalessAttributes;
use Spatie\SchemalessAttributes\SchemalessAttributesTrait;

trait HasCampaignFeatures
{
    use SchemalessAttributesTrait;

    public function initializeHasCampaignFeatures()
    {
        $this->fillable = array_merge(
            $this->fillable,
            [
                'age',
                'gender',
                'lgu',
                'precinct',
            ]
        );
        $this->casts = array_merge($this->casts, ['features' => SchemalessAttributes::class]);
    }

    protected $schemalessAttributes = ['features',];

    public function scopeWithFeatures(): Builder
    {
        return $this->features->modelScope(); // me thinks this only works with PHP 8.0
    }

    public function getAgeAttribute(): int
    {
        return $this->features['age'];
    }

    public function setAgeAttribute(int $value): self
    {
        $this->features['age'] = $value;

        return $this;
    }

    public function getGenderAttribute(): string
    {
        return $this->features['gender'];
    }

    public function setGenderAttribute(string $value): self
    {
        $this->features['gender'] = $value;

        return $this;
    }

    public function getLGUAttribute(): string
    {
        return $this->features['lgu'];
    }

    public function setLGUAttribute(string $value): self
    {
        $this->features['lgu'] = $value;

        return $this;
    }

    public function getPrecinctAttribute(): string
    {
        return $this->features['precinct'];
    }

    public function setPrecinctAttribute(string $value): self
    {
        $this->features['precinct'] = $value;

        return $this;
    }
}
