<?php

namespace App\Filament\Resources\Orders\Pages;

use App\Filament\Resources\Orders\OrderResource;
use Filament\Resources\Pages\CreateRecord;

class CreateOrder extends CreateRecord
{
    protected static string $resource = OrderResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $items = $data['items'] ?? $data['items_json'] ?? [];
        if (is_array($items)) {
            $data['items_json'] = $items;

            $grandTotal = 0;
            foreach ($items as $item) {
                $qty = floatval($item['quantity'] ?? 1);
                $price = floatval($item['unit_price'] ?? 0);
                $grandTotal += ($qty * $price);
            }
            $data['grand_total'] = $grandTotal;
        }

        unset($data['customer_id']);
        unset($data['items']);

        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
