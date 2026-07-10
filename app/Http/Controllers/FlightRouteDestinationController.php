<?php

namespace App\Http\Controllers;

use App\Models\FlightRouteDestination;
use App\Models\FlightCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class FlightRouteDestinationController extends Controller
{
    public function index(Request $request): View
    {
        $type = $this->typeFromRequest($request);
        $items = FlightRouteDestination::query()
            ->with('category')
            ->where('type', $type)
            ->latest()
            ->paginate(10);

        return view('flight-route-destinations.index', [
            'items' => $items,
            'type' => $type,
            ...$this->labels($type),
        ]);
    }

    public function create(Request $request): View
    {
        $type = $this->typeFromRequest($request);

        return view('flight-route-destinations.create', [
            'item' => null,
            'categories' => $this->categoriesForSelect(),
            'type' => $type,
            ...$this->labels($type),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $type = $this->typeFromRequest($request);
        $validated = $this->validatedData($request, $type);
        $validated['type'] = $type;

        if ($request->hasFile('image')) {
            $validated['image_original_name'] = $request->file('image')->getClientOriginalName();
            $validated['image_path'] = $this->storeImage($request, $type);
        }

        FlightRouteDestination::create($validated);

        return redirect()->route($this->routeName($type, 'index'))
            ->with('success', $this->labels($type)['singularTitle'] . ' added successfully.');
    }

    public function show(Request $request, FlightRouteDestination $flightRouteDestination): View
    {
        $type = $this->typeFromRequest($request);
        $this->abortIfWrongType($flightRouteDestination, $type);

        return view('flight-route-destinations.show', [
            'item' => $flightRouteDestination->load('category'),
            'type' => $type,
            ...$this->labels($type),
        ]);
    }

    public function edit(Request $request, FlightRouteDestination $flightRouteDestination): View
    {
        $type = $this->typeFromRequest($request);
        $this->abortIfWrongType($flightRouteDestination, $type);

        return view('flight-route-destinations.edit', [
            'item' => $flightRouteDestination,
            'categories' => $this->categoriesForSelect(),
            'type' => $type,
            ...$this->labels($type),
        ]);
    }

    public function update(Request $request, FlightRouteDestination $flightRouteDestination): RedirectResponse
    {
        $type = $this->typeFromRequest($request);
        $this->abortIfWrongType($flightRouteDestination, $type);

        $validated = $this->validatedData($request, $type);

        if ($request->hasFile('image')) {
            $this->deleteFile($flightRouteDestination->image_path);
            $validated['image_original_name'] = $request->file('image')->getClientOriginalName();
            $validated['image_path'] = $this->storeImage($request, $type);
        }

        $flightRouteDestination->update($validated);

        return redirect()->route($this->routeName($type, 'index'))
            ->with('success', $this->labels($type)['singularTitle'] . ' updated successfully.');
    }

    public function destroy(Request $request, FlightRouteDestination $flightRouteDestination): RedirectResponse
    {
        $type = $this->typeFromRequest($request);
        $this->abortIfWrongType($flightRouteDestination, $type);

        $this->deleteFile($flightRouteDestination->image_path);
        $flightRouteDestination->delete();

        return redirect()->route($this->routeName($type, 'index'))
            ->with('success', $this->labels($type)['singularTitle'] . ' deleted successfully.');
    }

    private function validatedData(Request $request, string $type): array
    {
        return $request->validate([
            'flight_category_id' => ['nullable', 'integer', Rule::exists('flight_categories', 'id')],
            'route_text' => ['required', 'string', 'max:255'],
            'trip_type' => ['required', Rule::in(array_keys(FlightRouteDestination::TRIP_TYPES))],
            'cabin_class' => ['required', Rule::in(array_keys(FlightRouteDestination::CABIN_CLASSES))],
            'pricing' => ['nullable', 'string', 'max:255'],
            'tag' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'is_published' => ['nullable', 'boolean'],
            'image' => ['nullable', 'image', 'max:2048'],
        ]) + [
            'is_published' => $request->boolean('is_published'),
        ];
    }

    private function typeFromRequest(Request $request): string
    {
        return Str::startsWith((string) $request->route()?->getName(), 'flight-destinations.')
            ? FlightRouteDestination::TYPE_DESTINATION
            : FlightRouteDestination::TYPE_ROUTE;
    }

    private function labels(string $type): array
    {
        if ($type === FlightRouteDestination::TYPE_DESTINATION) {
            return [
                'pluralTitle' => 'Flight Destinations',
                'singularTitle' => 'Flight Destination',
                'itemLabel' => 'Destination',
                'imageLabel' => 'Destination Image',
                'addButtonLabel' => 'Add Destination',
                'routePrefix' => 'flight-destinations',
            ];
        }

        return [
            'pluralTitle' => 'Flight Routes',
            'singularTitle' => 'Flight Route',
            'itemLabel' => 'Route',
            'imageLabel' => 'Route Image',
            'addButtonLabel' => 'Add Route',
            'routePrefix' => 'flight-routes',
        ];
    }

    private function categoriesForSelect()
    {
        return FlightCategory::query()->orderBy('name')->get();
    }

    private function routeName(string $type, string $action): string
    {
        return $this->labels($type)['routePrefix'] . '.' . $action;
    }

    private function storeImage(Request $request, string $type): string
    {
        $file = $request->file('image');
        $directory = $type === FlightRouteDestination::TYPE_DESTINATION
            ? 'flight-destinations'
            : 'flight-routes';

        return $this->storeWithUniqueName($file, $directory);
    }

    private function deleteFile(?string $path): void
    {
        if ($path && ! Str::startsWith($path, ['http://', 'https://', '/'])) {
            Storage::disk('public')->delete($path);
        }
    }

    private function abortIfWrongType(FlightRouteDestination $item, string $type): void
    {
        abort_unless($item->type === $type, 404);
    }
}
