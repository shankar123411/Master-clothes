<?php

namespace App\Filament\Resources\Orders\Pages;

use App\Filament\Resources\Orders\OrderResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditOrder extends EditRecord
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $raw = $data['items'] ?? $data['items_json'] ?? null;
        if (is_string($raw)) {
            $raw = json_decode($raw, true);
        }
        $data['items'] = is_array($raw) ? $raw : [];
        $data['items_json'] = $data['items'];

        // Auto-match and select the Registered Retailer in dropdown
        if (empty($data['customer_id'])) {
            $cust = null;
            if (!empty($data['phone'])) {
                $cust = \App\Models\Customer::where('phone', $data['phone'])->first();
            }
            if (!$cust && !empty($data['customer_name'])) {
                $cust = \App\Models\Customer::where('name', $data['customer_name'])->first();
            }
            if (!$cust && !empty($data['business_name'])) {
                $cust = \App\Models\Customer::where('business_name', $data['business_name'])->first();
            }
            if ($cust) {
                $data['customer_id'] = $cust->id;
            }
        }

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
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
