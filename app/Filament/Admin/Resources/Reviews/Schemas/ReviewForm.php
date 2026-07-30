<?php

namespace App\Filament\Admin\Resources\Reviews\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ReviewForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Section::make('Review Information')
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
                            ->columnSpanFull()
                            ->rows(5)
                            ->disabled(),

                    ]),
            ]);
    }
}