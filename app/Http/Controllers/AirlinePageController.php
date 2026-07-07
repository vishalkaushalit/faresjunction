<?php

namespace App\Http\Controllers;

use App\Models\AirlinePage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class AirlinePageController extends Controller
{
    public function index(): View
    {
        $airlinePages = AirlinePage::query()
            ->orderBy('sort_order')
            ->orderBy('name')
            ->paginate(10);

        return view('airlines.index', compact('airlinePages'));
    }

    public function create(): View
    {
        return view('airlines.create', [
            'airlinePage' => null,
            'sectionLabels' => AirlinePage::SECTION_LABELS,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validatedAirlinePageData($request);

        AirlinePage::create($validated);

        return redirect()->route('airline-pages.index')->with('success', 'Airline page added successfully.');
    }

    public function edit(AirlinePage $airlinePage): View
    {
        return view('airlines.edit', [
            'airlinePage' => $airlinePage,
            'sectionLabels' => AirlinePage::SECTION_LABELS,
        ]);
    }

    public function update(Request $request, AirlinePage $airlinePage): RedirectResponse
    {
        $validated = $this->validatedAirlinePageData($request, $airlinePage);

        $airlinePage->update($validated);

        return redirect()->route('airline-pages.index')->with('success', 'Airline page updated successfully.');
    }

    public function destroy(AirlinePage $airlinePage): RedirectResponse
    {
        $airlinePage->delete();

        return redirect()->route('airline-pages.index')->with('success', 'Airline page deleted successfully.');
    }

    private function validatedAirlinePageData(Request $request, ?AirlinePage $airlinePage = null): array
    {
        $slug = $request->filled('slug')
            ? Str::slug($request->input('slug'))
            : Str::slug($request->input('name'));

        $request->merge(['slug' => $slug]);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => [
                'required',
                'string',
                'max:255',
                'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/',
                Rule::unique('airline_pages', 'slug')->ignore($airlinePage),
            ],
            'code' => ['nullable', 'string', 'max:10'],
            'intro' => ['nullable', 'string', 'max:1000'],
            'routes_text' => ['nullable', 'string'],
            'faqs' => ['nullable', 'array'],
            'faqs.*.question' => ['nullable', 'string', 'max:255'],
            'faqs.*.answer' => ['nullable', 'string'],
            'sections' => ['nullable', 'array'],
            'sections.*.title' => ['nullable', 'string', 'max:255'],
            'sections.*.body' => ['nullable', 'string'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:1000'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'status' => ['nullable', 'boolean'],
        ]);

        return [
            'name' => $validated['name'],
            'slug' => $validated['slug'],
            'code' => $validated['code'] ?? null,
            'intro' => $validated['intro'] ?? null,
            'routes' => $this->normalizeRoutes($validated['routes_text'] ?? ''),
            'faqs' => $this->normalizeFaqs($validated['faqs'] ?? []),
            'sections' => $this->normalizeSections($validated['sections'] ?? []),
            'meta_title' => $validated['meta_title'] ?? null,
            'meta_description' => $validated['meta_description'] ?? null,
            'sort_order' => (int) ($validated['sort_order'] ?? 0),
            'status' => $request->boolean('status'),
        ];
    }

    private function normalizeRoutes(?string $routesText): array
    {
        return collect(preg_split('/\R/', (string) $routesText))
            ->map(fn (string $route): string => trim($route))
            ->filter()
            ->values()
            ->all();
    }

    private function normalizeSections(array $sections): array
    {
        return collect(AirlinePage::SECTION_LABELS)
            ->mapWithKeys(function (string $label, string $key) use ($sections): array {
                return [$key => [
                    'title' => trim($sections[$key]['title'] ?? '') ?: $label,
                    'body' => trim($sections[$key]['body'] ?? ''),
                ]];
            })
            ->all();
    }

    private function normalizeFaqs(array $faqs): array
    {
        return collect($faqs)
            ->map(fn (array $faq): array => [
                'question' => trim($faq['question'] ?? ''),
                'answer' => trim($faq['answer'] ?? ''),
            ])
            ->filter(fn (array $faq): bool => $faq['question'] !== '' && $faq['answer'] !== '')
            ->values()
            ->all();
    }
}
