@php
    $isActive = (int) old('status', $airlinePage?->exists ? $airlinePage->status : 1) === 1;
    $routesText = old('routes_text', implode(PHP_EOL, $airlinePage?->routes ?? []));
    $faqs = old('faqs', $airlinePage?->faqs ?? []);
    $faqs = count($faqs) ? $faqs : [['question' => '', 'answer' => '']];
    $sections = old('sections', $airlinePage?->mergedSections() ?? []);
@endphp

<div class="row">
    <div class="col-md-6 mb-3">
        <label for="name" class="form-label fw-bold">Airline Name</label>
        <input type="text" id="name" name="name" class="form-control"
            value="{{ old('name', $airlinePage?->name) }}" required>
    </div>

    <div class="col-md-3 mb-3">
        <label for="code" class="form-label fw-bold">Airline Code</label>
        <input type="text" id="code" name="code" class="form-control"
            value="{{ old('code', $airlinePage?->code) }}" placeholder="AA">
    </div>

    <div class="col-md-3 mb-3">
        <label for="sort_order" class="form-label fw-bold">Sort Order</label>
        <input type="number" id="sort_order" name="sort_order" min="0" class="form-control"
            value="{{ old('sort_order', $airlinePage?->sort_order ?? 0) }}">
    </div>

    <div class="col-md-6 mb-3">
        <label for="slug" class="form-label fw-bold">Slug</label>
        <input type="text" id="slug" name="slug" class="form-control"
            value="{{ old('slug', $airlinePage?->slug) }}" placeholder="american-airlines">
        <small class="text-muted">Leave blank to generate from the airline name.</small>
    </div>

    <div class="col-md-6 mb-3">
        <label for="meta_title" class="form-label fw-bold">Meta Title</label>
        <input type="text" id="meta_title" name="meta_title" class="form-control"
            value="{{ old('meta_title', $airlinePage?->meta_title) }}">
    </div>

    <div class="col-md-12 mb-3">
        <label for="intro" class="form-label fw-bold">Intro</label>
        <textarea id="intro" name="intro" rows="3" class="form-control">{{ old('intro', $airlinePage?->intro) }}</textarea>
    </div>

    <div class="col-md-12 mb-3">
        <label for="meta_description" class="form-label fw-bold">Meta Description</label>
        <textarea id="meta_description" name="meta_description" rows="2" class="form-control">{{ old('meta_description', $airlinePage?->meta_description) }}</textarea>
    </div>

    <div class="col-md-12 mb-3">
        <label for="routes_text" class="form-label fw-bold">Popular Routes</label>
        <textarea id="routes_text" name="routes_text" rows="6" class="form-control"
            placeholder="Detroit (DTW) to Orlando (MCO)">{{ $routesText }}</textarea>
        <small class="text-muted">Enter one route per line.</small>
    </div>

    <div class="col-md-12 mb-3">
        <div class="accordion" id="airlineSectionsAccordion">
            @foreach ($sectionLabels as $key => $label)
                @php
                    $section = $sections[$key] ?? ['title' => $label, 'body' => ''];
                    $collapseId = 'airline-section-' . $key;
                @endphp
                <div class="accordion-item">
                    <h2 class="accordion-header" id="{{ $collapseId }}-heading">
                        <button class="accordion-button fw-bold {{ $loop->first ? '' : 'collapsed' }}" type="button"
                            data-bs-toggle="collapse" data-bs-target="#{{ $collapseId }}"
                            aria-expanded="{{ $loop->first ? 'true' : 'false' }}"
                            aria-controls="{{ $collapseId }}">
                            {{ $label }}
                        </button>
                    </h2>
                    <div id="{{ $collapseId }}" class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}"
                        aria-labelledby="{{ $collapseId }}-heading" data-bs-parent="#airlineSectionsAccordion">
                        <div class="accordion-body">
                            <div class="mb-3">
                                <label for="section-{{ $key }}-title" class="form-label fw-bold">Section Title</label>
                                <input type="text" id="section-{{ $key }}-title"
                                    name="sections[{{ $key }}][title]" class="form-control"
                                    value="{{ $section['title'] ?? $label }}">
                            </div>
                            <div>
                                <label for="section-{{ $key }}-body" class="form-label fw-bold">Section Body</label>
                                <textarea id="section-{{ $key }}-body" name="sections[{{ $key }}][body]" rows="4"
                                    class="form-control">{{ $section['body'] ?? '' }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="accordion-item">
                <h2 class="accordion-header" id="airline-faqs-heading">
                    <button class="accordion-button fw-bold collapsed" type="button"
                        data-bs-toggle="collapse" data-bs-target="#airline-faqs"
                        aria-expanded="false" aria-controls="airline-faqs">
                        FAQs
                    </button>
                </h2>
                <div id="airline-faqs" class="accordion-collapse collapse"
                    aria-labelledby="airline-faqs-heading" data-bs-parent="#airlineSectionsAccordion">
                    <div class="accordion-body">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <label class="form-label fw-bold mb-0">FAQs</label>
                            <button type="button" class="btn btn-sm btn-outline-primary" id="add-airline-faq">Add FAQ</button>
                        </div>
                        <div class="border rounded p-3 bg-light" id="airline-faq-items">
                            @foreach ($faqs as $index => $faq)
                                <div class="airline-faq-item border rounded p-3 mb-3 bg-white">
                                    <div class="row g-3">
                                        <div class="col-md-12">
                                            <label class="form-label fw-bold" for="faq-{{ $index }}-question">Question</label>
                                            <input type="text" id="faq-{{ $index }}-question"
                                                name="faqs[{{ $index }}][question]" class="form-control"
                                                value="{{ $faq['question'] ?? '' }}"
                                                placeholder="How can I check in for this airline?">
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label fw-bold" for="faq-{{ $index }}-answer">Answer</label>
                                            <textarea id="faq-{{ $index }}-answer" name="faqs[{{ $index }}][answer]" rows="3"
                                                class="form-control">{{ $faq['answer'] ?? '' }}</textarea>
                                        </div>
                                        <div class="col-md-12">
                                            <button type="button" class="btn btn-sm btn-outline-danger remove-airline-faq">Remove FAQ</button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <small class="text-muted">FAQs with both a question and answer will show on the airline page.</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12 mb-3">
        <div class="form-check">
            <input type="hidden" name="status" value="0">
            <input type="checkbox" id="status" name="status" value="1" class="form-check-input"
                @checked($isActive)>
            <label for="status" class="form-check-label fw-bold">Active</label>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const wrapper = document.getElementById('airline-faq-items');
        const addButton = document.getElementById('add-airline-faq');

        if (!wrapper || !addButton) {
            return;
        }

        const refreshFaqIndexes = () => {
            wrapper.querySelectorAll('.airline-faq-item').forEach((item, index) => {
                const question = item.querySelector('[data-faq-field="question"]') || item.querySelector('input[name$="[question]"]');
                const answer = item.querySelector('[data-faq-field="answer"]') || item.querySelector('textarea[name$="[answer]"]');
                const questionLabel = item.querySelector('[data-faq-label="question"]') || item.querySelector('label[for$="-question"]');
                const answerLabel = item.querySelector('[data-faq-label="answer"]') || item.querySelector('label[for$="-answer"]');

                if (question) {
                    question.name = `faqs[${index}][question]`;
                    question.id = `faq-${index}-question`;
                    question.dataset.faqField = 'question';
                }

                if (answer) {
                    answer.name = `faqs[${index}][answer]`;
                    answer.id = `faq-${index}-answer`;
                    answer.dataset.faqField = 'answer';
                }

                if (questionLabel) {
                    questionLabel.setAttribute('for', `faq-${index}-question`);
                    questionLabel.dataset.faqLabel = 'question';
                }

                if (answerLabel) {
                    answerLabel.setAttribute('for', `faq-${index}-answer`);
                    answerLabel.dataset.faqLabel = 'answer';
                }
            });
        };

        addButton.addEventListener('click', () => {
            const item = document.createElement('div');
            item.className = 'airline-faq-item border rounded p-3 mb-3 bg-white';
            item.innerHTML = `
                <div class="row g-3">
                    <div class="col-md-12">
                        <label class="form-label fw-bold" data-faq-label="question">Question</label>
                        <input type="text" class="form-control" data-faq-field="question" placeholder="How can I check in for this airline?">
                    </div>
                    <div class="col-md-12">
                        <label class="form-label fw-bold" data-faq-label="answer">Answer</label>
                        <textarea rows="3" class="form-control" data-faq-field="answer"></textarea>
                    </div>
                    <div class="col-md-12">
                        <button type="button" class="btn btn-sm btn-outline-danger remove-airline-faq">Remove FAQ</button>
                    </div>
                </div>
            `;
            wrapper.appendChild(item);
            refreshFaqIndexes();
        });

        wrapper.addEventListener('click', (event) => {
            if (!event.target.classList.contains('remove-airline-faq')) {
                return;
            }

            const items = wrapper.querySelectorAll('.airline-faq-item');

            if (items.length === 1) {
                items[0].querySelectorAll('input, textarea').forEach((field) => {
                    field.value = '';
                });
                return;
            }

            event.target.closest('.airline-faq-item').remove();
            refreshFaqIndexes();
        });

        refreshFaqIndexes();
    });
</script>
