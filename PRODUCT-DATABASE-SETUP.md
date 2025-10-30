# Product Database Setup Guide

## 📋 Overview

This guide will help you set up the MySQL product database system for Easy Print Cafe. This system allows you to manage all products from a database instead of creating individual HTML pages for each product.

---

## 🚀 Step-by-Step Setup Instructions

### **STEP 1: Access Your Hostinger MySQL Database**

1. Log in to your **Hostinger Control Panel** (hPanel)
2. Navigate to **Databases** → **MySQL Databases**
3. Click on **phpMyAdmin** next to your database: `u556329104_easyprintcafe`

---

### **STEP 2: Run the Database Migration**

**Option A: Using Browser (Recommended)**

1. Upload all files to your Hostinger server
2. Open your browser and navigate to:
   ```
   https://easyprintcafe.com/config/products-migration.php
   ```
3. You should see success messages like:
   ```
   ✓ Created product_categories table
   ✓ Created products table
   ✓ Created product_options table
   ✓ Created product_tags table
   ✓ Created product_tag_relations table
   ✓ Created product_related table
   ✅ All product tables created successfully!
   ```

**Option B: Using phpMyAdmin**

1. Open `config/products-migration.php` in a text editor
2. Copy the SQL statements from the `CREATE TABLE` sections
3. In phpMyAdmin, click the **SQL** tab
4. Paste and execute each CREATE TABLE statement one by one

---

### **STEP 3: Insert Sample Data**

1. After the migration is successful, navigate to:
   ```
   https://easyprintcafe.com/config/insert-sample-products.php
   ```
2. You should see:
   ```
   ✓ Flags & Banners
   ✓ Exhibition Displays
   ✓ Outdoor Signage
   ✓ Small Format Printing
   ✓ Feather Flag
   ✓ Teardrop Flag
   ✓ Roller Banner
   ✓ Business Cards
   ✅ Sample data inserted successfully!
   ```

---

### **STEP 4: Test Your Product Pages**

Visit these URLs to verify everything works:

1. **Single Product:**
   ```
   https://easyprintcafe.com/product.php?slug=feather-flag
   ```

2. **API Endpoint (All Products):**
   ```
   https://easyprintcafe.com/api/products/get.php
   ```

3. **API Endpoint (Single Product):**
   ```
   https://easyprintcafe.com/api/products/get.php?slug=feather-flag
   ```

4. **Categories API:**
   ```
   https://easyprintcafe.com/api/products/categories.php
   ```

---

### **STEP 5: Secure Your Setup**

**IMPORTANT:** After setup is complete, delete or move these files for security:

```bash
# Delete these files after running them:
config/products-migration.php
config/insert-sample-products.php
```

Or add this to the top of both files to prevent re-running:
```php
<?php
die('Migration already completed. Delete this file or remove this line.');
?>
```

---

## 📊 Database Structure

### Tables Created:

1. **product_categories** - Product categories (Flags, Banners, etc.)
2. **products** - Main product information
3. **product_options** - Size/material options for products
4. **product_tags** - Tags for filtering (outdoor, weather-resistant, etc.)
5. **product_tag_relations** - Links products to tags
6. **product_related** - Related products relationships

---

## ✨ Adding New Products

### Method 1: Using phpMyAdmin (Easiest for Now)

1. Go to phpMyAdmin → Select `u556329104_easyprintcafe` database
2. Click on **products** table
3. Click **Insert** tab
4. Fill in the fields:
   - **category_id**: 1-4 (based on category)
   - **name**: Product name
   - **slug**: URL-friendly name (e.g., "feather-flag")
   - **short_description**: Brief description
   - **full_description**: Detailed description
   - **features**: Bullet points (use \n for new lines)
   - **main_image**: Path to image (e.g., /images/products/your-image.png)
   - **is_active**: 1 (to make it visible)

### Method 2: SQL Insert Statement

```sql
INSERT INTO products (
    category_id, name, slug, short_description, full_description,
    features, main_image, is_active, is_featured
) VALUES (
    1, 
    'Your Product Name',
    'your-product-slug',
    'Short description here',
    'Full detailed description here',
    '• Feature 1\n• Feature 2\n• Feature 3',
    '/images/products/your-image.png',
    1,
    0
);
```

### Method 3: Build an Admin Panel (Future Enhancement)

You can create an admin panel later to manage products via a web interface.

---

## 🔗 SEO-Friendly URLs (Optional)

To use URLs like `/products/feather-flag` instead of `/product.php?slug=feather-flag`:

### Create `.htaccess` file in your root directory:

```apache
# Enable RewriteEngine
RewriteEngine On

# Redirect product URLs
RewriteRule ^products/([a-z0-9-]+)/?$ product.php?slug=$1 [L,QSA]

# Redirect category URLs
RewriteRule ^category/([a-z0-9-]+)/?$ pages/printing-services.html?category=$1 [L,QSA]
```

Then you can use clean URLs:
- `https://easyprintcafe.com/products/feather-flag`
- `https://easyprintcafe.com/category/flags-banners`

---

## 📝 Product Fields Explained

| Field | Description | Example |
|-------|-------------|---------|
| `name` | Product name | "Feather Flag" |
| `slug` | URL-friendly identifier (unique) | "feather-flag" |
| `short_description` | Brief summary for cards/listings | "Eye-catching outdoor flags" |
| `full_description` | Detailed product information | Full paragraph |
| `features` | Key selling points (use \n for lines) | "• UV resistant\n• Durable" |
| `specifications` | Technical details | "Material: Polyester\nSize: 3.5m" |
| `main_image` | Primary product image path | "/images/products/feather.png" |
| `base_price` | Starting price (optional) | 45.00 |
| `show_price` | Display price? (0 or 1) | 1 |
| `price_note` | Price label | "From £45" or "Get a Quote" |
| `turnaround_time` | Production time | "3-5 working days" |
| `weather_resistant` | Outdoor suitable? (0 or 1) | 1 |
| `is_active` | Visible on site? (0 or 1) | 1 |
| `is_featured` | Show as featured? (0 or 1) | 1 |

---

## 🎯 Next Steps

1. ✅ Run the migration
2. ✅ Insert sample data
3. ✅ Test the product pages
4. 📸 Add your product images to `/images/products/`
5. 📝 Start adding your real products
6. 🔗 Update your existing pages to link to new product pages
7. 🎨 Consider building an admin panel for easier management

---

## ❓ Troubleshooting

### "Database connection failed"
- Check your database credentials in `config/database.php`
- Verify your database is active in Hostinger

### "Product not found"
- Make sure `is_active = 1` in the products table
- Check that the slug matches exactly (case-sensitive)

### "Images not showing"
- Verify image paths are correct
- Ensure images exist in `/images/products/` folder
- Check file permissions (should be 644)

### "500 Internal Server Error"
- Check PHP error logs in Hostinger control panel
- Ensure all required PHP extensions are enabled (PDO, MySQLi)

---

## 💡 Benefits of This System

✅ **Scalability**: Add unlimited products without creating new HTML files  
✅ **Consistency**: All products use the same professional template  
✅ **Maintainability**: Update design once, affects all products  
✅ **SEO**: Each product has unique URLs, titles, and meta descriptions  
✅ **Performance**: Small file size, fast loading  
✅ **Features**: Easy to add search, filtering, categories later  
✅ **Management**: Update prices, descriptions from one place  

---

## 📞 Need Help?

If you encounter any issues during setup, check:
1. PHP error logs in Hostinger
2. Browser console for JavaScript errors
3. Database connection in `config/database.php`

---

**Last Updated:** October 2025  
**Version:** 1.0

