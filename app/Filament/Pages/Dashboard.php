<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Schemas\Components\Livewire;
use Filament\Widgets\WidgetConfiguration;

class Dashboard extends BaseDashboard
{
    public function getWidgetsSchemaComponents(array $widgets, array $data = []): array
    {
        return collect($widgets)
            ->values()
            ->filter(fn (string | WidgetConfiguration $widget): bool => $this->normalizeWidgetClass($widget)::canView())
            ->map(function (string | WidgetConfiguration $widget, int $widgetKey) use ($data): Livewire {
                $widgetClass = $this->normalizeWidgetClass($widget);

                $component = Livewire::make(
                    $widgetClass,
                    fn (): array => [
                        ...$this->getWidgetData(),
                        ...$data,
                        ...(($widget instanceof WidgetConfiguration) ? [
                            ...$widget->widget::getDefaultProperties(),
                            ...$widget->getProperties(),
                        ] : $widget::getDefaultProperties()),
                        ...(property_exists($this, 'filters') ? ['pageFilters' => $this->filters] : []),
                    ],
                )
                ->key("{$widgetClass}-{$widgetKey}")
                ->liberatedFromContainerGrid();

                try {
                    $widgetInstance = app($widgetClass);
                    $span = $widgetInstance->getColumnSpan();
                    if ($span) {
                        $component->columnSpan($span);
                    }
                    $start = $widgetInstance->getColumnStart();
                    if ($start) {
                        $component->columnStart($start);
                    }
                } catch (\Throwable $e) {
                    // Fallback gracefully
                }

                return $component;
            })
            ->all();
    }
}
