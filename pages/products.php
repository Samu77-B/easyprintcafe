<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Products | Easy Print Cafe</title>
    <meta name="description" content="Browse our complete range of printing products from business cards to large format displays">
    <link rel="icon" type="image/png" href="../brand/epcFav.png">
    
    <link rel="stylesheet" href="../styles.css">
    <link rel="stylesheet" href="../components/header.css">
    <link rel="stylesheet" href="../components/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <style>
        .products-hero {
            background: linear-gradient(135deg, #d35400 0%, #e67e22 100%);
            color: white;
            padding: 80px 20px 60px;
            text-align: center;
        }
        
        .products-hero h1 {
            font-size: 3rem;
            margin-bottom: 20px;
        }
        
        .products-hero p {
            font-size: 1.3rem;
            opacity: 0.95;
            max-width: 700px;
            margin: 0 auto;
        }
        
        .products-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 60px 20px;
        }
        
        .category-filter {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 50px;
            padding-bottom: 30px;
            border-bottom: 2px solid #e0e0e0;
        }
        
        .filter-btn {
            padding: 12px 28px;
            border: 2px solid #d35400;
            background: white;
            color: #d35400;
            border-radius: 25px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .filter-btn:hover,
        .filter-btn.active {
            background: #d35400;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(211, 84, 0, 0.3);
        }
        
        .category-section {
            margin-bottom: 80px;
        }
        
        .category-section.hidden {
            display: none;
        }
        
        .category-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 40px;
            padding-bottom: 20px;
            border-bottom: 3px solid #d35400;
        }
        
        .category-header h2 {
            font-size: 2.2rem;
            color: #333;
            margin: 0;
        }
        
        .category-count {
            background: #d35400;
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 1rem;
        }
        
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 30px;
        }
        
        .product-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            transition: all 0.3s;
            text-decoration: none;
            color: inherit;
            display: flex;
            flex-direction: column;
        }
        
        .product-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        }
        
        .product-image {
            width: 100%;
            height: 220px;
            object-fit: cover;
            background: #f5f5f5;
        }
        
        .product-card-content {
            padding: 20px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }
        
        .product-card h3 {
            font-size: 1.3rem;
            margin: 0 0 10px 0;
            color: #333;
        }
        
        .product-card p {
            color: #666;
            font-size: 0.95rem;
            line-height: 1.6;
            margin-bottom: 15px;
            flex: 1;
        }
        
        .product-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: auto;
            padding-top: 15px;
            border-top: 1px solid #e0e0e0;
        }
        
        .product-price {
            font-weight: bold;
            color: #d35400;
            font-size: 1.1rem;
        }
        
        .product-badge {
            background: #27ae60;
            color: white;
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 0.85rem;
            font-weight: 600;
        }
        
        .loading {
            text-align: center;
            padding: 100px 20px;
            font-size: 1.3rem;
            color: #666;
        }
        
        .empty-state {
            text-align: center;
            padding: 100px 20px;
        }
        
        .empty-state i {
            font-size: 80px;
            color: #ddd;
            margin-bottom: 20px;
        }
        
        .empty-state h3 {
            color: #999;
            font-size: 1.5rem;
        }
        
        @media (max-width: 768px) {
            .products-hero h1 {
                font-size: 2rem;
            }
            
            .products-hero p {
                font-size: 1.1rem;
            }
            
            .category-filter {
                justify-content: flex-start;
                overflow-x: auto;
                flex-wrap: nowrap;
                padding-bottom: 20px;
            }
            
            .filter-btn {
                white-space: nowrap;
            }
            
            .products-grid {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
                gap: 20px;
            }
        }
    </style>
</head>
<body>
    <!-- Header Component -->
    <div id="header-placeholder"></div>
    
    <!-- Hero Section -->
    <section class="products-hero">
        <h1>Our Print Products</h1>
        <p>From business cards to large format displays, we've got all your printing needs covered</p>
    </section>
    
    <!-- Loading State -->
    <div id="loading" class="loading">
        <i class="fas fa-spinner fa-spin"></i> Loading products...
    </div>
    
    <!-- Products Container -->
    <div id="products-container" class="products-container" style="display: none;">
        <!-- Category Filters -->
        <div class="category-filter" id="category-filter">
            <button class="filter-btn active" data-category="all">All Products</button>
        </div>
        
        <!-- Products will be loaded here by category -->
        <div id="products-sections"></div>
    </div>
    
    <!-- Footer Component -->
    <div id="footer-placeholder"></div>
    
    <script src="../js/header-init.js"></script>
    <script src="../js/footer-init.js"></script>
    
    <script>
        let allProducts = [];
        let allCategories = [];
        
        // Load data on page load
        window.addEventListener('DOMContentLoaded', async () => {
            await loadCategories();
            await loadProducts();
        });
        
        async function loadCategories() {
            try {
                const response = await fetch('../api/products/categories.php');
                const data = await response.json();
                
                if (data.success) {
                    allCategories = data.categories;
                    displayCategoryFilters(allCategories);
                }
            } catch (error) {
                console.error('Error loading categories:', error);
            }
        }
        
        async function loadProducts() {
            try {
                const response = await fetch('../api/products/get.php');
                const data = await response.json();
                
                if (data.success) {
                    allProducts = data.products;
                    displayProducts(allProducts);
                    
                    // Hide loading, show content
                    document.getElementById('loading').style.display = 'none';
                    document.getElementById('products-container').style.display = 'block';
                } else {
                    showError();
                }
            } catch (error) {
                console.error('Error loading products:', error);
                showError();
            }
        }
        
        function displayCategoryFilters(categories) {
            const filterContainer = document.getElementById('category-filter');
            
            // Add category buttons
            categories.forEach(cat => {
                const btn = document.createElement('button');
                btn.className = 'filter-btn';
                btn.setAttribute('data-category', cat.slug);
                btn.textContent = `${cat.name} (${cat.product_count})`;
                btn.addEventListener('click', () => filterByCategory(cat.slug));
                filterContainer.appendChild(btn);
            });
        }
        
        function displayProducts(products) {
            const sectionsContainer = document.getElementById('products-sections');
            sectionsContainer.innerHTML = '';
            
            // Group products by category
            const productsByCategory = {};
            products.forEach(product => {
                const catSlug = product.category_slug;
                if (!productsByCategory[catSlug]) {
                    productsByCategory[catSlug] = {
                        name: product.category_name,
                        products: []
                    };
                }
                productsByCategory[catSlug].products.push(product);
            });
            
            // Create sections for each category
            Object.keys(productsByCategory).forEach(catSlug => {
                const categoryData = productsByCategory[catSlug];
                const section = createCategorySection(catSlug, categoryData.name, categoryData.products);
                sectionsContainer.appendChild(section);
            });
        }
        
        function createCategorySection(slug, name, products) {
            const section = document.createElement('div');
            section.className = 'category-section';
            section.setAttribute('data-category', slug);
            
            section.innerHTML = `
                <div class="category-header">
                    <h2>${name}</h2>
                    <span class="category-count">${products.length} products</span>
                </div>
                <div class="products-grid">
                    ${products.map(p => createProductCard(p)).join('')}
                </div>
            `;
            
            return section;
        }
        
        function createProductCard(product) {
            return `
                <a href="../pages/printing-services.html" class="product-card">
                    <img src="${product.main_image || '../images/products/placeholder.png'}" 
                         alt="${product.name}" 
                         class="product-image"
                         onerror="this.src='../images/products/placeholder.png'">
                    <div class="product-card-content">
                        <h3>${product.name}</h3>
                        <p>${product.short_description}</p>
                        <div class="product-meta">
                            <span class="product-price">
                                ${product.show_price && product.base_price ? 
                                    `From £${parseFloat(product.base_price).toFixed(2)}` : 
                                    (product.price_note || 'Get a Quote')}
                            </span>
                            ${product.is_featured ? '<span class="product-badge">Popular</span>' : ''}
                        </div>
                    </div>
                </a>
            `;
        }
        
        function filterByCategory(categorySlug) {
            // Update active button
            document.querySelectorAll('.filter-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            event.target.classList.add('active');
            
            // Show/hide sections
            const sections = document.querySelectorAll('.category-section');
            sections.forEach(section => {
                if (categorySlug === 'all') {
                    section.classList.remove('hidden');
                } else {
                    if (section.getAttribute('data-category') === categorySlug) {
                        section.classList.remove('hidden');
                    } else {
                        section.classList.add('hidden');
                    }
                }
            });
            
            // Scroll to top of products
            document.getElementById('products-container').scrollIntoView({ 
                behavior: 'smooth', 
                block: 'start' 
            });
        }
        
        function showError() {
            document.getElementById('loading').innerHTML = `
                <div class="empty-state">
                    <i class="fas fa-exclamation-triangle"></i>
                    <h3>Unable to load products</h3>
                    <p>Please try again later</p>
                </div>
            `;
        }
    </script>
</body>
</html>

