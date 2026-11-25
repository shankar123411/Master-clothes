<?php

namespace App\Filament\Resources\Orders\Schemas;

use App\Models\Color;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Size;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class OrderForm
{
    public static function updateGrandTotal(callable $get, callable $set): void
    {
        $items = $get('../../items') ?? $get('items') ?? [];
        $grandTotal = 0;
        if (is_array($items)) {
            foreach ($items as $item) {
                $qty = floatval($item['quantity'] ?? 1);
                $price = floatval($item['unit_price'] ?? 0);
                $grandTotal += ($qty * $price);
            }
        }
        $set('../../grand_total', $grandTotal);
        $set('grand_total', $grandTotal);
    }

    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('1. Customer & Delivery Details')
                    ->columnSpanFull()
                    ->schema([
                        Grid::make(['default' => 1, 'md' => 3])->schema([
                            Select::make('customer_id')
                                ->label('Select Registered Wholesale Retailer')
                                ->options(Customer::query()->pluck('name', 'id'))
                                ->searchable()
                                ->live()
                                ->dehydrated(false)
                                ->columnSpan(['default' => 1, 'md' => 3])
                                ->afterStateUpdated(function ($state, $set) {
                                    if ($customer = Customer::find($state)) {
                                        $set('customer_name', $customer->name);
                                        $set('business_name', $customer->business_name);
                                        $set('phone', $customer->phone);
                                        $set('location', $customer->location);
                                    }
                                }),
                            TextInput::make('customer_name')->label('Customer Name')->required(),
                            TextInput::make('business_name')->label('Business Store Name')->required(),
                            TextInput::make('phone')->label('Phone Number')->tel()->required(),
                            TextInput::make('location')->label('Location / City')->default('Chennai')->required(),
                            TextInput::make('grand_total')
                                ->label('Grand Total Amount (₹)')
                                ->numeric()
                                ->prefix('₹')
                                ->required()
                                ->default(0)
                                ->readOnly(),
                        ]),
                    ]),

                Section::make('2. Order Items & Product Line Builder')
                    ->columnSpanFull()
                    ->schema([
                        Repeater::make('items')
                            ->label('Order Products List')
                            ->live()
                            ->afterStateUpdated(function ($get, $set) {
                                static::updateGrandTotal($get, $set);
                            })
                            ->schema([
                                Grid::make(['default' => 1, 'md' => 12])->schema([
                                    Select::make('product')
                                        ->label('Product Item')
                                        ->options(Product::query()->pluck('name', 'name'))
                                        ->searchable()
                                        ->required()
                                        ->live()
                                        ->columnSpan(['default' => 1, 'md' => 4])
                                        ->afterStateUpdated(function ($state, $set, $get) {
                                            if ($product = Product::where('name', $state)->first()) {
                                                $set('unit_price', $product->price);
                                                $qty = floatval($get('quantity') ?: 1);
                                                $set('total', $qty * $product->price);
                                            }
                                            static::updateGrandTotal($get, $set);
                                        }),
                                    Select::make('color')
                                        ->label('Color Swatch')
                                        ->options(Color::query()->pluck('name', 'name'))
                                        ->searchable()
                                        ->required()
                                        ->columnSpan(['default' => 1, 'md' => 3]),
                                    Select::make('size')
                                        ->label('Size Option')
                                        ->options(Size::query()->pluck('name', 'name'))
                                        ->searchable()
                                        ->required()
                                        ->columnSpan(['default' => 1, 'md' => 2]),
                                    TextInput::make('quantity')
                                        ->label('Qty')
                                        ->numeric()
                                        ->default(1)
                                        ->required()
                                        ->live(onBlur: false)
                                        ->columnSpan(['default' => 1, 'md' => 1])
                                        ->afterStateUpdated(function ($state, $set, $get) {
                                            $qty = floatval($state ?: 1);
                                            $price = floatval($get('unit_price') ?: 0);
                                            $set('total', $qty * $price);
                                            static::updateGrandTotal($get, $set);
                                        }),
                                    TextInput::make('unit_price')
                                        ->label('Unit Price')
                                        ->numeric()
                                        ->prefix('₹')
                                        ->required()
                                        ->live(onBlur: false)
                                        ->columnSpan(['default' => 1, 'md' => 2])
                                        ->afterStateUpdated(function ($state, $set, $get) {
                                            $qty = floatval($get('quantity') ?: 1);
                                            $price = floatval($state ?: 0);
                                            $set('total', $qty * $price);
                                            static::updateGrandTotal($get, $set);
                                        }),
                                ]),
                            ])
                            ->defaultItems(1)
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
