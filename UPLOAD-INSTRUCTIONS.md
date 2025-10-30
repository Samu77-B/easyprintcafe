# 🚀 Upload Instructions - Database Connection

## Files to Upload to Server

Upload these files to make the database connection live:

---

## 📤 New Files (Upload These)

### **1. API Endpoint:**
```
/build/api/products/mega-menu.php
```
**Purpose:** Provides products for mega menu dropdown

---

### **2. JavaScript Update:**
```
/build/js/header-init.js
```
**Purpose:** Loads dynamic mega menu from database

---

### **3. Homepage Update:**
```
/build/index.html
```
**Purpose:** Loads featured products from database

---

### **4. Database Insert Script:**
```
/build/config/insert-large-format-products.php
```
**Purpose:** Run ONCE to insert large format products

---

## ⚡ Quick Upload Steps

### **Step 1: Upload Files**
Upload these 4 files to your Hostinger server:
- `api/products/mega-menu.php` → `/build/api/products/`
- `js/header-init.js` → `/build/js/`
- `index.html` → `/build/`
- `config/insert-large-format-products.php` → `/build/config/`

### **Step 2: Run Database Script**
Visit: `https://easyprintcafe.com/build/config/insert-large-format-products.php`

You should see:
```
✓ Connected to database successfully
✓ Inserted 17 large format products
```

### **Step 3: Delete Script**
**IMPORTANT:** Delete `insert-large-format-products.php` after running it (security)

### **Step 4: Test**
Visit: `https://easyprintcafe.com/build/`
- Check mega menu → Should show products from database
- Check homepage → Should show featured products
- Click on products → Should open product pages

---

## ✅ Verification Checklist

After uploading, verify:

- [ ] Mega menu shows products (hover over "Products")
- [ ] Homepage shows featured products
- [ ] Click product → Opens product page
- [ ] Products page shows all products
- [ ] All links work correctly

---

## 🔍 Troubleshooting

### **If mega menu is empty:**
- Check: `api/products/mega-menu.php` uploaded correctly
- Check: Database has products with `is_active = 1`
- Open browser console → Look for errors

### **If homepage products don't load:**
- Check: `index.html` uploaded correctly
- Check: `api/products/get.php` works (visit directly)
- Open browser console → Look for errors

### **If products don't insert:**
- Check: Database credentials in `config/database.php`
- Check: Product categories exist
- Check: PHP error logs

---

## 🎯 What Happens After Upload

1. **Mega Menu** → Loads top 8 products per category from database
2. **Homepage** → Loads featured products from database
3. **Products Page** → Loads all products from database
4. **Product Pages** → Load individual product details from database

**Everything updates automatically when you change the database!** 🎉

---

## 📊 Current Status

| Component | Status | Source |
|-----------|--------|--------|
| Mega Menu | ✅ Dynamic | Database |
| Homepage Products | ✅ Dynamic | Database |
| Products Page | ✅ Dynamic | Database |
| Product Pages | ✅ Dynamic | Database |

---

## 🚀 Ready to Go!

Upload the 4 files, run the insert script once, and you're done!

**Your site will be 100% database-driven!** 🎉


