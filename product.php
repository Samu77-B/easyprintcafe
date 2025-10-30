<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title id="page-title">Product | Easy Print Cafe</title>
    <meta name="description" id="page-description" content="View our print products">
    <link rel="icon" type="image/png" href="brand/epcFav.png">
    
    <link rel="stylesheet" href="./styles.css">
    <link rel="stylesheet" href="./components/header.css">
    <link rel="stylesheet" href="./components/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <style>
        .product-container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 20px;
        }
        
        .breadcrumb {
            margin-bottom: 30px;
            font-size: 14px;
            color: #666;
        }
        
        .breadcrumb a {
            color: #d35400;
            text-decoration: none;
        }
        
        .breadcrumb a:hover {
            text-decoration: underline;
        }
        
        .product-detail {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 50px;
            margin-bottom: 50px;
        }
        
        .product-image {
            text-align: center;
        }
        
        .product-image img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        
        .product-info h1 {
            font-size: 2.5rem;
            margin-bottom: 15px;
            color: #333;
        }
        
        .product-category {
            display: inline-block;
            background: #d35400;
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 14px;
            margin-bottom: 20px;
        }
        
        .product-short-desc {
            font-size: 1.2rem;
            color: #666;
            margin-bottom: 20px;
        }
        
        .product-price {
            font-size: 1.5rem;
            color: #d35400;
            font-weight: bold;
            margin-bottom: 30px;
        }
        
        .product-features {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        
        .product-features h3 {
            margin-top: 0;
            color: #333;
        }
        
        .product-features ul {
            margin: 0;
            padding-left: 20px;
        }
        
        .product-features li {
            margin-bottom: 10px;
            color: #555;
        }
        
        .product-cta {
            display: flex;
            gap: 15px;
            margin-top: 30px;
        }
        
        .btn-primary, .btn-secondary {
            padding: 15px 30px;
            font-size: 16px;
            border-radius: 5px;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s;
            border: none;
            cursor: pointer;
        }
        
        .btn-primary {
            background: #d35400;
            color: white;
        }
        
        .btn-primary:hover {
            background: #e67e22;
        }
        
        .btn-secondary {
            background: white;
            color: #d35400;
            border: 2px solid #d35400;
        }
        
        .btn-secondary:hover {
            background: #d35400;
            color: white;
        }
        
        .product-tabs {
            margin-top: 50px;
        }
        
        .tab-buttons {
            display: flex;
            gap: 10px;
            border-bottom: 2px solid #ddd;
            margin-bottom: 30px;
        }
        
        .tab-button {
            padding: 15px 30px;
            background: none;
            border: none;
            cursor: pointer;
            font-size: 16px;
            color: #666;
            border-bottom: 3px solid transparent;
            transition: all 0.3s;
        }
        
        .tab-button.active {
            color: #d35400;
            border-bottom-color: #d35400;
        }
        
        .tab-content {
            display: none;
            padding: 20px 0;
            line-height: 1.8;
        }
        
        .tab-content.active {
            display: block;
        }
        
        .tab-content h3 {
            margin-top: 0;
        }
        
        .related-products {
            margin-top: 60px;
        }
        
        .related-products h2 {
            text-align: center;
            margin-bottom: 40px;
        }
        
        .related-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 30px;
        }
        
        .related-card {
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            transition: transform 0.3s;
            text-decoration: none;
            color: inherit;
        }
        
        .related-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }
        
        .related-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        
        .related-card-content {
            padding: 20px;
        }
        
        .related-card h3 {
            margin: 0 0 10px 0;
            font-size: 1.2rem;
        }
        
        .related-card p {
            margin: 0;
            color: #666;
            font-size: 0.9rem;
        }
        
        .loading {
            text-align: center;
            padding: 100px 20px;
            font-size: 1.2rem;
            color: #666;
        }
        
        .error {
            text-align: center;
            padding: 100px 20px;
        }
        
        .error h2 {
            color: #d35400;
            margin-bottom: 20px;
        }
        
        @media (max-width: 768px) {
            .product-detail {
                grid-template-columns: 1fr;
                gap: 30px;
            }
            
            .product-info h1 {
                font-size: 2rem;
            }
            
            .product-cta {
                flex-direction: column;
            }
            
            .tab-buttons {
                flex-wrap: wrap;
            }
            
            .tab-button {
                flex: 1;
                min-width: 120px;
            }
        }
    </style>
</head>
<body>
    <!-- Header Component -->
    <div id="header-placeholder"></div>
    
    <!-- Loading State -->
    <div id="loading" class="loading">
        <i class="fas fa-spinner fa-spin"></i> Loading product...
    </div>
    
    <!-- Product Content -->
    <div id="product-content" style="display: none;">
        <div class="product-container">
            <!-- Breadcrumb -->
            <div class="breadcrumb">
                <a href="./">Home</a> / 
                <a href="./pages/printing-services.html">Products</a> / 
                <a href="#" id="category-link"><span id="category-name"></span></a> / 
                <span id="product-name-breadcrumb"></span>
            </div>
            
            <!-- Product Detail -->
            <div class="product-detail">
                <div class="product-image">
                    <img id="product-main-image" src="" alt="">
                </div>
                
                <div class="product-info">
                    <span class="product-category" id="product-category"></span>
                    <h1 id="product-name"></h1>
                    <p class="product-short-desc" id="product-short-desc"></p>
                    <div class="product-price" id="product-price"></div>
                    
                    <div class="product-features" id="product-features-box">
                        <h3>Key Features</h3>
                        <div id="product-features"></div>
                    </div>
                    
                    <div class="product-cta">
                        <a href="./pages/contact.html" class="btn-primary">
                            <i class="fas fa-quote-left"></i> Get a Quote
                        </a>
                        <a href="./pages/design-guidelines.html" class="btn-secondary">
                            <i class="fas fa-pencil-ruler"></i> Design Guidelines
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Product Tabs -->
            <div class="product-tabs">
                <div class="tab-buttons">
                    <button class="tab-button active" onclick="switchTab('description')">Description</button>
                    <button class="tab-button" onclick="switchTab('specifications')">Specifications</button>
                </div>
                
                <div id="tab-description" class="tab-content active">
                    <div id="product-description"></div>
                </div>
                
                <div id="tab-specifications" class="tab-content">
                    <div id="product-specifications"></div>
                </div>
            </div>
            
            <!-- Related Products -->
            <div class="related-products" id="related-section" style="display: none;">
                <h2>Related Products</h2>
                <div class="related-grid" id="related-grid"></div>
            </div>
        </div>
    </div>
    
    <!-- Error State -->
    <div id="error-content" style="display: none;">
        <div class="error">
            <h2>Product Not Found</h2>
            <p>Sorry, we couldn't find the product you're looking for.</p>
            <a href="./pages/printing-services.html" class="btn-primary">View All Products</a>
        </div>
    </div>
    
    <!-- Footer Component -->
    <div id="footer-placeholder"></div>
    
    <script src="./js/header-init.js"></script>
    <script src="./js/footer-init.js"></script>
    
    <script>
        // Get product slug from URL
        const urlParams = new URLSearchParams(window.location.search);
        const productSlug = urlParams.get('slug');
        
        if (!productSlug) {
            showError();
        } else {
            loadProduct(productSlug);
        }
        
        async function loadProduct(slug) {
            try {
                const response = await fetch(`./api/products/get.php?slug=${slug}`);
                const data = await response.json();
                
                if (!data.success || !data.product) {
                    showError();
                    return;
                }
                
                displayProduct(data.product);
                
            } catch (error) {
                console.error('Error loading product:', error);
                showError();
            }
        }
        
        function displayProduct(product) {
            // Update page title and meta
            document.getElementById('page-title').textContent = `${product.name} | Easy Print Cafe`;
            document.getElementById('page-description').content = product.short_description;
            
            // Update breadcrumb
            document.getElementById('category-name').textContent = product.category_name;
            document.getElementById('category-link').href = `./pages/printing-services.html?category=${product.category_slug}`;
            document.getElementById('product-name-breadcrumb').textContent = product.name;
            
            // Update product info
            document.getElementById('product-category').textContent = product.category_name;
            document.getElementById('product-name').textContent = product.name;
            document.getElementById('product-short-desc').textContent = product.short_description;
            
            // Update image
            const mainImage = document.getElementById('product-main-image');
            mainImage.src = product.main_image || './images/products/placeholder.png';
            mainImage.alt = product.name;
            
            // Update price
            const priceEl = document.getElementById('product-price');
            if (product.show_price && product.base_price) {
                priceEl.innerHTML = `From £${parseFloat(product.base_price).toFixed(2)}`;
            } else {
                priceEl.innerHTML = product.price_note || 'Get a Quote';
            }
            
            // Update features
            if (product.features) {
                const featuresHtml = product.features
                    .split('\n')
                    .filter(f => f.trim())
                    .map(f => `<p>${f}</p>`)
                    .join('');
                document.getElementById('product-features').innerHTML = featuresHtml;
            } else {
                document.getElementById('product-features-box').style.display = 'none';
            }
            
            // Update description
            document.getElementById('product-description').innerHTML = `
                <p>${product.full_description || product.short_description}</p>
                ${product.turnaround_time ? `<p><strong>Turnaround Time:</strong> ${product.turnaround_time}</p>` : ''}
                ${product.weather_resistant ? '<p><i class="fas fa-check-circle" style="color: #27ae60;"></i> Weather Resistant</p>' : ''}
            `;
            
            // Update specifications
            if (product.specifications) {
                const specsHtml = product.specifications
                    .split('\n')
                    .filter(s => s.trim())
                    .map(s => `<p>${s}</p>`)
                    .join('');
                document.getElementById('product-specifications').innerHTML = specsHtml;
            }
            
            // Display related products
            if (product.related_products && product.related_products.length > 0) {
                displayRelatedProducts(product.related_products);
            }
            
            // Show content, hide loading
            document.getElementById('loading').style.display = 'none';
            document.getElementById('product-content').style.display = 'block';
        }
        
        function displayRelatedProducts(products) {
            const grid = document.getElementById('related-grid');
            grid.innerHTML = products.map(p => `
                <a href="./product.php?slug=${p.slug}" class="related-card">
                    <img src="${p.main_image || './images/products/placeholder.png'}" alt="${p.name}">
                    <div class="related-card-content">
                        <h3>${p.name}</h3>
                        <p>${p.short_description}</p>
                    </div>
                </a>
            `).join('');
            
            document.getElementById('related-section').style.display = 'block';
        }
        
        function showError() {
            document.getElementById('loading').style.display = 'none';
            document.getElementById('error-content').style.display = 'block';
        }
        
        function switchTab(tabName) {
            // Hide all tabs
            document.querySelectorAll('.tab-content').forEach(tab => {
                tab.classList.remove('active');
            });
            document.querySelectorAll('.tab-button').forEach(btn => {
                btn.classList.remove('active');
            });
            
            // Show selected tab
            document.getElementById(`tab-${tabName}`).classList.add('active');
            event.target.classList.add('active');
        }
    </script>
</body>
</html>

