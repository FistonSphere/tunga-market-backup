@extends('layouts.app')

@section('content')
    <style>
        .toast-message {
            will-change: transform, opacity;
        }

        @keyframes shake {

            0%,
            100% {
                transform: translateX(0);
            }

            20%,
            60% {
                transform: translateX(-8px);
            }

            40%,
            80% {
                transform: translateX(8px);
            }
        }

        .shake {
            animation: shake 0.5s ease;
        }
    </style>
    <!-- Hero Search Section -->
    <section class="bg-gradient-to-br from-primary-50 to-accent-50 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-8">
                <h1 class="text-hero font-bold text-primary mb-4">
                    Discover Your Next
                    <span class="text-gradient">Favorite Product</span>
                </h1>
                <p class="text-body-lg text-secondary-600 max-w-2xl mx-auto">
                    Explore trending items, unbeatable deals, and thousands of trusted sellers, all in one seamless
                    shopping experience.
                </p>

            </div>

            <!-- Advanced Search Bar -->
            <div class="max-w-4xl mx-auto">
                <div class="card p-6">
                    <div class="flex flex-col lg:flex-row gap-4">
                        <!-- Main Search Input -->
                        <div class="flex-1 relative">
                            <input type="text" placeholder="Search products, suppliers, or categories..."
                                class="input-field pl-12 pr-16" id="mainSearch" />
                            <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-secondary-400"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            <!-- Voice Search -->
                            <button id="voiceSearchBtn"
                                class="absolute right-12 top-1/2 transform -translate-y-1/2 p-1 hover:bg-secondary-100 rounded">
                                <svg class="w-5 h-5 text-secondary-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z" />
                                </svg>
                                <!-- Recording indicator (hidden by default) -->
                                <div id="voiceRecordingIndicator" class="hidden">
                                    <svg class="w-5 h-5 text-error animate-pulse" fill="currentColor" viewBox="0 0 24 24">
                                        <circle cx="12" cy="12" r="10" />
                                    </svg>
                                </div>
                            </button>
                            <!-- Visual Search -->
                            <button id="imageSearchBtn"
                                class="absolute right-4 top-1/2 transform -translate-y-1/2 p-1 hover:bg-secondary-100 rounded">
                                <svg class="w-5 h-5 text-secondary-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </button>
                            <!-- Hidden file input for image search -->
                            <input type="file" id="imageUploadInput" accept="image/*" class="hidden" />
                        </div>

                        <!-- Quick Filters -->
                        <div class="flex gap-2">
                            <select class="input-field min-w-32">
                                <option>All Categories</option>
                                <option>Electronics</option>
                                <option>Fashion</option>
                                <option>Home & Garden</option>
                                <option>Industrial</option>
                            </select>
                            <button class="btn-primary px-8">Search</button>
                        </div>
                    </div>

                    <!-- AI Suggestions -->
                    <div class="mt-4 flex flex-wrap gap-2">
                        <span class="text-body-sm text-secondary-600">Trending:</span>
                        <button
                            class="px-3 py-1 bg-accent-50 text-accent rounded-full text-body-sm hover:bg-accent-100 transition-fast">Wireless
                            Earbuds</button>
                        <button
                            class="px-3 py-1 bg-accent-50 text-accent rounded-full text-body-sm hover:bg-accent-100 transition-fast">Smart
                            Home Devices</button>
                        <button
                            class="px-3 py-1 bg-accent-50 text-accent rounded-full text-body-sm hover:bg-accent-100 transition-fast">Sustainable
                            Fashion</button>
                        <button
                            class="px-3 py-1 bg-accent-50 text-accent rounded-full text-body-sm hover:bg-accent-100 transition-fast">Solar
                            Panels</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content Area -->
    <section class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Advanced Filters Sidebar -->
                <div class="lg:w-80 space-y-6">
                    <!-- Filter Header -->
                    <div class="flex items-center justify-between">
                        <h3 class="font-semibold text-primary">Advanced Filters</h3>
                        <button class="text-accent hover:text-accent-600 text-body-sm">Reset All</button>
                    </div>

                    <!-- Category Filter -->
                    <div class="card">
                        <h4 class="font-medium text-primary mb-3">Categories</h4>
                        <div class="space-y-2" id="categories-list">

                        </div>
                    </div>

                    <!-- Price Range -->
                    <div class="card">
                        <h4 class="font-medium text-primary mb-3">Price Range</h4>

                        <!-- Currency Selector -->
                        <select id="currency-select" class="input-field w-full mb-3">
                            <option value="" selected>Currency</option>
                            <option value="$">USD ($)</option>
                            <option value="RWF">RWF (₣)</option>
                        </select>

                        <div class="space-y-3">
                            <div class="flex gap-2">
                                <input type="number" id="min-price" placeholder="Min" class="input-field flex-1" />
                                <input type="number" id="max-price" placeholder="Max" class="input-field flex-1" />
                            </div>

                            <div class="bg-secondary-100 h-2 rounded-full relative">
                                <div id="price-progress" class="bg-accent h-2 rounded-full absolute left-0"></div>
                            </div>
                        </div>
                    </div>



                    <!-- Sustainability Score -->
                    <div class="card">
                        <h4 class="font-medium text-primary mb-3">Sustainability Score</h4>
                        <div class="space-y-2">
                            <label class="flex items-center">
                                <input type="radio" name="sustainability" class="text-accent focus:ring-accent" />
                                <span class="ml-2 text-body-sm">Excellent (90-100)</span>
                                <div class="ml-auto flex">
                                    <div class="w-2 h-2 bg-success rounded-full"></div>
                                </div>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="sustainability" class="text-accent focus:ring-accent" />
                                <span class="ml-2 text-body-sm">Good (70-89)</span>
                                <div class="ml-auto flex">
                                    <div class="w-2 h-2 bg-warning rounded-full"></div>
                                </div>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="sustainability" class="text-accent focus:ring-accent" />
                                <span class="ml-2 text-body-sm">Fair (50-69)</span>
                                <div class="ml-auto flex">
                                    <div class="w-2 h-2 bg-accent rounded-full"></div>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Cultural Fit Indicators -->
                    <div class="card">
                        <h4 class="font-medium text-primary mb-3">Cultural Fit</h4>
                        <div class="space-y-2">
                            <label class="flex items-center">
                                <input type="checkbox" class="rounded border-gray-300 text-accent focus:ring-accent" />
                                <span class="ml-2 text-body-sm">Same Time Zone</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="rounded border-gray-300 text-accent focus:ring-accent" />
                                <span class="ml-2 text-body-sm">English Speaking</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="rounded border-gray-300 text-accent focus:ring-accent" />
                                <span class="ml-2 text-body-sm">Similar Business Culture</span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Product Results -->
                <div class="flex-1">
                    <!-- Results Header -->
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                        <div>
                            <h2 class="text-heading font-semibold text-primary">Product Results</h2>
                            <p class="text-body text-secondary-600">
                                Showing {{ $products->firstItem() }} - {{ $products->lastItem() }} of
                                {{ $products->total() }} products
                            </p>

                        </div>

                        <!-- Sort & View Options -->
                        <div class="flex items-center gap-4">
                            <select id="sortSelect" class="input-field min-w-40">
                                <option value="best">Best Match</option>
                                <option value="price_asc">Price: Low to High</option>
                                <option value="price_desc">Price: High to Low</option>
                                <option value="newest">Newest First</option>
                                <option value="top_rated">Top Rated</option>
                            </select>


                            <!-- View Toggle -->
                            <div class="flex border border-gray-300 rounded-lg">
                                <button class="p-2 bg-accent text-white rounded-l-lg">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                                    </svg>
                                </button>
                                <button class="p-2 text-secondary-600 hover:bg-secondary-50 rounded-r-lg">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Product Grid -->
                    <div id="product-grid">
                        @include('partials.product-grid', ['products' => $products])
                    </div>

                    <!-- Pagination -->
                    <div id="pagination">
                        @include('partials.pagination', ['products' => $products])
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- Comparison Tool Section -->
    <section id="comparisonSection" class="py-16 bg-secondary-50 hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-heading font-bold text-primary mb-4">Smart Product Comparison</h2>
                <p class="text-body-lg text-secondary-600 max-w-2xl mx-auto">
                    Compare up to 4 products side-by-side with detailed specifications
                </p>
            </div>
            <div class="card overflow-x-auto">
                <table class="w-full" id="comparisonTable">
                    <!-- Injected dynamically -->
                </table>
            </div>
        </div>
    </section>
    <div id="toast-container" style="position: fixed; bottom: 20px; right: 20px; z-index: 9999;"></div>

    <script>
        let compareList = [];

        // Max products allowed in comparison
        const maxComparison = 4;

        // Reference the comparison section and table
        const comparisonSection = document.getElementById('comparisonSection');
        const comparisonTable = document.getElementById('comparisonTable');

        // Add product to comparison
        function addToComparison(productId) {
            if (compareList.includes(productId)) {
                showToast('Product already in comparison', 'info');
                scrollToComparisonPanel();
                return;
            }

            if (compareList.length >= maxComparison) {
                animateComparisonPanel();
                showToast(`You can only compare up to ${maxComparison} products.`, 'error');
                scrollToComparisonPanel();
                return;
            }

            compareList.push(productId);
            fetchComparisonData();
            showToast('Product added to comparison', 'success');
            scrollToComparisonPanel();
        }

        // Remove product from comparison by id
        function removeFromComparison(productId) {
            compareList = compareList.filter(id => id !== productId);
            fetchComparisonData();
            showToast('Product removed from comparison', 'success');
            if (compareList.length === 0) {
                comparisonSection.classList.add('hidden');
            }
        }

        // Fetch comparison product data from server
        function fetchComparisonData() {
            if (compareList.length === 0) {
                comparisonSection.classList.add('hidden');
                comparisonTable.innerHTML = '';
                return;
            }

            fetch(`/compare?products[]=${compareList.join('&products[]=')}`)
                .then(res => res.json())
                .then(renderComparisonTable)
                .catch(() => {
                    showToast('Failed to fetch comparison data.', 'error');
                });
        }

        // Render comparison table with remove buttons and features
        function renderComparisonTable(products) {
            const features = ['Price', 'MOQ', 'Specifications', 'Brand', 'Features'];
            let thead = `<thead><tr><th class="py-4 px-6 font-semibold text-primary text-left">Features</th>`;

            products.forEach(p => {
                thead += `
            <th class="text-center py-4 px-6 relative">
                <div class="space-y-2">
                    <img src="${p.main_image}" alt="${p.name}"
                        class="w-16 h-16 object-cover rounded-lg mx-auto" />
                    <div class="font-medium text-primary">${p.name}</div>
                </div>
                <button
                    onclick="removeFromComparison(${p.id})"
                    class="remove-product absolute top-0 right-0 text-red-600 hover:text-red-800"
                    title="Remove product"
                    style="position:absolute; top:4px; right:4px; background:none; border:none; cursor:pointer; font-size: 20px; line-height: 1;">
                    &times;
                </button>
            </th>`;
            });

            for (let i = products.length; i < maxComparison; i++) {
                thead += `<th class="text-center py-4 px-6 text-secondary-400 opacity-50">
            <div class="space-y-2">
                <div class="w-16 h-16 bg-secondary-200 rounded-lg mx-auto flex items-center justify-center">
                    <svg class="w-8 h-8 text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                </div>
                <div class="font-medium text-secondary-400">Add Product</div>
            </div>
        </th>`;
            }

            thead += `</tr></thead>`;
            let tbody = '<tbody>';

            features.forEach(feature => {
                tbody += `<tr class="border-b border-gray-100">
            <td class="py-4 px-6 font-medium text-secondary-700">${feature}</td>`;

                products.forEach(p => {
                    switch (feature) {
                        case 'Price':
                            const price = p.discount_price ?? p.price;
                            tbody += `<td class="py-4 px-6 text-center">
                        <span class="text-subheading font-bold text-primary">$${price}</span>
                        <div class="text-body-sm text-secondary-600">per piece</div>
                    </td>`;
                            break;

                        case 'MOQ':
                            tbody +=
                                `<td class="py-4 px-6 text-center text-secondary-600">${p.min_order_quantity} pcs</td>`;
                            break;

                        case 'Specifications':
                            let specsHtml = '';
                            try {
                                const specs = JSON.parse(p.specifications);
                                for (const [key, value] of Object.entries(specs)) {
                                    specsHtml += `<div><strong>${key}:</strong> ${value}</div>`;
                                }
                            } catch (error) {
                                specsHtml = 'N/A';
                            }
                            tbody +=
                                `<td class="py-4 px-6 text-center text-secondary-400">${specsHtml}</td>`;
                            break;

                        case 'Brand':
                            tbody +=
                                `<td class="py-4 px-6 text-center text-secondary-600">${p.brand?.name ?? 'N/A'}</td>`;
                            break;

                        case 'Features':
                            let featuresHtml = '';
                            try {
                                const parsedFeatures = JSON.parse(p.features);
                                featuresHtml = parsedFeatures.map(f => `<div>${f}</div>`).join('');
                            } catch (error) {
                                featuresHtml = 'N/A';
                            }
                            tbody +=
                                `<td class="py-4 px-6 text-center text-secondary-400">${featuresHtml}</td>`;
                            break;

                        default:
                            tbody += `<td class="py-4 px-6 text-center text-secondary-400">-</td>`;
                    }
                });

                for (let i = products.length; i < maxComparison; i++) {
                    tbody += `<td class="py-4 px-6 text-center text-secondary-400">-</td>`;
                }

                tbody += '</tr>';
            });

            tbody += '</tbody>';

            comparisonTable.innerHTML = thead + tbody;
            comparisonSection.classList.remove('hidden');
        }


        // Toast message utility
        function showToast(message, type = 'info', duration = 3000) {
            const container = document.getElementById('toast-container');
            if (!container) return;

            const toast = document.createElement('div');
            toast.className = `toast-message toast-${type}`;

            let bgColor = '#60A5FA'; // default info (blue)
            if (type === 'error') bgColor = '#F87171'; // red for errors (limit exceeded)
            else if (type === 'success') bgColor = '#ff6a34'; // orange for add product
            else if (type === 'warning') bgColor = '#b91c1c'; // dark red for remove product

            toast.style = `
        background: ${bgColor};
        color: white;
        padding: 12px 18px;
        margin-top: 8px;
        border-radius: 6px;
        box-shadow: 0 2px 10px rgb(0 0 0 / 0.2);
        opacity: 0;
        transform: translateX(100%);
        transition: opacity 0.3s ease, transform 0.3s ease;
        font-weight: 600;
        max-width: 300px;
    `;
            toast.innerText = message;
            container.appendChild(toast);

            // Show animation
            requestAnimationFrame(() => {
                toast.style.opacity = 1;
                toast.style.transform = 'translateX(0)';
            });

            // Hide after duration
            setTimeout(() => {
                toast.style.opacity = 0;
                toast.style.transform = 'translateX(100%)';
                toast.addEventListener('transitionend', () => {
                    toast.remove();
                });
            }, duration);
        }

        // Animate comparison panel on limit exceed (shake effect)
        function animateComparisonPanel() {
            if (!comparisonSection) return;
            comparisonSection.classList.add('shake');
            setTimeout(() => comparisonSection.classList.remove('shake'), 500);
        }

        // Scroll smoothly to comparison panel on add/remove
        function scrollToComparisonPanel() {
            if (!comparisonSection) return;
            comparisonSection.scrollIntoView({
                behavior: 'smooth'
            });
        }
    </script>

    <script>
        // Voice Recognition and Image Search System
        class VoiceImageSearchManager {
            constructor() {
                this.recognition = null;
                this.isListening = false;
                this.initializeVoiceSearch();
                this.initializeImageSearch();
                this.bindEvents();
            }

            initializeVoiceSearch() {
                // Check for browser support
                if ('webkitSpeechRecognition' in window || 'SpeechRecognition' in window) {
                    const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
                    this.recognition = new SpeechRecognition();

                    this.recognition.continuous = false;
                    this.recognition.interimResults = false;
                    this.recognition.lang = 'en-US';

                    this.recognition.onstart = () => {
                        this.isListening = true;
                        this.showVoiceStatus('Listening... Speak now');
                        this.updateVoiceButton(true);
                    };

                    this.recognition.onresult = (event) => {
                        const transcript = event.results[0][0].transcript;
                        this.handleVoiceResult(transcript);
                    };

                    this.recognition.onerror = (event) => {
                        this.handleVoiceError(event.error);
                    };

                    this.recognition.onend = () => {
                        this.isListening = false;
                        this.hideVoiceStatus();
                        this.updateVoiceButton(false);
                    };
                } else {
                    console.warn('Speech recognition not supported in this browser');
                }
            }

            initializeImageSearch() {
                // Image search is initialized through event listeners
            }

            bindEvents() {
                // Voice search button
                const voiceBtn = document.getElementById('voiceSearchBtn');
                if (voiceBtn) {
                    voiceBtn.addEventListener('click', () => this.toggleVoiceSearch());
                }

                // Stop voice search button
                const stopVoiceBtn = document.getElementById('stopVoiceSearch');
                if (stopVoiceBtn) {
                    stopVoiceBtn.addEventListener('click', () => this.stopVoiceSearch());
                }

                // Image search button
                const imageBtn = document.getElementById('imageSearchBtn');
                if (imageBtn) {
                    imageBtn.addEventListener('click', () => this.triggerImageUpload());
                }

                // Image upload input
                const imageInput = document.getElementById('imageUploadInput');
                if (imageInput) {
                    imageInput.addEventListener('change', (e) => this.handleImageUpload(e));
                }

                // Remove image search
                const removeImageBtn = document.getElementById('removeImageSearch');
                if (removeImageBtn) {
                    removeImageBtn.addEventListener('click', () => this.removeImageSearch());
                }

                // Search button
                const searchBtn = document.getElementById('searchBtn');
                if (searchBtn) {
                    searchBtn.addEventListener('click', () => this.performSearch());
                }

                // Enter key on search input
                const searchInput = document.getElementById('mainSearch');
                if (searchInput) {
                    searchInput.addEventListener('keypress', (e) => {
                        if (e.key === 'Enter') {
                            this.performSearch();
                        }
                    });
                }
            }

            toggleVoiceSearch() {
                if (!this.recognition) {
                    this.showNotification('Voice Search Unavailable',
                        'Speech recognition is not supported in your browser', 'warning');
                    return;
                }

                if (this.isListening) {
                    this.stopVoiceSearch();
                } else {
                    this.startVoiceSearch();
                }
            }

            startVoiceSearch() {
                if (this.recognition && !this.isListening) {
                    try {
                        this.recognition.start();
                    } catch (error) {
                        console.error('Voice recognition error:', error);
                        this.showNotification('Voice Search Error', 'Unable to start voice recognition', 'error');
                    }
                }
            }

            stopVoiceSearch() {
                if (this.recognition && this.isListening) {
                    this.recognition.stop();
                }
            }

            handleVoiceResult(transcript) {
                const searchInput = document.getElementById('mainSearch');
                if (searchInput) {
                    searchInput.value = transcript;
                    this.showNotification('Voice Search Complete', `Searching for: "${transcript}"`, 'success');

                    // Auto-search after voice input
                    setTimeout(() => {
                        this.performSearch();
                    }, 1000);
                }
            }

            handleVoiceError(error) {
                let message = 'Voice recognition error occurred';

                switch (error) {
                    case 'network':
                        message = 'Network error during voice recognition';
                        break;
                    case 'not-allowed':
                        message = 'Microphone access denied. Please allow microphone access.';
                        break;
                    case 'no-speech':
                        message = 'No speech detected. Please try again.';
                        break;
                    case 'audio-capture':
                        message = 'Microphone not found or not working';
                        break;
                    default:
                        message = `Voice recognition error: ${error}`;
                }

                this.showNotification('Voice Search Error', message, 'error');
            }

            showVoiceStatus(text) {
                const status = document.getElementById('voiceSearchStatus');
                const statusText = document.getElementById('voiceStatusText');

                if (status && statusText) {
                    statusText.textContent = text;
                    status.classList.remove('hidden');
                }
            }

            hideVoiceStatus() {
                const status = document.getElementById('voiceSearchStatus');
                if (status) {
                    status.classList.add('hidden');
                }
            }

            updateVoiceButton(isRecording) {
                const micIcon = document.getElementById('voiceMicIcon');
                const recordingIndicator = document.getElementById('voiceRecordingIndicator');

                if (micIcon && recordingIndicator) {
                    if (isRecording) {
                        micIcon.classList.add('hidden');
                        recordingIndicator.classList.remove('hidden');
                    } else {
                        micIcon.classList.remove('hidden');
                        recordingIndicator.classList.add('hidden');
                    }
                }
            }

            triggerImageUpload() {
                const imageInput = document.getElementById('imageUploadInput');
                if (imageInput) {
                    imageInput.click();
                }
            }

            handleImageUpload(event) {
                const file = event.target.files[0];
                if (!file) return;

                // Validate file type
                if (!file.type.startsWith('image/')) {
                    this.showNotification('Invalid File', 'Please select a valid image file', 'error');
                    return;
                }

                // Validate file size (max 10MB)
                if (file.size > 10 * 1024 * 1024) {
                    this.showNotification('File Too Large', 'Please select an image smaller than 10MB', 'error');
                    return;
                }

                // Show image preview
                const reader = new FileReader();
                reader.onload = (e) => {
                    this.showImagePreview(e.target.result);
                    this.processImageSearch(file);
                };
                reader.readAsDataURL(file);
            }

            showImagePreview(imageSrc) {
                const preview = document.getElementById('imageSearchPreview');
                const img = document.getElementById('uploadedImagePreview');

                if (preview && img) {
                    img.src = imageSrc;
                    preview.classList.remove('hidden');
                }
            }

            removeImageSearch() {
                const preview = document.getElementById('imageSearchPreview');
                const imageInput = document.getElementById('imageUploadInput');

                if (preview) {
                    preview.classList.add('hidden');
                }

                if (imageInput) {
                    imageInput.value = '';
                }
            }

            processImageSearch(file) {
                // Simulate image processing and search
                this.showNotification('Image Search Started', 'Analyzing your image to find similar products', 'info');

                // Simulate API call delay
                setTimeout(() => {
                    // In a real implementation, this would send the image to an AI service
                    // for product recognition and similarity search
                    const searchTerms = this.extractImageSearchTerms(file.name);

                    const searchInput = document.getElementById('mainSearch');
                    if (searchInput) {
                        searchInput.value = searchTerms;
                    }

                    this.showNotification('Image Analysis Complete', `Found similar products for your image`,
                        'success');

                    // Auto-search after image analysis
                    setTimeout(() => {
                        this.performSearch();
                    }, 1500);

                }, 2000);
            }

            extractImageSearchTerms(filename) {
                // This is a simplified example. In a real implementation,
                // you would use computer vision APIs to analyze the actual image content
                const terms = [
                    'wireless earbuds',
                    'smart watch',
                    'laptop computer',
                    'smartphone case',
                    'bluetooth speaker',
                    'home appliance'
                ];

                return terms[Math.floor(Math.random() * terms.length)];
            }

            performSearch() {
                const searchInput = document.getElementById('mainSearch');
                const categoryFilter = document.getElementById('categoryFilter');

                if (!searchInput) return;

                const query = searchInput.value.trim();
                const category = categoryFilter ? categoryFilter.value : 'All Categories';

                if (!query) {
                    this.showNotification('Search Required', 'Please enter a search term or use voice/image search',
                        'warning');
                    return;
                }

                // In a real implementation, this would trigger the actual search
                this.showNotification('Searching', `Searching for "${query}" in ${category}`, 'info');

                // Simulate search results update
                this.updateSearchResults(query, category);
            }

            updateSearchResults(query, category) {
                // This would typically update the product grid with new results
                // For now, we'll just show a notification
                setTimeout(() => {
                    this.showNotification('Search Complete', `Found products matching "${query}"`, 'success');
                }, 1000);
            }

            showNotification(title, message, type = 'info') {
                // Use the existing notification system
                if (window.cartWishlistManager && window.cartWishlistManager.showNotification) {
                    window.cartWishlistManager.showNotification(title, message, type);
                } else {
                    // Fallback notification
                    console.log(`${title}: ${message}`);
                    alert(`${title}\n${message}`);
                }
            }
        }

        // Initialize the voice and image search system
        document.addEventListener('DOMContentLoaded', function() {
            window.voiceImageSearchManager = new VoiceImageSearchManager();
        });
    </script>

    <script>
        const productGrid = document.getElementById('productGrid');
        const sortSelect = document.getElementById('sortSelect');

        sortSelect.addEventListener('change', () => {
            const sortBy = sortSelect.value;

            let sorted = [...allProducts];

            switch (sortBy) {
                case 'price_asc':
                    sorted.sort((a, b) => (a.discount_price ?? a.price) - (b.discount_price ?? b.price));
                    break;
                case 'price_desc':
                    sorted.sort((a, b) => (b.discount_price ?? b.price) - (a.discount_price ?? a.price));
                    break;
                case 'newest':
                    sorted.sort((a, b) => new Date(b.created_at) - new Date(a.created_at));
                    break;
                case 'top_rated':
                    sorted.sort((a, b) => (b.rating ?? 0) - (a.rating ?? 0));
                    break;
                case 'best':
                default:
                    // Keep original or implement your own logic
                    sorted = [...allProducts];
            }

            renderProducts(sorted);
        });

        function renderProducts(products) {
            productGrid.innerHTML = '';

            products.forEach(product => {
                const discountPrice = product.discount_price;
                const basePrice = product.price;
                const priceHtml = discountPrice ?
                    `<span class="line-through text-secondary-500 text-sm mr-2">$${basePrice.toFixed(2)}</span>
                   <span class="text-subheading font-bold text-primary">$${discountPrice.toFixed(2)}</span>` :
                    `<span class="text-subheading font-bold text-primary">$${basePrice.toFixed(2)}</span>`;

                let badgeHtml = '';
                if (product.has_3d_model) {
                    badgeHtml =
                        `<div class="absolute top-3 right-3 bg-primary text-white px-2 py-1 rounded-full text-caption font-medium z-10">3D Model</div>`;
                } else if (product.is_featured) {
                    badgeHtml =
                        `<div class="absolute top-3 right-3 bg-error text-white px-2 py-1 rounded-full text-caption font-medium z-10">Hot Deal</div>`;
                } else if (product.is_new) {
                    badgeHtml =
                        `<div class="absolute top-3 right-3 bg-success text-white px-2 py-1 rounded-full text-caption font-medium z-10">New Arrival</div>`;
                } else if (product.is_best_seller) {
                    badgeHtml =
                        `<div class="absolute top-3 right-3 bg-warning text-white px-2 py-1 rounded-full text-caption font-medium z-10">Best Seller</div>`;
                } else if (product.stock_quantity <= 5) {
                    badgeHtml =
                        `<div class="absolute top-3 right-3 bg-accent text-white px-2 py-1 rounded-full text-caption font-medium z-10">Limited Stock</div>`;
                } else {
                    badgeHtml =
                        `<div class="absolute top-3 right-3 bg-accent text-white px-2 py-1 rounded-full text-caption font-medium z-10">AR Preview</div>`;
                }

                const ecoHtml = product.features?.includes('eco_friendly') ? `
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-1">
                        <div class="w-2 h-2 bg-success rounded-full"></div>
                        <span class="text-caption text-success">Eco-Friendly</span>
                    </div>
                    <span class="text-caption text-secondary-500">Ships in 3-5 days</span>
                </div>` : '';

                const cardHtml = `
                <div class="card group cursor-pointer hover:shadow-hover transition-all duration-300 relative">
                    ${badgeHtml}
                    <div class="relative overflow-hidden rounded-lg mb-4">
                        <img src="${product.main_image}" alt="${product.name}" class="w-full h-48 object-cover group-hover:scale-105 transition-all duration-300" loading="lazy" />
                        <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-all duration-300 flex items-center justify-center gap-2">
                            <a href="/product/${product.sku}" class="bg-white text-primary p-2 rounded-full hover:bg-secondary-50" title="View Product">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </a>
                            <button onclick="addToComparison(${product.id})" class="bg-white text-primary p-2 rounded-full hover:bg-secondary-50" title="Add to Compare">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <a href="/product/${product.sku}" class="space-y-3 block">
                        <h3 class="font-semibold text-primary group-hover:text-accent transition-fast">${product.name}</h3>
                        <div class="space-y-1">
                            <div>${priceHtml}<span class="text-body-sm text-secondary-600 ml-1">/ piece</span></div>
                            <div><span class="text-body-sm text-secondary-600">MOQ: ${product.min_order_quantity} pcs</span></div>
                        </div>
                        ${ecoHtml}
                    </a>
                </div>`;

                productGrid.innerHTML += cardHtml;
            });
        }
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            fetch('/categories-with-count')
                .then(res => res.json())
                .then(categories => {
                    let container = document.querySelector('#categories-list');
                    container.innerHTML = '';
                    categories.forEach(cat => {
                        container.innerHTML += `
        <label class="flex items-center">
            <input type="checkbox"
                   class="rounded border-gray-300 text-accent focus:ring-accent category-checkbox"
                   value="${cat.id}" />
            <span class="ml-2 text-body-sm">${cat.name} (${cat.products_count})</span>
        </label>
    `;
                    });

                })
                .catch(err => console.error('Error fetching categories:', err));

        });

        document.addEventListener('change', function(e) {
            if (e.target.classList.contains('category-checkbox')) {
                const selected = Array.from(document.querySelectorAll('.category-checkbox:checked'))
                    .map(cb => cb.value);

                fetch(`/products/filter?` + selected.map(id => `categories[]=${id}`).join('&'))
                    .then(res => res.json())
                    .then(data => {
                        document.getElementById('product-grid').innerHTML = data.html;
                        document.getElementById('pagination').innerHTML = data.pagination;
                    })
                    .catch(err => console.error('Error filtering products:', err));
            }
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const currencySelect = document.getElementById('currency-select');
            const minPriceInput = document.getElementById('min-price');
            const maxPriceInput = document.getElementById('max-price');
            const priceProgress = document.getElementById('price-progress');

            let dbMinPrice = 0;
            let dbMaxPrice = 0;

            // Get DB Min/Max Price for progress bar
            fetch('/products/min-max-price')
                .then(res => res.json())
                .then(data => {
                    dbMinPrice = data.min;
                    dbMaxPrice = data.max;
                });

            function updateProgress() {
                let min = parseFloat(minPriceInput.value) || dbMinPrice;
                let max = parseFloat(maxPriceInput.value) || dbMaxPrice;
                let range = dbMaxPrice - dbMinPrice;
                let progressWidth = ((max - min) / range) * 100;
                priceProgress.style.width = `${progressWidth}%`;
            }

            function fetchFilteredProducts() {
                let currency = currencySelect.value;
                let min = minPriceInput.value;
                let max = maxPriceInput.value;

                fetch(`/products/filter-by-price?currency=${currency}&min_price=${min}&max_price=${max}`)
                    .then(res => res.json())
                    .then(products => {
                        const productsContainer = document.getElementById('products-list');
                        productsContainer.innerHTML = '';

                        if (products.length === 0) {
                            productsContainer.innerHTML = '<p>No products found in this price range.</p>';
                            return;
                        }

                        products.forEach(p => {
                            productsContainer.innerHTML += `
                        <div class="product-card">
                            <img src="${p.image_url}" alt="${p.name}" />
                            <h3>${p.name}</h3>
                            <p>${p.currency} ${p.price}</p>
                            <p>${p.brand?.name ?? 'N/A'}</p>
                        </div>
                    `;
                        });
                    });
            }

            [currencySelect, minPriceInput, maxPriceInput].forEach(el => {
                el.addEventListener('input', () => {
                    updateProgress();
                    fetchFilteredProducts();
                });
            });
        });
    </script>
@endsection
