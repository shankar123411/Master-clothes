<?php

namespace App\Filament\Resources\Orders\Tables;

use App\Models\Order;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class OrdersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('order_id')->searchable()->sortable()->weight('bold')->color('primary'),
                TextColumn::make('customer_name')->searchable()->sortable(),
                TextColumn::make('business_name')->searchable(),
                TextColumn::make('phone')->searchable(),
                TextColumn::make('grand_total')->money('INR')->sortable()->weight('bold'),
                TextColumn::make('created_at')->dateTime('M d, Y H:i')->sortable(),
            ])
            ->recordActions([
                ViewAction::make('view')
                    ->label('Order Slip')
                    ->icon('heroicon-o-document-text')
                    ->color('primary'),
                Action::make('whatsapp')
                    ->label('WhatsApp')
                    ->icon('heroicon-o-chat-bubble-left-ellipsis')
                    ->color('success')
                    ->url(fn (Order $record): string => '/admin/orders/' . $record->id . '?share=1'),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
