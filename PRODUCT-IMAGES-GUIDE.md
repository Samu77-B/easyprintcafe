# 📸 Product Images Guide

## How to Add Images to Your Products

---

## 📁 Step 1: Prepare Your Images

### **Image Requirements:**
- **Format:** JPG or PNG (PNG recommended for transparency)
- **Size:** Recommended 800x800px minimum (square ratio works best)
- **File Size:** Keep under 500KB for fast loading
- **Naming:** Use lowercase with hyphens (e.g., `business-cards.png`)

### **Where to Save Images:**
Upload all product images to:
```
/build/images/products/
```

---

## 📤 Step 2: Upload Images to Server

Upload your product images to the `/build/images/products/` folder on your server.

### **Recommended File Names (based on your products):**

**Small Format Products:**
```
business-cards.png
economy-business-cards.png
square-business-cards.png
folded-business-cards.png
booklets-magazines.png
perfect-bound-booklets.png
hardback-books.png
compliment-slips.png
letterheads.png
swing-tags.png
ncr-pads.png
flyers-leaflets.png
folded-invitations.png
postcards.png
presentation-folders.png
interlocking-folders.png
stickers-sheet.png
floor-stickers.png
a2-posters.png
a1-posters.png
canvas-prints.png
plan-printing.png
special-printing.png
book-binding.png
finishing-mounting.png
```

**Large Format Products:**
```
feather-flag.png
teardrop-flag.png
roller-banner.png
(add more as needed)
```

---

## 🔧 Step 3: Update Database with Image Paths

### **Method 1: Using phpMyAdmin (Easiest)**

1. Go to Hostinger → phpMyAdmin
2. Select your database `u556329104_easyprintcafe`
3. Click on **products** table
4. Find the product you want to update
5. Click **Edit** (pencil icon)
6. In the `main_image` field, enter:
   ```
   ./images/products/your-image-name.png
   ```
7. Click **Go** to save

### **Method 2: Using SQL (Bulk Update)**

Run this SQL in phpMyAdmin → SQL tab:

```sql
-- Update Business Cards
UPDATE products SET main_image = './images/products/business-cards.png' 
WHERE slug = 'standard-business-cards';

UPDATE products SET main_image = './images/products/economy-business-cards.png' 
WHERE slug = 'economy-business-cards';

UPDATE products SET main_image = './images/products/square-business-cards.png' 
WHERE slug = 'square-business-cards';

UPDATE products SET main_image = './images/products/folded-business-cards.png' 
WHERE slug = 'folded-business-cards';

-- Update Booklets
UPDATE products SET main_image = './images/products/booklets-magazines.png' 
WHERE slug = 'stapled-booklets-magazines';

UPDATE products SET main_image = './images/products/perfect-bound-booklets.png' 
WHERE slug = 'perfect-bound-booklets';

UPDATE products SET main_image = './images/products/hardback-books.png' 
WHERE slug = 'hardback-hardcover-books';

-- Update Stationery
UPDATE products SET main_image = './images/products/compliment-slips.png' 
WHERE slug = 'compliment-slips';

UPDATE products SET main_image = './images/products/letterheads.png' 
WHERE slug = 'letterheads';

UPDATE products SET main_image = './images/products/swing-tags.png' 
WHERE slug = 'swing-tags';

UPDATE products SET main_image = './images/products/ncr-pads.png' 
WHERE slug = 'ncr-pads';

-- Update Flyers
UPDATE products SET main_image = './images/products/flyers-leaflets.png' 
WHERE slug = 'heavyweight-flyers-leaflets';

UPDATE products SET main_image = './images/products/folded-invitations.png' 
WHERE slug = 'folded-invitations-greeting-cards';

UPDATE products SET main_image = './images/products/postcards.png' 
WHERE slug = 'postcards-invitations';

-- Update Folders
UPDATE products SET main_image = './images/products/presentation-folders.png' 
WHERE slug = 'glued-presentation-folders';

UPDATE products SET main_image = './images/products/interlocking-folders.png' 
WHERE slug = 'interlocking-folders';

-- Update Stickers
UPDATE products SET main_image = './images/products/stickers-sheet.png' 
WHERE slug = 'stickers-on-sheet';

UPDATE products SET main_image = './images/products/floor-stickers.png' 
WHERE slug = 'vinyl-floor-stickers';

-- Update Posters
UPDATE products SET main_image = './images/products/a2-posters.png' 
WHERE slug = 'a2-posters';

UPDATE products SET main_image = './images/products/a1-posters.png' 
WHERE slug = 'a1-posters';

UPDATE products SET main_image = './images/products/canvas-prints.png' 
WHERE slug = 'canvas-prints';

UPDATE products SET main_image = './images/products/plan-printing.png' 
WHERE slug = 'plan-printing';

-- Update Special Services
UPDATE products SET main_image = './images/products/special-printing.png' 
WHERE slug = 'special-effect-printing';

UPDATE products SET main_image = './images/products/book-binding.png' 
WHERE slug = 'book-binding-slip-cases';

UPDATE products SET main_image = './images/products/finishing-mounting.png' 
WHERE slug = 'finishing-mounting-lamination';
```

---

## 🎨 Step 4: Create Images (If You Don't Have Them)

### **Option 1: Use Existing Product Photos**
- Take photos of actual products
- Use a plain white background
- Ensure good lighting
- Crop to square ratio

### **Option 2: Use Stock Images**
Free stock image sites:
- Unsplash (unsplash.com)
- Pexels (pexels.com)
- Pixabay (pixabay.com)

Search for: "business cards", "flyers", "booklets", etc.

### **Option 3: Create Simple Graphics**
Use free design tools:
- Canva (canva.com)
- Photopea (photopea.com - free Photoshop alternative)

Create 800x800px images with:
- Product mockup
- Product name
- Simple icon/illustration

---

## 📋 Quick Reference: Product Slugs

To update images, you need to know the product's **slug** (URL identifier).

Run this SQL to see all your products and their slugs:

```sql
SELECT id, name, slug, main_image 
FROM products 
ORDER BY category_id, name;
```

---

## ✅ Step 5: Test Your Images

After uploading and updating:

1. Visit your products page:
   ```
   https://easyprintcafe.com/build/pages/products.php
   ```

2. Check individual product pages:
   ```
   https://easyprintcafe.com/build/product.php?slug=standard-business-cards
   ```

3. If images don't show:
   - Check file name matches exactly (case-sensitive)
   - Check file is in `/build/images/products/`
   - Check browser console for errors (F12)

---

## 🔄 Temporary Solution: Use Placeholder

If you don't have images yet, the site will automatically show a placeholder image:
```
./images/products/placeholder.png
```

You can:
1. Create a simple placeholder image (800x800px)
2. Save it as `placeholder.png`
3. All products without images will show this

---

## 💡 Pro Tips

### **Optimize Images:**
Use online tools to compress images:
- TinyPNG (tinypng.com)
- Squoosh (squoosh.app)

Target: Under 100KB per image for best performance

### **Consistent Style:**
- Use same dimensions for all images
- Use same background color/style
- Maintain consistent lighting/angle
- Creates professional, cohesive look

### **Image Naming:**
- Lowercase only
- Use hyphens (not spaces or underscores)
- Be descriptive: `square-business-cards.png` not `img123.png`
- Easier to manage and remember

---

## 📊 Example: Complete Product with Image

```sql
UPDATE products SET 
    main_image = './images/products/business-cards.png',
    name = 'Standard Business Cards',
    short_description = 'Professional business cards with premium options'
WHERE slug = 'standard-business-cards';
```

---

## 🚨 Troubleshooting

### **Images Not Showing?**

1. **Check File Path:**
   - Database has: `./images/products/business-cards.png`
   - File exists at: `/build/images/products/business-cards.png`
   - Path must start with `./` for relative path

2. **Check File Name:**
   - Must match EXACTLY (case-sensitive)
   - `Business-Cards.png` ≠ `business-cards.png`

3. **Check File Permissions:**
   - Files should be readable (644 permissions)
   - Folders should be accessible (755 permissions)

4. **Check Browser Console:**
   - Press F12 to open developer tools
   - Look for 404 errors on images
   - Shows exact path browser is trying to load

---

## 📝 Summary Checklist

- [ ] Create/gather product images
- [ ] Optimize images (under 100KB each)
- [ ] Upload to `/build/images/products/`
- [ ] Update database with image paths
- [ ] Test on products page
- [ ] Test individual product pages
- [ ] All images loading correctly

---

**Need Help?** The system has a built-in placeholder for missing images, so don't worry if you don't have all images ready yet. You can add them gradually!

---

**Created:** October 2025  
**For:** Easy Print Cafe Product System

