<?php

namespace App\Filament\Vendor\Resources\ProductReviews\Pages;

use App\Filament\Vendor\Resources\ProductReviews\ProductReviewResource;
use Filament\Resources\Pages\ViewRecord;

class ViewProductReview extends ViewRecord
{
    protected static string $resource = ProductReviewResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}