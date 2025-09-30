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
                            <input type="text" placeholder="Search products or categories..."
                                class="input-field pl-12 pr-16" id="mainSearch" autocomplete="off" />
                            <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-secondary-400"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            <!-- Suggestions Container -->
                            <div id="searchSuggestions"
                                class="absolute z-50 w-full bg-white border border-gray-300 rounded shadow mt-1 hidden max-h-60 overflow-auto">
                            </div>
                        </div>

                    </div>

                    <!-- AI Suggestions -->
                    <div class="mt-4 flex flex-wrap gap-2" id="ai-suggestions">
                        <span class="text-body-sm text-secondary-600">Trending:</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content Area -->
    <section class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-8">
             

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
                            <select id="sortSelection" class="input-field min-w-40">
                                <option value="best">Best Match</option>
                                <option value="price_asc">Price: Low to High</option>
                                <option value="price_desc">Price: High to Low</option>
                                <option value="newest">Newest First</option>
                                <option value="top_viewed">Most Viewed</option>
                            </select>
                            <!-- Loader -->
                            <div id="sortLoader" class="hidden">
                                <div class="flex items-center space-x-2">
                                    <div
                                        class="w-5 h-5 border-2 border-blue-500 border-t-transparent rounded-full animate-spin">
                                    </div>
                                    <span class="text-sm text-gray-500">Sorting...</span>
                                </div>
                            </div>

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
                    <!-- Loader -->
                    <div id="loader" class="hidden flex justify-center items-center my-8">
                        <div class="w-8 h-8 border-4 border-t-transparent border-blue-500 rounded-full animate-spin"></div>
                    </div>
                    <!-- Product Grid -->
                    <div id="product-grid">
                        @include('partials.product-grid-category', ['products' => $products])
                    </div>

                    <!-- Pagination -->
                    <div id="pagination">
                        @include('partials.pagination-category', ['products' => $products])
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
    <div id="toast-container" style="position: fixed; top: 20px; right: 20px; z-index: 9999;"></div>

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

            let bgColor = '#011528'; // default info (blue)
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
            const categoriesContainer = document.getElementById('categories-list');
            const productsContainer = document.getElementById('product-grid');

            let dbMinPrice = 0;
            let dbMaxPrice = 0;

            // Store selected categories
            let selectedCategories = [];

            // 1️⃣ Load categories (only with product count > 0)
            fetch('categories-with-count')
                .then(res => res.json())
                .then(categories => {
                    categoriesContainer.innerHTML = '';
                    categories
                        .filter(c => c.products_count > 0)
                        .forEach(c => {
                            categoriesContainer.innerHTML += `
                        <label class="flex items-center">
                            <input type="checkbox"
                                   class="category-checkbox rounded border-gray-300 text-accent focus:ring-accent"
                                   value="${c.id}" />
                            <span class="ml-2 text-body-sm">${c.name} (${c.products_count})</span>
                        </label>
                    `;
                        });

                    // Event listener for category selection
                    document.querySelectorAll('.category-checkbox').forEach(cb => {
                        cb.addEventListener('change', () => {
                            selectedCategories = Array.from(document.querySelectorAll(
                                    '.category-checkbox:checked'))
                                .map(el => el.value);
                            fetchFilteredProducts();
                        });
                    });
                });

            // 2️⃣ Get DB Min/Max Price for progress bar
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

            // 3️⃣ Fetch products (combined filters)
            function fetchFilteredProducts() {
                let currency = currencySelect.value;
                let min = minPriceInput.value || dbMinPrice;
                let max = maxPriceInput.value || dbMaxPrice;

                let params = new URLSearchParams();
                params.append('currency', currency);
                params.append('min_price', min);
                params.append('max_price', max);
                selectedCategories.forEach(cat => params.append('categories[]', cat));

                fetch(`/products/filter?${params.toString()}`)
                    .then(res => res.json())
                    .then(data => {
                        productsContainer.innerHTML = data.html;
                        document.getElementById('pagination').innerHTML = data.pagination;
                    });
            }

            // 4️⃣ Event listeners for price & currency changes
            [currencySelect, minPriceInput, maxPriceInput].forEach(el => {
                el.addEventListener('input', () => {
                    updateProgress();
                    fetchFilteredProducts();
                });
            });

            // Initial load
            fetchFilteredProducts();
        });

        //price range filtering functionality
        document.addEventListener('DOMContentLoaded', function() {
            const currencySelect = document.getElementById('currency-select');
            const minPriceInput = document.getElementById('min-price');
            const maxPriceInput = document.getElementById('max-price');
            const priceProgress = document.getElementById('price-progress');
            const productGrid = document.getElementById('product-grid');
            const pagination = document.getElementById('pagination');

            let dbMinPrice = 0;
            let dbMaxPrice = 0;

            // Fetch min and max prices from the DB to set progress bar range
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
                    .then(data => {
                        productGrid.innerHTML = data.html;
                        pagination.innerHTML = data.pagination;
                    })
                    .catch(err => {
                        productGrid.innerHTML = '<p>Error fetching products.</p>';
                        pagination.innerHTML = '';
                        console.error(err);
                    });
            }

            [currencySelect, minPriceInput, maxPriceInput].forEach(el => {
                el.addEventListener('input', () => {
                    updateProgress();
                    fetchFilteredProducts();
                });
            });

            // Initial load with all products or default min-max
            fetchFilteredProducts();
        });
        //price range filtering functionality
        document.addEventListener('DOMContentLoaded', () => {
            const sortSelect = document.getElementById(
                'sortSelection'); // make sure your <select> has id="sortSelect"
            if (!sortSelect) return;

            // Candidate product container ids -- we'll look for one that exists
            function findProductContainer() {
                return document.getElementById('product-grid') // the id your partial uses in responses
                    ||
                    document.getElementById('productGrid') ||
                    document.getElementById('product-grid') ||
                    document.querySelector('#product-grid-wrapper') ||
                    document.querySelector('.product-grid');
            }

            function findPaginationContainer() {
                return document.getElementById('pagination') || document.getElementById('paginationWrapper') ||
                    document.querySelector('.pagination');
            }

            // Tailwind loader element
            const loaderEl = document.createElement('div');
            loaderEl.className = 'flex justify-center items-center py-8';
            loaderEl.innerHTML = `
    <svg class="animate-spin h-8 w-8 text-orange-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
      <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
      <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
    </svg>
  `;

            // Helper: safely inject HTML into container and execute scripts inside returned HTML
            function injectHtmlAndRun(container, html) {
                // Parse html into a temp container
                const tmp = document.createElement('div');
                tmp.innerHTML = html;

                // Extract scripts (external src and inline)
                const scriptNodes = Array.from(tmp.querySelectorAll('script'));
                const externalSrcs = [];
                const inlineCodes = [];
                scriptNodes.forEach(s => {
                    if (s.src) externalSrcs.push(s.src);
                    else inlineCodes.push(s.textContent);
                    s.remove(); // remove script from tmp so it doesn't get injected twice
                });

                // Inject markup (without scripts)
                container.innerHTML = tmp.innerHTML;

                // Load external scripts sequentially (if any) then run inline scripts
                // Usually partials do not have external scripts, but this is robust
                const loadExternalSequentially = externalSrcs.reduce((p, src) => {
                    return p.then(() => new Promise((resolve, reject) => {
                        const s = document.createElement('script');
                        s.src = src;
                        s.onload = () => resolve();
                        s.onerror = () => {
                            console.warn('Failed to load script:', src);
                            resolve(); // don't block on error
                        };
                        document.head.appendChild(s);
                    }));
                }, Promise.resolve());

                loadExternalSequentially.then(() => {
                    inlineCodes.forEach(code => {
                        try {
                            const s = document.createElement('script');
                            s.textContent = code;
                            document.body.appendChild(s);
                            // remove script tag to keep DOM clean
                            s.remove();
                        } catch (err) {
                            console.error('Error executing inline script from partial:', err);
                        }
                    });
                    // wire pagination anchors now that markup exists
                    attachAjaxPagination();
                });
            }

            // current sort state (keeps selected sort between pages)
            let currentSort = sortSelect.value || 'best';

            // show/hide loader in product container
            function showLoaderIn(container) {
                // clear but keep loader element outside replacement if container is null
                container.innerHTML = '';
                container.appendChild(loaderEl);
            }

            // Perform a fetch for sorted products (page optional)
            function fetchSortedProducts(page = 1) {
                const container = findProductContainer();
                const paginationContainer = findPaginationContainer();
                if (!container) {
                    console.error(
                        'Product container not found. Ensure an element with id="product-grid" or productGrid exists.'
                    );
                    return;
                }

                // show loader
                showLoaderIn(container);
                if (paginationContainer) paginationContainer.innerHTML = '';

                const params = new URLSearchParams();
                if (currentSort) params.append('sort', currentSort);
                if (page) params.append('page', page);

                fetch(`/products/sort?${params.toString()}`, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(res => {
                        if (!res.ok) throw new Error('Network response not OK');
                        return res.json();
                    })
                    .then(data => {
                        // If backend returns 'html' and 'pagination' keys (recommended)
                        if (data.html) {
                            const productContainer = findProductContainer();
                            injectHtmlAndRun(productContainer, data.html);
                        } else {
                            // fallback: raw HTML
                            const productContainer = findProductContainer();
                            productContainer.innerHTML = data;
                            attachAjaxPagination();
                        }

                        if (data.pagination && findPaginationContainer()) {
                            findPaginationContainer().innerHTML = data.pagination;
                            attachAjaxPagination();
                        }
                    })
                    .catch(err => {
                        console.error('Error fetching sorted products:', err);
                        const productContainer = findProductContainer();
                        if (productContainer) productContainer.innerHTML =
                            `<p class="text-red-500 text-center py-6">Error loading products.</p>`;
                    });
            }

            // Wire pagination anchors inside pagination container to do AJAX preserving currentSort
            function attachAjaxPagination() {
                const paginationContainer = findPaginationContainer();
                if (!paginationContainer) return;

                // handle anchors
                const anchors = paginationContainer.querySelectorAll('a');
                anchors.forEach(a => {
                    // avoid double-binding
                    a.removeEventListener('click', anchorClickHandler);
                    a.addEventListener('click', anchorClickHandler);
                });

                function anchorClickHandler(ev) {
                    ev.preventDefault();
                    const href = this.href || this.getAttribute('href');
                    if (!href) return;
                    const url = new URL(href, location.origin);
                    const page = url.searchParams.get('page') || 1;
                    fetchSortedProducts(page);
                    // update scroll to top of products (optional):
                    const productContainer = findProductContainer();
                    if (productContainer) productContainer.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            }

            // initial attach and change handler
            sortSelect.addEventListener('change', () => {
                currentSort = sortSelect.value;
                fetchSortedProducts(1); // load page 1 for new sort
            });

            // optional: initial call to ensure pagination links are AJAX-enabled
            attachAjaxPagination();
        });
        //brand filtering functionality
        document.addEventListener('DOMContentLoaded', function() {
            const brandList = document.getElementById('Brand-list');
            const inStockCheckbox = document.getElementById('in-stock');
            const productContainer = document.getElementById('product-grid');
            const loader = document.getElementById('loader');

            // Load brands dynamically
            fetch('/brands/list')
                .then(res => res.json())
                .then(brands => {
                    brands.forEach(brand => {
                        const div = document.createElement('div');
                        div.innerHTML = `
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" class="brand-checkbox form-checkbox text-primary" value="${brand.id}">
                        <span>${brand.name}</span>
                    </label>
                `;
                        brandList.appendChild(div);
                    });

                    // Add event listener to all brand checkboxes
                    document.querySelectorAll('.brand-checkbox').forEach(cb => {
                        cb.addEventListener('change', applyFilters);
                    });
                });

            // Listen for availability filter change
            if (inStockCheckbox) {
                inStockCheckbox.addEventListener('change', applyFilters);
            }

            function applyFilters() {
                loader.classList.remove('hidden');
                productContainer.style.opacity = '0.5';

                let params = new URLSearchParams();

                // Send brand_ids[] instead of comma-separated string
                let brandIds = Array.from(document.querySelectorAll('.brand-checkbox:checked')).map(cb => cb.value);
                brandIds.forEach(id => params.append('brand_ids[]', id));

                // Availability filter
                if (inStockCheckbox && inStockCheckbox.checked) {
                    params.append('in_stock', 1);
                }

                fetch(`/products/brand/filter?${params.toString()}`)
                    .then(res => res.json())
                    .then(data => {
                        productContainer.innerHTML = data.html;
                        loader.classList.add('hidden');
                        productContainer.style.opacity = '1';
                    })
                    .catch(err => {
                        console.error('Filter error:', err);
                        loader.classList.add('hidden');
                        productContainer.style.opacity = '1';
                    });
            }
        });
        //brand filtering functionality
        //trending Suggestions
        document.addEventListener("DOMContentLoaded", function() {
            fetch("/trending-suggestions")
                .then(res => res.json())
                .then(data => {
                    let container = document.getElementById("ai-suggestions");

                    data.forEach(product => {
                        let button = document.createElement("button");
                        button.textContent = product.name;
                        button.className =
                            "px-3 py-1 bg-accent-50 text-accent rounded-full text-body-sm hover:bg-accent-100 transition-fast";
                        button.onclick = () => {
                            window.location.href = `/product-view/${product.sku}`;
                        };
                        container.appendChild(button);
                    });
                });
        });
        //trending Suggestions
        //advanced searching
        document.addEventListener("DOMContentLoaded", function() {
            const searchInput = document.getElementById("mainSearch");
            const suggestionsContainer = document.getElementById("searchSuggestions");
            const productContainer = document.getElementById("product-grid");
            const loader = document.getElementById("loader");

            let debounceTimeout;

            searchInput.addEventListener("input", function() {
                const query = this.value.trim();

                clearTimeout(debounceTimeout);

                if (query.length < 2) {
                    suggestionsContainer.innerHTML = "";
                    suggestionsContainer.classList.add("hidden");

                    // When input is cleared or less than 2 chars, reload default products
                    if (productContainer) {
                        loader.classList.remove("hidden");
                        productContainer.style.opacity = "0.5";

                        fetch('/products/main-filter') // without filters returns default products
                            .then(res => res.json())
                            .then(data => {
                                productContainer.innerHTML = data.html;
                                if (loader) loader.classList.add("hidden");
                                productContainer.style.opacity = "1";
                            });
                    }
                    return;
                }

                debounceTimeout = setTimeout(() => {
                    fetch(`/search/suggestions?q=${encodeURIComponent(query)}`)
                        .then((res) => res.json())
                        .then((data) => {
                            renderSuggestions(data);
                        });
                }, 300);
            });

            function renderSuggestions(data) {
                if (
                    !data.products.length &&
                    !data.categories.length
                    // add suppliers if you enable that
                ) {
                    suggestionsContainer.innerHTML =
                        '<div class="p-3 text-gray-500">No suggestions found.</div>';
                    suggestionsContainer.classList.remove("hidden");
                    return;
                }

                let html = "";

                if (data.categories.length) {
                    html +=
                        '<div class="p-2 font-semibold border-b bg-gray-100">Categories</div>';
                    data.categories.forEach((category) => {
                        html +=
                            `<div class="p-2 hover:bg-gray-100 cursor-pointer suggestion-item" data-type="category" data-id="${category.id}">${category.name}</div>`;
                    });
                }

                if (data.products.length) {
                    html += '<div class="p-2 font-semibold border-b bg-gray-100">Products</div>';
                    data.products.forEach((product) => {
                        html +=
                            `<div class="p-2 hover:bg-gray-100 cursor-pointer suggestion-item" data-type="product" data-id="${product.id}">${product.name}</div>`;
                    });
                }

                suggestionsContainer.innerHTML = html;
                suggestionsContainer.classList.remove("hidden");

                // Add click listeners for each suggestion
                document.querySelectorAll(".suggestion-item").forEach((item) => {
                    item.addEventListener("click", () => {
                        const type = item.getAttribute("data-type");
                        const id = item.getAttribute("data-id");

                        suggestionsContainer.classList.add("hidden");
                        searchInput.value = item.textContent;

                        if (loader) loader.classList.remove("hidden");
                        if (productContainer) productContainer.style.opacity = "0.5";

                        let url = "/products/main-filter";
                        let params = new URLSearchParams();

                        if (type === "category") {
                            params.append("category_id", id);
                        } else if (type === "product") {
                            params.append("product_id", id);
                        }
                        // add suppliers if needed

                        fetch(`${url}?${params.toString()}`)
                            .then((res) => res.json())
                            .then((data) => {
                                productContainer.innerHTML = data.html;
                                if (loader) loader.classList.add("hidden");
                                if (productContainer) productContainer.style.opacity = "1";
                            })
                            .catch(() => {
                                if (loader) loader.classList.add("hidden");
                                if (productContainer) productContainer.style.opacity = "1";
                                productContainer.innerHTML =
                                    '<div class="p-3 text-red-500">Failed to load products.</div>';
                            });
                    });
                });
            }

            // Hide suggestions if clicking outside
            document.addEventListener("click", (e) => {
                if (!suggestionsContainer.contains(e.target) && e.target !== searchInput) {
                    suggestionsContainer.classList.add("hidden");
                }
            });
        });

        //category filtering functionality
        document.addEventListener('DOMContentLoaded', function() {
            const categorySelect = document.getElementById('categorySelect');
            const searchBtn = document.getElementById('searchBtn');
            const productContainer = document.getElementById('product-grid');
            const loader = document.getElementById('loader');

            searchBtn.addEventListener('click', function() {
                const selectedCategoryId = categorySelect.value;

                // Show loader and dim product container
                if (loader) loader.classList.remove('hidden');
                if (productContainer) productContainer.style.opacity = '0.5';

                // Build params for filtering products
                let params = new URLSearchParams();

                // Only add category filter if not "All Categories"
                if (selectedCategoryId && selectedCategoryId !== 'All Categories') {
                    params.append('category_id', selectedCategoryId);
                }

                fetch(`/products/main-filter?${params.toString()}`)
                    .then(res => res.json())
                    .then(data => {
                        productContainer.innerHTML = data.html;
                        if (loader) loader.classList.add('hidden');
                        if (productContainer) productContainer.style.opacity = '1';
                    });
            });
        });
        //category filtering functionality
        //advanced searching


    </script>
@endsection
