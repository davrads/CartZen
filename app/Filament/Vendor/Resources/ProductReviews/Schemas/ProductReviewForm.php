<?php

namespace App\Filament\Vendor\Resources\ProductReviews\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ProductReviewForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Review Details')
                    ->columns(2)
                    ->schema([

                        TextInput::make('product.name')
                            ->label('Product')
                            ->disabled(),

                        TextInput::make('customer.name')
                            ->label('Customer')
                            ->disabled(),

                        TextInput::make('rating')
                            ->label('Rating')
                            ->suffix('/5')
                            ->disabled(),

                        TextInput::make('created_at')
                            ->label('Reviewed On')
                            ->disabled(),

                        Textarea::make('comment')
                            ->label('Review')
                            ->rows(6)
                            ->columnSpanFull()
                            ->disabled(),

                    ]),
            ]);
    }
}
